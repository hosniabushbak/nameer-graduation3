@extends('frontend.layouts.master')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/intlTelInput.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/toastr.min.css') }}"/>
@endsection

@section('content')
    <section class="my-5 py-3">
        <div class="d-flex justify-content-center align-items-center flex-column text-center m-auto p-4">
            <a href="{{ route('home') }}" class="mb-3">
                <img src="{{ asset('frontend/assets/images/logo.png') }}" width="100" alt="logo">
            </a>
            <h3 class="my-1">أهلا بك </h3>
            <p class="text-Register mt-1 mb-4">
                <strong>
                    طالب جديد <a class="text-dark fw-bold" href="{{ route('register') }}"> سجل الآن</a>
                </strong>
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
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="hidden" name="mac_id" id="mac_id">
                <div class="mb-3" style="direction: ltr;">
                    <input type="tel" id="phone" name="phone" autocomplete="off" value="{{ old('phone') }}"
                        class="form-control border-0 shadow-none text-end" placeholder="رقم الموبايل">
                    <input type="hidden" value="" name="phone_code" id="phone_code">
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <input type="password" name="password"
                        class="form-control border-0 shadow-none text-end mb-3" placeholder="كلمة المرور">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="d-flex justify-content-around align-items-center mb-3">
                    <div class="form-check">
                        <input class="form-check-input shadow-none border-0 shadow-sm" type="checkbox" name="remember"
                            id="flexCheckDefault" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="flexCheckDefault">
                            تذكرني؟
                        </label>
                    </div>
                    <a href="{{ route('password.request') }}" class="">نسيت كلمة المرور</a>
                </div>
                <button type="submit" class="btn btn-primary w-100">تسجيل دخول</button>
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
        $(document).ready(function(){
            function getMachineId() {
                let machineId = localStorage.getItem('MachineId');
                if (!machineId) {
                    machineId = crypto.randomUUID();
                    localStorage.setItem('MachineId', machineId);
                }
                return machineId;
            }
            $('#mac_id').val(getMachineId());
        });

    </script>

    <script>
        @if( session()->has('msg_status') == 'otp_success')
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
                toastr['success']('{{ session('msg_content') }}');
            });
        @endif
    </script>
@endsection
