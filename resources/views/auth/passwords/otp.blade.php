@extends('frontend.layouts.master')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/intlTelInput.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/toastr.min.css') }}"/>
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
        <h3 class="my-1">أدخل كلمة المرور الجديدة</h3>
        {{-- <p class="text-Register mt-1 mb-4">
            أرسال رابط إعادة تعيين كلمة المرور
        </p> --}}
        {{-- @if (count($errors) > 0)
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }} <br>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif --}}
        <form method="POST" action="{{ route('reset_password') }}">
            @csrf
            <input type="hidden" name="email" value="{{ request()->email }}">
            {{-- <input type="hidden" name="phone_code" value="{{ request()->phone_code }}"> --}}

            <div class="mb-3 mt-5">
                <input type="text" name="otp" id="otp" value="{{ old('otp') }}" class="form-control border-0 shadow-none text-end" placeholder="رمز ال OTP" required>
                @error('otp')
                    <span class="text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <input type="password" name="password" id="password" value="" class="form-control border-0 shadow-none text-end" placeholder="كلمة المرور الجديدة" required>
                @error('password')
                    <span class="text-danger" >
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <input type="password" name="password_confirmation" id="password_confirmation" value="" class="form-control border-0 shadow-none text-end" placeholder="تأكيد كلمة المرور" required>
                @error('password_confirmation')
                    <span class="text-danger" >
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
    <script src="{{ asset('frontend/assets/js/toastr.min.js') }}"></script>

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


    <script>
        @if( session()->has('msg_status') == 'error')
            $(document).ready(function(e) {
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-bottom-left",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr['error']('{{ session('msg_content') }}');
            });
        @endif
    </script>
@endsection
 