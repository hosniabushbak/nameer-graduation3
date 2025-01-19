@extends('admin.layouts.master', ['is_active' => 'faqs'])
@section('title')
    {{ isset($faq) ? 'تعديل سؤال' : 'إضافة سؤال جديد' }}
@endsection
@section('content')
    <form id="kt_form" class="form" data-kt-redirect="{{ route('admin.faqs.index') }}"
          action="{{ isset($faq) ? route('admin.faqs.update', $faq->id) : route('admin.faqs.store') }}">
        @csrf
        @isset($faq)
            @method('PATCH')
        @endif

        <div class="">
            <div class="page-content-header">
                <h2 class="table-title">{{ isset($faq) ? 'تعديل سؤال' : 'إضافة سؤال جديد' }}</h2>
            </div>
            <div class="card card-flush">
                <div class="card-body">
                    <div class="formContent">
                        <div class="row g-9 mb-7">
                            <div class="fv-row fv-plugins-icon-container">
                                <label class="required fs-6 fw-semibold mb-2">السؤال</label>
                                <input class="form-control form-control-solid" name="question"
                                       value="{{ isset($faq) ? $faq->question : '' }}">
                            </div>
                        </div>

                        <div class="row g-9 mb-7">
                            <div class="fv-row fv-plugins-icon-container">
                                <label class="required fs-6 fw-semibold mb-2">الإجابة</label>
                                <textarea class="form-control form-control-solid" rows="4"
                                          name="answer">{{ isset($faq) ? $faq->answer : '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-buttuns mt-5">
                <div class="row justify-content-between">
                    <div class="d-flex justify-content-end right">
                        <button type="submit" id="kt_submit" class="btn btn-primary">
                            <span class="indicator-label">حفظ</span>
                            <span class="indicator-progress">الرجاء الانتظار...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                        <a href="{{ route('admin.faqs.index') }}" id="kt_ecommerce_add_product_cancel"
                           class="btn btn-light me-5 cancel">إلغاء</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('scripts')
    <script src="{{ asset('admin/js/dashboard/handleSubmitForm.js') }}"></script>
@endpush