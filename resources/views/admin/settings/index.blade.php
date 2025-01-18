@extends('admin.layouts.master')

@section('content')
    <div class="card">
        @if (session()->has('success_message'))
            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                {{ session('success_message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session()->has('error_message'))
            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                {{ session('error_message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card-header">
            <h3 class="card-title">إعدادات النظام</h3>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card-body">
                <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_general">
                            <i class="fas fa-building me-2"></i>إعدادات الشركة
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_maintenance">
                            <i class="fas fa-tools me-2"></i>وضع الصيانة
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <!-- إعدادات الشركة -->
                    <div class="tab-pane fade show active" id="kt_tab_general">
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <label class="form-label required">اسم الشركة</label>
                                <input type="text" name="company_name" class="form-control @error('company_name') is-invalid @enderror"
                                       value="{{ old('company_name', $settings->valueOf('company_name')) }}">
                                @error('company_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label required">البريد الإلكتروني</label>
                                <input type="email" name="company_email" class="form-control @error('company_email') is-invalid @enderror"
                                       value="{{ old('company_email', $settings->valueOf('company_email')) }}">
                                @error('company_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-6">
                                <label class="form-label required">رقم الهاتف</label>
                                <input type="text" name="company_phone" class="form-control @error('company_phone') is-invalid @enderror"
                                       value="{{ old('company_phone', $settings->valueOf('company_phone')) }}">
                                @error('company_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">العنوان</label>
                                <input type="text" name="company_address" class="form-control @error('company_address') is-invalid @enderror"
                                       value="{{ old('company_address', $settings->valueOf('company_address')) }}">
                                @error('company_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="form-label">شعار الشركة</label>
                            <input type="file" name="company_logo" class="form-control @error('company_logo') is-invalid @enderror">
                            @error('company_logo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            @if($settings->logoUrl)
                                <div class="mt-2">
                                    <img src="{{ $settings->logoUrl }}" alt="Logo" height="50">
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- وضع الصيانة -->
                    <div class="tab-pane fade" id="kt_tab_maintenance">
                        <div class="form-check form-switch form-check-custom form-check-solid mb-5">
                            <input class="form-check-input h-30px w-50px" type="checkbox"
                                   name="maintenance_mode" id="maintenance_switch" value="1"
                                    {{ $settings->valueOf('maintenance_mode') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label ms-3" for="maintenance_switch">
                                تفعيل وضع الصيانة
                            </label>
                            <input type="hidden" name="maintenance_mode" value="0">
                        </div>

                        <div class="mb-5" id="maintenance_message_div">
                            <label class="form-label">رسالة الصيانة</label>
                            <textarea name="maintenance_message" rows="4"
                                      class="form-control @error('maintenance_message') is-invalid @enderror">{{ old('maintenance_message', $settings->valueOf('maintenance_message')) }}</textarea>
                            @error('maintenance_message')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">هذه الرسالة ستظهر للزوار عندما يكون الموقع في وضع الصيانة</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>حفظ الإعدادات
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const maintenanceSwitch = document.getElementById('maintenance_switch');
            const maintenanceMessageDiv = document.getElementById('maintenance_message_div');

            function toggleMaintenanceMessage() {
                maintenanceMessageDiv.style.display = maintenanceSwitch.checked ? 'block' : 'none';
            }

            maintenanceSwitch.addEventListener('change', toggleMaintenanceMessage);
            toggleMaintenanceMessage();
        });
    </script>
@endpush