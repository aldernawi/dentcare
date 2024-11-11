@extends('layouts.home.app')

@section('title')
    {{ __('Services') }}
@stop

@section('content')
    <section class="container sec2">
        <h1 class="text-center mt-5">{{ __('Services') }}</h1>
        <hr>
        <div class="fade-left doctorsSec d-flex flex-column align-items-center">
            @forelse ($services as $service)
                <div class="Sbox">
                    <div class="card myCard mb-3 myBorder">
                        <div class="row p-0 no-gutters align-items-center">
                            <div class="col-md-6 col-sm-12">
                                <img src="{{ asset('images/services/' . $service->img) }}"
                                    class="card-img rounded-circle imgStyle">
                            </div>
                            <div class="col-md-6 col-sm-12 d-flex flex-column align-items-center justify-content-center">
                                <div class="card-body text-center">
                                    <a href="{{ route('services.show', $service->id) }}">
                                        <h1 class="card-title">{{ $service->name }} </h1>
                                    </a>
                                    <p class="Alot2 card-text">{{ __('Price') }} : <span
                                            class="text-success">{{ $service->price }}</span> {{ __('LYD') }} </p>
                                    <p class="Alot2 card-text">{{ $service->desc }} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning text-center my-5">{{ __('No services available') }}</div>
            @endforelse
        </div>
    </section>

    <script>
        var swiper = new Swiper(".mySwiper", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: true,
            },
            pagination: {
                el: ".swiper-pagination",
            },
        });
    </script>
@endsection

@section('js')
@endsection
