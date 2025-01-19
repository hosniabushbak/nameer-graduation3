@extends('frontend.master')

@section('content')

        <div class="container my-5">
            <h1 class="text-center mb-4">الأسئلة الشائعة</h1>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="accordion" id="faqAccordion">
                        @forelse($faqs as $faq)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#faq{{ $faq->id }}">
                                        {{ $faq->question }}
                                    </button>
                                </h2>
                                <div id="faq{{ $faq->id }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                     data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        {!! nl2br(e($faq->answer)) !!}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4">
                                لا توجد أسئلة شائعة متاحة حالياً
                            </div>
                        @endforelse
                    </div>                </div>
            </div>
        </div>
@endsection