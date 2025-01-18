<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\DisasterNotification;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index()
    {
        $users = Owner::all();
        return view('admin.email.index', [
            'users' => $users,
            'is_active' => 'email'
        ]);
    }

    public function send(Request $request)
    {
        $request->validate([
            'recipient_type' => 'required|in:all,house_owners,business_owners,single',
            'recipient_id' => 'nullable|required_if:recipient_type,single|exists:owners,id',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'attachments.*' => 'sometimes|file|max:10240'
        ], [
            'recipient_type.required' => 'الرجاء اختيار نوع المستلم',
            'recipient_type.in' => 'نوع المستلم غير صحيح',
            'recipient_id.required_if' => 'الرجاء اختيار المستلم',
            'recipient_id.exists' => 'المستلم المحدد غير موجود',
            'subject.required' => 'عنوان الرسالة مطلوب',
            'content.required' => 'محتوى الرسالة مطلوب'
        ]);

        try {
            $attachmentPaths = [];
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $attachment) {
                    $path = $attachment->store('email-attachments', 'public');
                    $attachmentPaths[] = storage_path('app/public/' . $path);
                }
            }

            $recipients = $this->getRecipients($request->recipient_type, $request->recipient_id);

            foreach ($recipients as $recipient) {
                if ($recipient->email) {
                    Mail::to($recipient->email)
                        ->send(new DisasterNotification(
                            $request->subject,
                            $request->content,
                            $attachmentPaths
                        ));
                    \Log::info('Email sent to: ' . $recipient->email);
                }
            }

            return redirect()->back()->with('success', 'تم إرسال البريد الإلكتروني بنجاح');
        } catch (\Exception $e) {
            \Log::error('Email Error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'حدث خطأ أثناء إرسال البريد الإلكتروني')
                ->withInput();
        }
    }

    private function getRecipients($type, $id = null)
    {
        switch ($type) {
            case 'all':
                return Owner::where('email', '!=', null)->get();

            case 'house_owners':
                return Owner::whereHas('house', function($query) {
                    $query->whereNotNull('id');
                })->get();

            case 'business_owners':
                return Owner::whereHas('business', function($query) {
                    $query->whereNotNull('id');
                })->get();

            case 'single':
                return Owner::where('id', $id)->get();

            default:
                return collect([]);
        }
    }
}