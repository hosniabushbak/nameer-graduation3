@extends('admin.layouts.master', ['is_active_parent' => 'home','is_active'=> 'home'])
@section('content')
    <div class="row g-5 g-xl-8 mb-5">
        <div class="col-xl-6">
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">توزيع المنازل والأعمال</span>
                    </h3>
                </div>
                <div class="card-body">
                    <canvas id="propertyDistribution" class="mh-400px"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">مستويات الضرر</span>
                    </h3>
                </div>
                <div class="card-body">
                    <canvas id="damageLevels" class="mh-400px"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-5 g-xl-8 mb-5">
        <div class="col-xl-8">
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <div class="card-header">
                    <h3 class="card-title">متوسط المساحات</h3>
                </div>
                <div class="card-body">
                    <canvas id="areasChart" class="mh-400px"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Original content... -->
@endsection

@push('scripts')
    <script src="{{ asset('admin/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('admin/js/dashboard/handleDataTable.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Chart(document.getElementById('propertyDistribution'), {
                type: 'doughnut',
                data: {
                    labels: ['المنازل', 'الأعمال التجارية'],
                    datasets: [{
                        data: @json($propertyDistribution),
                        backgroundColor: ['#009EF7', '#50CD89']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            new Chart(document.getElementById('damageLevels'), {
                type: 'bar',
                data: {
                    labels: ['بسيط', 'متوسط', 'شديد'],
                    datasets: [
                        {
                            label: 'المنازل',
                            data: @json($houseDamageLevels),
                            backgroundColor: '#009EF7'
                        },
                        {
                            label: 'الأعمال التجارية',
                            data: @json($businessDamageLevels),
                            backgroundColor: '#50CD89'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            new Chart(document.getElementById('areasChart'), {
                type: 'bar',
                data: {
                    labels: ['مساحة الأرض', 'مساحة البناء'],
                    datasets: [
                        {
                            label: 'المنازل',
                            data: [@json($averages['houses']['avg_land']), @json($averages['houses']['avg_building'])],
                            backgroundColor: '#009EF7'
                        },
                        {
                            label: 'الأعمال التجارية',
                            data: [@json($averages['businesses']['avg_land']), @json($averages['businesses']['avg_building'])],
                            backgroundColor: '#50CD89'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'المساحة (متر مربع)'
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush