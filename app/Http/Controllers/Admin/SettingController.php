<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\UpdateSettingRequest;
use App\Models\Setting;
use Exception;

class SettingController extends Controller
{
    public function index()
    {
        $data['settings'] = new Setting();
        $data['is_active'] = 'settings';
        return view('admin.settings.index', $data);
    }

    public function update(UpdateSettingRequest $request)
    {
        $data = $request->validated();
        try {
            Setting::setSetting($data);
            return redirect()
                ->back()
                ->with('success', 'تم حفظ الإعدادات بنجاح');
        } catch (Exception $e) {
            return back()
                ->with('error', 'حدث خطأ أثناء حفظ الإعدادات')
                ->withInput();
        }
    }
}