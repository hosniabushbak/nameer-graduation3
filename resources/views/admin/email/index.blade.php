@extends('admin.layouts.master')

@section('content')
    <!--begin::Email System-->

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header pe-5">
            <div class="card-title">
                <div class="d-flex justify-content-center flex-column me-3">
                    <h3 class="fs-4 fw-bold text-gray-900 mb-2">إرسال بريد إلكتروني</h3>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.email.send') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- نوع المستلم -->
                <div class="mb-5">
                    <label class="form-label">نوع المستلم</label>
                    <select name="recipient_type" class="form-select" id="recipient_type">
                        <option value="all">جميع المستخدمين</option>
                        <option value="house_owners">ملاك المنازل</option>
                        <option value="business_owners">ملاك الأعمال</option>
                        <option value="single">مستخدم محدد</option>
                    </select>
                    @error('recipient_type')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- مستلم محدد -->
                <div class="mb-5 d-none" id="single_recipient_section">
                    <label class="form-label">اختر المستلم</label>
                    <select name="recipient_id" class="form-select">
                        <option value="">اختر المستلم...</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->email }}</option>
                        @endforeach
                    </select>
                    @error('recipient_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- عنوان الرسالة -->
                <div class="mb-5">
                    <label class="form-label">عنوان الرسالة</label>
                    <input type="text" name="subject" class="form-control" value="{{ old('subject') }}"/>
                    @error('subject')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- محتوى الرسالة -->
                <div class="mb-5">
                    <label class="form-label">محتوى الرسالة</label>
                    <textarea name="content" class="form-control" rows="8">{{ old('content') }}</textarea>
                    @error('content')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- المرفقات -->
                <div class="mb-5">
                    <label class="form-label">المرفقات</label>
                    <input type="file" name="attachments[]" class="form-control" multiple/>
                    @error('attachments')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    @error('attachments.*')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- زر الإرسال -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">إرسال</button>
                </div>
            </form>
        </div>
    </div>
    <!--end::Email System-->
@endsection

@push('scripts')
    <script>
        document.getElementById('recipient_type').addEventListener('change', function() {
            const singleRecipientSection = document.getElementById('single_recipient_section');
            singleRecipientSection.classList.toggle('d-none', this.value !== 'single');
        });
    </script>
@endpush