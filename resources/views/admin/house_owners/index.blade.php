{{-- index.blade.php --}}
@extends('admin.layouts.master', ['is_active_parent' => 'user_management','is_active'=> 'house_owners'])
@section('title')
    {{ __('admin.global.house_owners') }}
@endsection
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <div class="page-content-header">
                        <div class="row justify-content-between">
                            <div class="col-3">
                                <h2 class="table-title">{{ __('admin.global.house_owners') }}</h2>
                            </div>
                            <div class="col-8">
                                <div class="card-toolbar flex-row-fluid d-flex justify-content-end gap-5">
                                    <a class="btn btn-primary" href="{{ route('admin.house_owners.create') }}">
                                        {{ __('admin.global.add_new_house_owner') }}
                                        <span class="svg-icon svg-icon-2">+</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <div class="card-title">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="currentColor"/>
                                            <path opacity="0.3" d="M11 20C6.5 20 3 16.5 3 12C3 7.5 6.5 4 11 4C15.5 4 19 7.5 19 12C19 16.5 15.5 20 11 20ZM11 6C7.6 6 5 8.6 5 12C5 15.4 7.6 18 11 18C14.4 18 17 15.4 17 12C17 8.6 14.4 6 11 6Z" fill="currentColor"/>
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control form-control-solid w-250px ps-14"
                                           placeholder="{{ __('admin.global.search') }}"
                                           data-kt-docs-table-filter="search">
                                </div>
                            </div>
                        </div>

                        <div class="card-body pt-0">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="oc_datatable">
                                <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th>#</th>
                                    <th>{{ __('admin.form.name') }}</th>
                                    <th>{{ __('admin.form.email') }}</th>
                                    <th>{{ __('admin.form.phone') }}</th>
                                    <th>{{ __('admin.form.id_number') }}</th>
                                    <th>{{ __('admin.form.property_info') }}</th>
                                    <th>{{ __('admin.form.status') }}</th>
                                    <th>{{ __('admin.form.created_at') }}</th>
                                    <th>{{ __('admin.form.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        window.datatable_url = "{{ route('admin.house_owners.datatable') }}";
        window.columns = [
            {data: 'id'},
            {data: 'name'},
            {data: 'email'},
            {data: 'phone'},
            {data: 'id_number'},
            {data: 'property_info'},
            {data: 'status'},
            {data: 'created_at'},
            {data: 'operations'}
        ];
        window.columnDefs = [
            {
                targets: 0,
                orderable: false,
                sorting: false
            },
            {
                targets: -1,
                orderable: false,
            }
        ];
    </script>
    <script src="{{ asset('admin/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('admin/js/dashboard/handleDataTable.js') }}"></script>
@endpush