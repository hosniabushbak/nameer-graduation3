<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Http\Requests\Admin\CreateAdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;

class AdminController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admins.index');
    }

    public function datatable(Request $request) 
    {
        $items = Admin::query()->whereNot('name', 'Super Admin')->orderBy('id', 'DESC')->search($request);
        return $this->filterDataTable($items, $request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAdminRequest $request)
    {            
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        try {
            DB::beginTransaction();
                $admin = Admin::create($data);
            DB::commit();
    
            return $this->response_api( true, __('admin.form.added_successfully'), 200);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response_api(false, $this->exMessage($e));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['admin'] = Admin::findOrFail($id);
        return view('admin.admins.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, $id)
    {
        $data = $request->validated();
        $admin = Admin::findOrFail($id);
        if($request->password){
            $data['password'] = Hash::make($request->password);
        }
        try {
            DB::beginTransaction();
                $admin->update($data);

            DB::commit();

            return $this->response_api( true, __('admin.form.updated_successfully'), 200);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response_api(false, $this->exMessage($e));
        }
    }

    public function activate($id)
    {
        $item = Admin::findOrFail($id);
        if (empty($item)) {
            return $this->response_api(true, __('admin.form.not_existed'), 404);
        }
        $item->status = 1 - $item->status;
        $item->save();
        return $this->response_api(true,  __('admin.form.status_changed_successfully'), 200);
    }

    public function exportPdf() 
    {
        dd('exportPdf method doesnt exist');
        // $data = Admin::get();
        // $pdf = \PDF::loadView('clients.employees.exports.pdf',compact('data'));
        // return $pdf->download('employees.pdf');
    }

    public function exportExcel()
    {
        dd('exportExcel method doesnt exist');
        // return Excel::download(new EmployeeExport, 'employees.xlsx');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admin::destroy($id);
        return $this->response_api( true, __('admin.form.deleted_successfully'), 200);
    }


    public function bluckDestroy(Request $request) 
    {
        $ids = $request->id;
        foreach ($ids as $row) {
            $item = Admin::find($row);
            if(!$item) {
                return $this->response_api(false ,  __('admin.form.not_existed') , 404);
            }
            $item->delete();
        }
        return $this->response_api(true ,  __('admin.form.deleted_successfully') , 200);
    }
}
