@extends('admin.layouts.master', ['is_active' => 'faqs'])
@section('title')
    الأسئلة الشائعة
@endsection
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                @if (count($errors) > 0)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger alert-dismissible">
                                @foreach ($errors->all() as $error)
                                    {{ $error }} <br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <div class="page-content-header">
                        <div class="row justify-content-between">
                            <div class="col-3 col-sm-12 col-md-3 col-lg-3">
                                <h2 class="table-title">الأسئلة الشائعة</h2>
                            </div>
                            <div class="col-8 col-sm-12 col-md-9 col-lg-9">
                                <div class="card-toolbar flex-row-fluid d-flex justify-content-end gap-5">
                                    <a class="btn btn-primary" href="{{ route('admin.faqs.create') }}">
                                        إضافة سؤال جديد
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
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                                  rx="1" transform="rotate(45 17.0365 15.1223)"
                                                  fill="currentColor"></rect>
                                            <path
                                                    d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                    fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control form-control-solid w-250px ps-14"
                                           placeholder="بحث" data-kt-docs-table-filter="search">
                                </div>
                            </div>
                        </div>

                        <div class="card-body pt-0">
                            <div id="kt_ecommerce_sales_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                                           id="oc_datatable">
                                        <thead>
                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0 text-center">
                                            <th>#</th>
                                            <th>السؤال</th>
                                            <th>الإجابة</th>
                                            <th>الحالة</th>
                                            <th>العمليات</th>
                                        </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        window.datatable_url = "{{ route('admin.faqs.datatable') }}";
    </script>
    <script src="{{ asset('admin/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('admin/js/dashboard/faqs.js?v=' . $java_version) }}"></script>
    <script src="{{ asset('admin/js/dashboard/handleDataTable.js?v=' . $java_version) }}"></script>
@endpush