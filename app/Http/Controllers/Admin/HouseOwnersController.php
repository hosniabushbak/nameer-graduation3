<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HouseOwner\CreateHouseOwnerRequest;
use App\Http\Resources\Admin\HouseOwnerResource;
use App\Models\Owner;
use App\Models\House;
use App\Traits\SaveImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HouseOwnersController extends Controller
{
    use SaveImageTrait;

    public function index()
    {
        return view('admin.house_owners.index');
    }

    public function datatable(Request $request)
    {
        $items = Owner::houseOwners()
            ->orderBy('id', 'DESC')
            ->search($request);

        return $this->filterDataTable(
            items: $items,
            request: $request,
            resource: HouseOwnerResource::class
        );
    }

    public function create()
    {
        return view('admin.house_owners.create');
    }

    public function store(CreateHouseOwnerRequest $request)
    {
        $data = $request->validated();
        $houseData = $data['house'] ?? [];
        unset($data['house']);

        try {
            DB::beginTransaction();
            $owner = Owner::create($data);

            if($houseData) {
                if(isset($houseData['damage_photos'])) {
                    $photos = [];
                    foreach($houseData['damage_photos'] as $photo) {
                        $photos[] = $this->uploadImage($photo, 'house_damages');
                    }
                    $houseData['damage_photos'] = $photos;
                }

                if(isset($houseData['ownership_document'])) {
                    $houseData['ownership_document'] = $this->uploadImage($houseData['ownership_document'], 'house_documents');
                }

                if(isset($houseData['inspection_report'])) {
                    $houseData['inspection_report'] = $this->uploadImage($houseData['inspection_report'], 'house_reports');
                }

                $owner->house()->create($houseData);
            }

            DB::commit();
            return $this->response_api(true, __('admin.form.added_successfully'), 200);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response_api(false, $this->exMessage($e));
        }
    }

    public function show($id)
    {
        $data['owner'] = Owner::with('house')->findOrFail($id);
        return view('admin.house_owners.show', $data);
    }

    public function edit($id)
    {
        $data['owner'] = Owner::with('house')->findOrFail($id);
        return view('admin.house_owners.create', $data);
    }

    public function update(CreateHouseOwnerRequest $request, $id)
    {
        $data = $request->validated();
        $houseData = $data['house'] ?? [];
        unset($data['house']);

        $owner = Owner::findOrFail($id);

        try {
            DB::beginTransaction();
            $owner->update($data);

            if($houseData) {
                if(isset($houseData['damage_photos'])) {
                    $photos = [];
                    foreach($houseData['damage_photos'] as $photo) {
                        $photos[] = $this->uploadImage($photo, 'house_damages');
                    }
                    $houseData['damage_photos'] = $photos;
                }

                if(isset($houseData['ownership_document'])) {
                    $houseData['ownership_document'] = $this->uploadImage($houseData['ownership_document'], 'house_documents');
                }

                if(isset($houseData['inspection_report'])) {
                    $houseData['inspection_report'] = $this->uploadImage($houseData['inspection_report'], 'house_reports');
                }

                if($owner->house) {
                    $owner->house->update($houseData);
                } else {
                    $owner->house()->create($houseData);
                }
            }

            DB::commit();
            return $this->response_api(true, __('admin.form.updated_successfully'), 200);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response_api(false, $this->exMessage($e));
        }
    }

    public function destroy($id)
    {
        Owner::destroy($id);
        return $this->response_api(true, __('admin.form.deleted_successfully'), 200);
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->id;
        foreach ($ids as $row) {
            $item = Owner::find($row);
            if(!$item) {
                return $this->response_api(false, __('admin.form.not_existed'), 404);
            }
            $item->delete();
        }
        return $this->response_api(true, __('admin.form.deleted_successfully'), 200);
    }

    public function activate($id)
    {
        $item = Owner::findOrFail($id);
        if (empty($item)) {
            return $this->response_api(true, __('admin.form.not_existed'), 404);
        }
        $item->status = 1 - $item->status;
        $item->save();
        return $this->response_api(true, __('admin.form.status_changed_successfully'), 200);
    }
}