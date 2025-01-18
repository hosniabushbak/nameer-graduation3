@extends('admin.layouts.master', ['is_active_parent' => 'home','is_active'=> 'home'])
@section('title')
    لوحة التحكم
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="row g-5 g-xl-10">
                    <!-- بطاقة الترحيب والإحصائيات -->
                    <div class="col-xl-4 mb-xl-10">
                        <div class="card card-flush h-xl-100">
                            <div class="card-header rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-250px"
                                 style="background-image:url('{{ asset('admin/media/svg/shapes/top-green.png') }}" data-theme="light">
                                <h3 class="card-title align-items-start flex-column text-white pt-15">
                                    <span class="fw-bold fs-2x mb-3">مرحباً بك</span>
                                    <div class="fs-4 text-white">
                                        <span class="opacity-75">لديك تقارير أضرار جديدة تحتاج للمراجعة</span>
                                    </div>
                                </h3>
                            </div>

                            <div class="card-body mt-n20">
                                <div class="mt-n20 position-relative">
                                    <div class="row g-3 g-lg-6">
                                        <!-- إحصائية ملاك البيوت -->
                                        <div class="col-6">
                                            <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                <div class="symbol symbol-30px me-5 mb-8">
                                                <span class="symbol-label">
                                                    <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                        <i class="fas fa-home"></i>
                                                    </span>
                                                </span>
                                                </div>
                                                <div class="m-0">
                                                    <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">{{ $house_owners_count }}</span>
                                                    <span class="text-gray-500 fw-semibold fs-6">ملاك البيوت</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- إحصائية ملاك الأعمال -->
                                        <div class="col-6">
                                            <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                <div class="symbol symbol-30px me-5 mb-8">
                                                <span class="symbol-label">
                                                    <span class="svg-icon svg-icon-1 svg-icon-success">
                                                        <i class="fas fa-store"></i>
                                                    </span>
                                                </span>
                                                </div>
                                                <div class="m-0">
                                                    <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">{{ $business_owners_count }}</span>
                                                    <span class="text-gray-500 fw-semibold fs-6">ملاك الأعمال</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- إحصائية تقارير الأضرار -->
                                        <div class="col-6">
                                            <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                <div class="symbol symbol-30px me-5 mb-8">
                                                <span class="symbol-label">
                                                    <span class="svg-icon svg-icon-1 svg-icon-warning">
                                                        <i class="fas fa-file-alt"></i>
                                                    </span>
                                                </span>
                                                </div>
                                                <div class="m-0">
                                                    <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">{{ $damage_reports_count }}</span>
                                                    <span class="text-gray-500 fw-semibold fs-6">تقارير الأضرار</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- إجمالي الأضرار المقدرة -->
                                        <div class="col-6">
                                            <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                <div class="symbol symbol-30px me-5 mb-8">
                                                <span class="symbol-label">
                                                    <span class="svg-icon svg-icon-1 svg-icon-danger">
                                                        <i class="fas fa-dollar-sign"></i>
                                                    </span>
                                                </span>
                                                </div>
                                                <div class="m-0">
                                                    <span class="fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">{{ number_format($total_damages) }} ر.س</span>
                                                    <span class="text-gray-500 fw-semibold fs-6">إجمالي الأضرار</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8 mb-5 mb-xl-10">
                        <div class="card card-flush h-xl-100">
                            <div class="card-header pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-800">آخر التقارير المضافة</span>
                                    <span class="text-gray-400 pt-1 fw-semibold fs-6">خلال الأسبوع الماضي</span>
                                </h3>
                            </div>

                            <div class="card-body py-3">
                                <div class="table-responsive">
                                    <table class="table table-row-dashed align-middle gs-0 gy-4">
                                        <thead>
                                        <tr class="fs-7 fw-bold border-0 text-gray-400">
                                            <th>المالك</th>
                                            <th>نوع الملكية</th>
                                            <th>مستوى الضرر</th>
                                            <th>التكلفة المقدرة</th>
                                            <th>الحالة</th>
                                            <th>الإجراءات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($recent_reports as $report)
                                            <tr>
                                                <td>{{ $report->owner->name }}</td>
                                                <td>{{ $report->property_type }}</td>
                                                <td>
                                                <span class="badge badge-light-{{ $report->damage_level_color }}">
                                                    {{ $report->damage_level }}
                                                </span>
                                                </td>
                                                <td>{{ number_format($report->estimated_cost) }} ر.س</td>
                                                <td>
                                                <span class="badge badge-light-{{ $report->status_color }}">
                                                    {{ $report->status }}
                                                </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.reports.show', $report->id) }}"
                                                       class="btn btn-sm btn-light btn-active-light-primary">
                                                        عرض
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-5 g-xl-10">
                    <div class="col-12">
                        <div class="card card-flush h-xl-100">
                            <div class="card-header pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-800">تحليل الأضرار حسب المنطقة</span>
                                </h3>
                            </div>
                            <div class="card-body py-3">
                                <div class="table-responsive">
                                    <table class="table table-row-dashed align-middle gs-0 gy-4">
                                        <thead>
                                        <tr class="fs-7 fw-bold border-0 text-gray-400">
                                            <th>المنطقة</th>
                                            <th>عدد البيوت المتضررة</th>
                                            <th>عدد الأعمال المتضررة</th>
                                            <th>إجمالي الأضرار</th>
                                            <th>نسبة الأضرار</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($damage_analysis as $area)
                                            <tr>
                                                <td>{{ $area->name }}</td>
                                                <td>{{ $area->damaged_houses_count }}</td>
                                                <td>{{ $area->damaged_businesses_count }}</td>
                                                <td>{{ number_format($area->total_damages) }} ر.س</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="progress h-6px w-100 me-2">
                                                            <div class="progress-bar bg-primary" style="width: {{ $area->damage_percentage }}%"
                                                                 role="progressbar" aria-valuenow="{{ $area->damage_percentage }}"
                                                                 aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <span class="text-gray-400 fw-bold">{{ $area->damage_percentage }}%</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
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
        window.datatable_url = "{{ route('admin.reports.datatable') }}";
    </script>
    <script src="{{ asset('admin/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('admin/js/dashboard/handleDataTable.js') }}"></script>
@endpush