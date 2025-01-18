@extends('admin.layouts.master', ['is_active_parent' => 'user_management','is_active'=> 'students'])
@section('title')
    {{ __('admin.global.add_new_student') }}
@endsection
@section('content')
    <form id="kt_form" class="form" data-kt-redirect="{{ route('admin.students.index') }}"
            action="{{ isset($student) ? route('admin.students.update' ,  $student->id) : route('admin.students.store') }}">
        @csrf
        @isset($student)
            @method('PATCH')
        @endif

        <div class="">
            <div class="page-content-header">
                <h2 class="table-title">{{ __('admin.global.add_new_student') }}</h2>
            </div>
            <div class="card card-flush">
                <div class="card-body">
                    <div class="new-user-form" id="new-user-form">
                        <div class="formContent">
                            
                            <div class="row g-9 mb-7">
                                <div class="fv-row">
                                    <label class="fs-6 fw-semibold mb-2">
                                        <span class="required">{{ __('admin.form.name') }}</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="" name="name" value="{{ isset($student) ? $student->name:'' }}">
                                </div> 
                                <div class="fv-row">
                                    <label class="fs-6 fw-semibold mb-2">
                                        <span class="required">{{ __('admin.form.phone_code') }}</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="972" name="phone_code" value="{{ isset($student) ? $student->phone_code:'' }}">
                                </div>
                                <div class="fv-row">
                                    <label class="fs-6 fw-semibold mb-2">
                                        <span class="required">{{ __('admin.form.phone') }}</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="596123456" name="phone" value="{{ isset($student) ? $student->phone:'' }}">
                                </div>
                                <div class="fv-row">
                                    <label class="fs-6 fw-semibold mb-2">
                                        <span class="required">{{ __('admin.form.email') }}</span>
                                    </label>
                                    <input type="email" class="form-control form-control-solid"
                                        placeholder="" name="email" value="{{ isset($student) ? $student->email:'' }}">
                                </div>
                                <div class="fv-row">
                                    <label class="fs-6 fw-semibold mb-2">
                                        <span class="required">{{ __('admin.form.description_ar') }}</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="" name="description_ar" value="{{ isset($student) ? $student->description_ar:'' }}">
                                </div>
                                <div class="fv-row">
                                    <label class="fs-6 fw-semibold mb-2">
                                        <span class="required">{{ __('admin.form.description_en') }}</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="" name="description_en" value="{{ isset($student) ? $student->description_en:'' }}">
                                </div>
                                <div class="fv-row">
                                    <label class="fs-6 fw-semibold mb-2">
                                        <span class="required">{{ __('admin.form.username') }}</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="" name="username" value="{{ isset($student) ? $student->username:'' }}">
                                </div>
                                <div class="fv-row">
                                    <label class="fs-6 fw-semibold mb-2">
                                        <span class="required">{{ __('admin.form.password') }}</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="" name="password" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-buttuns mt-5">
                <div class="row justify-content-between">
                    <div class="d-flex justify-content-end right">
                        <button type="submit" id="kt_submit" class="btn btn-primary">
                            <span class="indicator-label">{{ __('admin.form.save') }}</span>
                            <span class="indicator-progress">{{ __('admin.form.please_wait') }}
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                        <a href="{{ route('admin.students.index') }}" id="kt_ecommerce_add_product_cancel"
                            class="btn btn-light me-5 cancel">{{ __('admin.form.cancel') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('scripts')
    <script src="{{ asset('admin/js/dashboard/handleSubmitForm.js') }}"></script>
@endpush
