@extends('frontend.master')
@section('css')
    <style>
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url({{asset('frontend/assets/images/gaza.jpeg')}});
            background-size: cover;
            background-position: center;
        }
    </style>
@endsection
@section('content')
<section class="hero-section d-flex align-items-center text-center">
    <div class="container">
        <h1 class="display-4 mb-4">نظام تقييم الأضرار</h1>
        <p class="lead mb-5">منصة متكاملة لتقييم وتوثيق الأضرار للمنازل والمنشآت التجارية</p>
        <a href="{{ route('form') }}" class="btn btn-primary btn-lg px-5 py-3">
            <i class="fas fa-file-alt me-2"></i>
            تقديم طلب الآن
        </a>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">مميزات النظام</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 feature-card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon-circle mb-3">
                            <i class="fas fa-clipboard-check fa-2x"></i>
                        </div>
                        <h4 class="card-title">سهولة التقديم</h4>
                        <p class="card-text">نموذج بسيط وسهل التعبئة لتقديم طلبات تقييم الأضرار</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 feature-card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon-circle mb-3">
                            <i class="fas fa-camera fa-2x"></i>
                        </div>
                        <h4 class="card-title">توثيق شامل</h4>
                        <p class="card-text">إمكانية إرفاق الصور والوثائق لتوثيق الأضرار بشكل دقيق</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 feature-card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon-circle mb-3">
                            <i class="fas fa-chart-line fa-2x"></i>
                        </div>
                        <h4 class="card-title">متابعة فعالة</h4>
                        <p class="card-text">نظام متابعة متكامل لحالة الطلبات والتقييمات</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-5">كيف يعمل النظام؟</h2>
        <div class="row g-4 align-items-center">
            <div class="col-md-6">
                <div class="px-4">
                    <div class="mb-4">
                        <h5><i class="fas fa-1 me-2 text-primary"></i> تعبئة النموذج</h5>
                        <p>قم بتعبئة النموذج الإلكتروني مع إدخال كافة البيانات المطلوبة</p>
                    </div>
                    <div class="mb-4">
                        <h5><i class="fas fa-2 me-2 text-primary"></i> إرفاق الوثائق</h5>
                        <p>أرفق الصور والمستندات المطلوبة لتوثيق الأضرار</p>
                    </div>
                    <div>
                        <h5><i class="fas fa-3 me-2 text-primary"></i> متابعة الطلب</h5>
                        <p>تابع حالة طلبك وانتظر التواصل من فريق التقييم</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <img src="{{asset('frontend/assets/images/gaza2.jpg')}}" alt="How it works" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section text-center">
    <div class="container">
        <h2 class="mb-4">جاهز لتقديم طلبك؟</h2>
        <p class="lead mb-4">قم بتعبئة النموذج الآن وسنقوم بمساعدتك في تقييم الأضرار</p>
        <a href="{{ route('form') }}" class="btn btn-primary btn-lg px-5">
            <i class="fas fa-paper-plane me-2"></i>
            تقديم الطلب
        </a>
    </div>
</section>

@endsection

