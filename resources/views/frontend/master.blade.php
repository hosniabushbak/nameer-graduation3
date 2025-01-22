<!DOCTYPE html>
<html dir="{{ __('ar.dir') }}" lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings->valueOf('company_name', __('ar.site_title')) }}</title>
    @if(app()->getLocale() == 'ar')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.rtl.min.css" rel="stylesheet">
    @else
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    @endif
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
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/') }}">{{ __('ar.nav.home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('about') }}">{{ __('ar.nav.about') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('faq') }}">{{ __('ar.nav.faq') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('contact') }}">{{ __('ar.nav.contact') }}</a>
                </li>
            </ul>

            <!-- Language Switcher -->
            <div class="mx-3">
                <div class="dropdown">
                    <button class="btn btn-outline-light dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ app()->getLocale() == 'ar' ? 'العربية' : 'English' }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                        <li><a class="dropdown-item {{ app()->getLocale() == 'ar' ? 'active' : '' }}" href="{{ route('language.switch', 'ar') }}">العربية</a></li>
                        <li><a class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}" href="{{ route('language.switch', 'en') }}">English</a></li>
                    </ul>
                </div>
            </div>

            <button class="btn btn-outline-light" onclick="window.location.href='{{ route('form') }}'">
                {{ __('ar.nav.submit') }}
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
                <h5>{{ __('ar.footer.contact_info') }}</h5>
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
                <h5>{{ __('ar.footer.quick_links') }}</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('form') }}" class="text-white">{{ __('ar.footer.submit') }}</a></li>
                    <li><a href="#" class="text-white">{{ __('ar.footer.faq') }}</a></li>
                    <li><a href="#" class="text-white">{{ __('ar.footer.contact') }}</a></li>
                </ul>
            </div>
            <div class="col-md-4 text-md-end">
                @if($settings->logoUrl)
                    <img src="{{ $settings->logoUrl }}" alt="Logo" height="60" class="mb-3">
                @endif
                <p class="small">{{ $settings->valueOf('company_name') }} © {{ date('Y') }}</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>