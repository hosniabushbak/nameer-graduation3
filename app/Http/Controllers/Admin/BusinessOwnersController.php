<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessOwner\CreateBusinessOwnerRequest;
use App\Http\Resources\Admin\BusinessOwnerResource;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BusinessOwnersController extends Controller
{
    public function index()
    {
        return view('admin.business_owners.index');
    }

    public function datatable(Request $request)
    {
        $items = Owner::with('business')
            ->whereHas('business')
            ->orderBy('id', 'DESC')
            ->search($request);

        return $this->filterDataTable($items, $request, null, BusinessOwnerResource::class);
    }

    public function create()
    {
        return view('admin.business_owners.create');
    }

    public function store(CreateBusinessOwnerRequest $request)
    {
        $data = $request->validated();
        $businessData = $data['business'] ?? [];
        unset($data['business']);

        try {
            DB::beginTransaction();
            $owner = Owner::create($data);

            if($businessData) {
                // Handle damage photos
                if(isset($businessData['damage_photos'])) {
                    $damagePaths = [];
                    foreach($businessData['damage_photos'] as $photo) {
                        $owner->addMedia($photo)
                            ->toMediaCollection('business_damages');
                        // Optionally, store media URLs if you need them in the database
                        $damagePaths[] = $owner->getMedia('business_damages')->last()->getUrl();
                    }
                    $businessData['damage_photos'] = json_encode($damagePaths);
                }

                // Handle ownership document
                if(isset($businessData['ownership_document'])) {
                    $owner->addMedia($businessData['ownership_document'])
                        ->toMediaCollection('business_documents');
                    $businessData['ownership_document'] = $owner->getMedia('business_documents')->last()->getUrl();
                }

                // Handle licenses
                if(isset($businessData['licenses'])) {
                    $licensePaths = [];
                    foreach($businessData['licenses'] as $license) {
                        $owner->addMedia($license)
                            ->toMediaCollection('business_licenses');
                        $licensePaths[] = $owner->getMedia('business_licenses')->last()->getUrl();
                    }
                    $businessData['licenses'] = json_encode($licensePaths);
                }

                $owner->business()->create($businessData);
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
        $data['owner'] = Owner::with('business')->findOrFail($id);

        $data['is_active'] = $data['owner']->status == 1;

        if ($data['owner']->business) {
            $data['damagePhotos'] = $data['owner']->business->getMedia('damage_photos')->map(function($media) {
                return $media->getUrl();
            })->toArray();
            dd($data['owner']->business);
        } else {
            $data['damagePhotos'] = [];
        }

        return view('admin.business_owners.show', $data);
    }
    public function edit($id)
    {
        $data['owner'] = Owner::with('business')->findOrFail($id);
        return view('admin.business_owners.create', $data);
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
        $item->status = 1 - $item->status;
        $item->save();
        return $this->response_api(true, __('admin.form.status_changed_successfully'), 200);
    }
}