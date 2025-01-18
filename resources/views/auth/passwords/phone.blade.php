@extends('frontend.layouts.master')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/intlTelInput.min.css') }}">
@endsection

@section('content')

<section class="my-5 py-3">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="d-flex justify-content-center align-items-center flex-column text-center m-auto p-4">
        <a href="{{ route('home') }}">
            <img src="{{ asset('frontend/assets/images/logo.png') }}" width="100" alt="logo">
        </a>
        <h3 class="my-1">نسيت كلمة المرور</h3>
        <p class="text-Register mt-1 mb-4">
            أرسال كود إعادة تعيين كلمة المرور
        </p>
        @if (count($errors) > 0)
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }} <br>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        <form method="POST" action="{{ route('send_reset_otp') }}">
            @csrf
            <div class="mb-3">
                {{-- <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" class="form-control border-0 shadow-none text-end" placeholder="رقم الموبايل">
                <input type="hidden" value="" name="phone_code" id="phone_code">
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror --}}
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control border-0 shadow-none text-end" placeholder="example@example.com">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100">أرسل</button>
        </form>

    </div>
</section>

@endsection

@section('js')
    <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/intlTelInput.min.js') }}"></script>
    <script>
        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            utilsScript: "{{ asset('frontend/assets/js/utils.js') }}",
        });

        var iti = intlTelInput(input);
        $(document).ready(function() {
            $('#phone_code').val(iti.getSelectedCountryData().dialCode);
            input.addEventListener("countrychange", function() {
                $('#phone_code').val(iti.getSelectedCountryData().dialCode);
            });
        });
    </script>
@endsection