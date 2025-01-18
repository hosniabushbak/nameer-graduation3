@extends('admin.layouts.master')

@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header cursor-pointer">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">تفاصيل صاحب العمل المتضرر</h3>
                    </div>
                    <a href="{{ route('admin.business_owners.edit', $owner->id) }}" class="btn btn-primary align-self-center">
                        تعديل البيانات
                    </a>
                </div>

                <div class="card-body p-9">
                    <div class="row mb-7">
                        <div class="col-lg-4">
                            <div class="fw-bold fs-6 text-gray-600">الاسم</div>
                            <div class="fw-bolder fs-6 text-dark">{{ $owner->name ?? '-' }}</div>
                        </div>
                        <div class="col-lg-4">
                            <div class="fw-bold fs-6 text-gray-600">رقم الهاتف</div>
                            <div class="fw-bolder fs-6 text-dark">{{ $owner->phone ?? '-' }}</div>
                        </div>
                        <div class="col-lg-4">
                            <div class="fw-bold fs-6 text-gray-600">البريد الإلكتروني</div>
                            <div class="fw-bolder fs-6 text-dark">{{ $owner->email ?? '-' }}</div>
                        </div>
                    </div>

                    <div class="separator separator-dashed my-10"></div>

                    @if($owner->business)
                        <div class="row mb-7">
                            <div class="col-lg-4">
                                <div class="fw-bold fs-6 text-gray-600">اسم المنشأة</div>
                                <div class="fw-bolder fs-6 text-dark">{{ $owner->business->business_name ?? '-' }}</div>
                            </div>
                            <div class="col-lg-4">
                                <div class="fw-bold fs-6 text-gray-600">نوع النشاط</div>
                                <div class="fw-bolder fs-6 text-dark">{{ $owner->business->business_type ?? '-' }}</div>
                            </div>
                            <div class="col-lg-4">
                                <div class="fw-bold fs-6 text-gray-600">السجل التجاري</div>
                                <div class="fw-bolder fs-6 text-dark">{{ $owner->business->commercial_registration ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="separator separator-dashed my-10"></div>

                        <h3 class="text-dark fw-bolder mb-7">صور الأضرار</h3>

                        <div class="row">
                            @forelse($damagePhotos as $photo)
                                <div class="col-md-4 mb-5">
                                    <a href="{{ $photo }}" target="_blank">
                                        <img src="{{ $photo }}" class="img-fluid rounded shadow" alt="صورة الضرر">
                                    </a>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-light-warning">
                                        لا توجد صور للأضرار
                                    </div>
                                </div>
                            @endforelse
                            @else
                                <div class="col-12">
                                    <div class="alert alert-light-warning">
                                        لا توجد بيانات للمنشأة
                                    </div>
                                </div>
                            @endif
                        </div>
                </div>
            </div>
        </div>
@endsection