<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings->valueOf('company_name', 'نظام تقييم الأضرار') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="{{asset('frontend/assets/css/index.css')}}" rel="stylesheet">
    @if($settings->logoUrl)
        <link rel="icon" type="image/png" href="{{ $settings->logoUrl }}">
    @endif
    @yield('css')
</head>
<body>

<!-- Header Section -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">
            @if($settings->logoUrl)
                <img src="{{ $settings->logoUrl }}" alt="Logo" height="40">
            @endif
{{--            {{ $settings->valueOf('company_name', 'نظام تقييم الأضرار') }}--}}
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/') }}">الرئيسية</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('about') }}">من نحن</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('faq') }}">الأسئلة الشائعة</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active"  href="{{ route('contact') }}">تواصل معنا</a>
                </li>
            </ul>
            <button class="btn btn-outline-light" onclick="window.location.href='{{ route('form') }}'">
                تقديم طلب
            </button>
        </div>
    </div>
</nav>

@yield('content')

<!-- Footer -->
<footer class="bg-dark text-white py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>معلومات الاتصال</h5>
                @if($phone = $settings->valueOf('company_phone'))
                    <p><i class="fas fa-phone me-2"></i>{{ $phone }}</p>
                @endif
                @if($email = $settings->valueOf('company_email'))
                    <p><i class="fas fa-envelope me-2"></i>{{ $email }}</p>
                @endif
                @if($address = $settings->valueOf('company_address'))
                    <p><i class="fas fa-map-marker-alt me-2"></i>{{ $address }}</p>
                @endif
            </div>
            <div class="col-md-4">
                <h5>روابط سريعة</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('form') }}" class="text-white">تقديم طلب</a></li>
                    <li><a href="#" class="text-white">الأسئلة الشائعة</a></li>
                    <li><a href="#" class="text-white">تواصل معنا</a></li>
                </ul>
            </div>
            <div class="col-md-4 text-md-end">
                <img src="{{ $settings->logoUrl }}" alt="Logo" height="60" class="mb-3">
                <p class="small">{{ $settings->valueOf('company_name') }} © {{ date('Y') }}</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>