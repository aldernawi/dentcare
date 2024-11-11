@extends('layouts.home.app')

@section('title')
    {{ __('Contact Us') }}
@stop

@section('content')
    <div class=" pb-5">
        <div class="container">
            <section class="sec2">
                <h1 class="text-center my-3">{{ __('Our Branches') }}</h1>
                <div class="map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d216355.0402965729!2d20.275085776224646!3d32.081485349241156!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13831c55479eee2b%3A0xe497dfce76d293e0!2z2KjZhti62KfYstmK!5e0!3m2!1sar!2sly!4v1672396906602!5m2!1sar!2sly"
                        style="border:0" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </section>
            <div class="my-5 text-center contact-info">
                <h2 class="mb-5">{{ __('Contact Us') }}</h2>
                <a href="tel:+0123456789" class="btnStyle"><i class="fas fa-phone"></i> 0123456789</a>
                <a href="mailto:info@example.com" class="btnStyle"><i class="fas fa-envelope"></i> info@example.com</a>

                <a href="https://wa.me/0123456789" class="btnStyle" target="_blank"><i class="fab fa-whatsapp"></i>
                    {{ __('WhatsApp') }}</a>

            </div>
        </div>
    </div>

@endsection
@section('js')

@endsection
