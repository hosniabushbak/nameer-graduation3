<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $settings = new \App\Models\Setting();
    @endphp
    <title>{{ $settings->valueOf('company_name', 'نموذج تقييم الأضرار') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.rtl.min.css" rel="stylesheet">
    @if($settings->logoUrl)
        <link rel="icon" type="image/png" href="{{ $settings->logoUrl }}">
    @endif
</head>
<body>
@if($settings->valueOf('maintenance_mode'))
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow text-center">
                    <div class="card-body">
                        <h3>الموقع تحت الصيانة</h3>
                        <p class="lead">{{ $settings->valueOf('maintenance_message', 'عذراً، الموقع تحت الصيانة حالياً. يرجى المحاولة لاحقاً.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex align-items-center justify-content-center">
                            @if($settings->logoUrl)
                                <img src="{{ $settings->logoUrl }}" alt="Logo" height="40" class="me-2">
                            @endif
                            <h3 class="mb-0">{{ $settings->valueOf('company_name', 'نموذج تقييم الأضرار') }}</h3>
                        </div>
                    </div>
                <div class="card-body">
                    <!-- اختيار نوع العقار -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">نوع العقار</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="propertyType" value="house" id="houseType" checked onchange="toggleForms()">
                                <label class="form-check-label" for="houseType">
                                    منزل سكني
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="propertyType" value="business" id="businessType" onchange="toggleForms()">
                                <label class="form-check-label" for="businessType">
                                    منشأة تجارية
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- نموذج المنزل -->
                    <form method="post" action="{{ route('storeDamages') }}" id="houseForm">
                        @csrf
                        <h4 class="mb-3">معلومات المالك</h4>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">الاسم الكامل</label>
                                <input name="name" type="text" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">رقم الهوية</label>
                                <input name="id_number" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">رقم الجوال</label>
                                <input name="phone" type="tel" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">البريد الإلكتروني</label>
                                <input name="email" type="email" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">العنوان</label>
                            <textarea  name="address" class="form-control" rows="2" required></textarea>
                        </div>

                        <h4 class="mb-3 mt-4">معلومات العقار</h4>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">نوع الملكية</label>
                                <select name="ownership_type" class="form-select" required>
                                    <option value="">اختر...</option>
                                    <option value="owned">ملك</option>
                                    <option value="rented">إيجار</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">مساحة الأرض (متر مربع)</label>
                                <input name="land_area" type="number" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">مساحة البناء</label>
                                <input name="building_area" type="number" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">عدد الطوابق</label>
                                <input name="floors_count" type="number" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">عدد الغرف</label>
                                <input  name="rooms_count" type="number" class="form-control" required>
                            </div>
                        </div>

                        <h4 class="mb-3 mt-4">تقييم الأضرار</h4>
                        <div class="mb-3">
                            <label class="form-label">حالة المبنى</label>
                            <select name="damage_level" class="form-select" required>
                                <option value="">اختر...</option>
                                <option value="partial">متضرر جزئياً</option>
                                <option value="total">متضرر كلياً</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">وصف الأضرار</label>
                            <textarea name="damage_description" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">صور الأضرار</label>
                            <input name="damage_photos" type="file" class="form-control" multiple accept="image/*">
                        </div>
                        <div class="mt-4">
                            <input type="submit" value="إرسال النموذج" class="btn btn-primary w-100">
                        </div>
                    </form>

                    <!-- نموذج المنشأة -->
                    <form method="post" action="{{ route('storeB') }}" id="businessForm" style="display: none;">
                        @csrf
                        <h4 class="mb-3">معلومات المنشأة</h4>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">اسم المنشأة</label>
                                <input name="business_name" type="text" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">السجل التجاري</label>
                                <input name="commercial_registration" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">اسم المالك/المسؤول</label>
                                <input name="name" type="text" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">رقم الهوية</label>
                                <input  name="id_number" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">رقم الجوال</label>
                                <input name="phone" type="tel" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">البريد الإلكتروني</label>
                                <input name="email" type="email" class="form-control" required>
                            </div>
                        </div>

                        <h4 class="mb-3 mt-4">معلومات المبنى</h4>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">نوع النشاط التجاري</label>
                                <input name="business_type" type="text" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">عدد العاملين</label>
                                <input  name="employees_count" type="number" class="form-control" required>
                            </div>
                            <div class="mb-12">
                                <label class="form-label">العنوان الخاص بالمنشأة</label>
                                <textarea  name="pre_disaster_address" class="form-control" rows="2" required></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">مساحة الأرض (متر مربع)</label>
                                <input name="land_area" type="number" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">مساحة البناء (متر مربع)</label>
                                <input name="building_area" type="number" class="form-control" required>
                            </div>
                        </div>

                        <h4 class="mb-3 mt-4">تقييم الأضرار</h4>
                        <div class="mb-3">
                            <label class="form-label">حالة المنشأة</label>
                            <select name="damage_level" class="form-select" required>
                                <option value="">اختر...</option>
                                <option value="partial">متضرر جزئياً</option>
                                <option value="total">متضرر كلياً</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">خسائر المعدات والأجهزة</label>
                            <textarea name="equipment_losses" class="form-control" rows="2" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">خسائر المخزون</label>
                            <textarea name="inventory_losses" class="form-control" rows="2" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">صور الأضرار</label>
                            <input name="damage_photos" type="file" class="form-control" multiple accept="image/*">
                        </div>
                        <div class="mt-4">
                            <input type="submit" value="إرسال النموذج" class="btn btn-primary w-100">
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-center">
        <div class="small text-muted">
            @if($phone = $settings->valueOf('company_phone'))
                <span class="me-2">{{ $phone }}</span>
            @endif

            @if($email = $settings->valueOf('company_email'))
                <span class="mx-2">|</span>
                <a href="mailto:{{ $email }}">{{ $email }}</a>
            @endif

            @if($address = $settings->valueOf('company_address'))
                <div class="mt-1">
                    {{ $address }}
                </div>
            @endif
        </div>
    </div>
</div>

@endif
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleForms() {
        const houseForm = document.getElementById('houseForm');
        const businessForm = document.getElementById('businessForm');
        const propertyType = document.querySelector('input[name="propertyType"]:checked').value;

        if (propertyType === 'house') {
            houseForm.style.display = 'block';
            businessForm.style.display = 'none';
        } else {
            houseForm.style.display = 'none';
            businessForm.style.display = 'block';
        }
    }
</script>
</body>
</html>