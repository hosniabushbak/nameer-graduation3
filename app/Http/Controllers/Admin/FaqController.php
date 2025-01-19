<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Faqs\CreateFaqRequest;
use App\Http\Requests\Faqs\UpdateFaqRequest;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FaqController extends Controller
{
    public function index()
    {
        return view('admin.faqs.index');
    }

    public function datatable(Request $request)
    {
        $items = Faq::query()->orderBy('id', 'DESC')->search($request);
        return $this->filterDataTable($items, $request);
    }

    public function create()
    {
        return view('admin.faqs.create');
    }

    public function store(CreateFaqRequest $request)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();
            Faq::create($data);
            DB::commit();

            return $this->response_api(true, __('admin.form.added_successfully'), 200);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response_api(false, $this->exMessage($e));
        }
    }

    public function edit($id)
    {
        $data['faq'] = Faq::findOrFail($id);
        return view('admin.faqs.create', $data);
    }

    public function update(UpdateFaqRequest $request, $id)
    {
        $data = $request->validated();
        $faq = Faq::findOrFail($id);

        try {
            DB::beginTransaction();
            $faq->update($data);
            DB::commit();

            return $this->response_api(true, __('admin.form.updated_successfully'), 200);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response_api(false, $this->exMessage($e));
        }
    }

    public function activate($id)
    {
        $item = Faq::findOrFail($id);
        if (empty($item)) {
            return $this->response_api(true, __('admin.form.not_existed'), 404);
        }
        $item->status = 1 - $item->status;
        $item->save();
        return $this->response_api(true, __('admin.form.status_changed_successfully'), 200);
    }

    public function destroy($id)
    {
        Faq::destroy($id);
        return $this->response_api(true, __('admin.form.deleted_successfully'), 200);
    }

    public function bluckDestroy(Request $request)
    {
        $ids = $request->id;
        foreach ($ids as $row) {
            $item = Faq::find($row);
            if(!$item) {
                return $this->response_api(false, __('admin.form.not_existed'), 404);
            }
            $item->delete();
        }
        return $this->response_api(true, __('admin.form.deleted_successfully'), 200);
    }
}