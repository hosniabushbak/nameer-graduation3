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
            <h1 class="display-4 mb-4">{{ __('ar.hero.title') }}</h1>
            <p class="lead mb-5">{{ __('ar.hero.subtitle') }}</p>
            <a href="{{ route('form') }}" class="btn btn-primary btn-lg px-5 py-3">
                <i class="fas fa-file-alt me-2"></i>
                {{ __('ar.hero.submit_btn') }}
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">{{ __('ar.features.title') }}</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 feature-card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="icon-circle mb-3">
                                <i class="fas fa-clipboard-check fa-2x"></i>
                            </div>
                            <h4 class="card-title">{{ __('ar.features.easy_submission.title') }}</h4>
                            <p class="card-text">{{ __('ar.features.easy_submission.desc') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 feature-card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="icon-circle mb-3">
                                <i class="fas fa-camera fa-2x"></i>
                            </div>
                            <h4 class="card-title">{{ __('ar.features.documentation.title') }}</h4>
                            <p class="card-text">{{ __('ar.features.documentation.desc') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 feature-card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="icon-circle mb-3">
                                <i class="fas fa-chart-line fa-2x"></i>
                            </div>
                            <h4 class="card-title">{{ __('ar.features.tracking.title') }}</h4>
                            <p class="card-text">{{ __('ar.features.tracking.desc') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-5">{{ __('ar.how_it_works.title') }}</h2>
            <div class="row g-4 align-items-center">
                <div class="col-md-6">
                    <div class="px-4">
                        <div class="mb-4">
                            <h5><i class="fas fa-1 me-2 text-primary"></i> {{ __('ar.how_it_works.steps.step1.title') }}</h5>
                            <p>{{ __('ar.how_it_works.steps.step1.desc') }}</p>
                        </div>
                        <div class="mb-4">
                            <h5><i class="fas fa-2 me-2 text-primary"></i> {{ __('ar.how_it_works.steps.step2.title') }}</h5>
                            <p>{{ __('ar.how_it_works.steps.step2.desc') }}</p>
                        </div>
                        <div>
                            <h5><i class="fas fa-3 me-2 text-primary"></i> {{ __('ar.how_it_works.steps.step3.title') }}</h5>
                            <p>{{ __('ar.how_it_works.steps.step3.desc') }}</p>
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
    <section class="cta-section text-center py-5">
        <div class="container">
            <h2 class="mb-4">{{ __('ar.cta.title') }}</h2>
            <p class="lead mb-4">{{ __('ar.cta.subtitle') }}</p>
            <a href="{{ route('form') }}" class="btn btn-primary btn-lg px-5">
                <i class="fas fa-paper-plane me-2"></i>
                {{ __('ar.cta.button') }}
            </a>
        </div>
    </section>
@endsection