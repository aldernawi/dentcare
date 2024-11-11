@extends('layouts.home.app')

@section('title')
    {{ $service->name }}
@stop

@section('content')

    <section class="container sec2">
        <h1 class="text-center mt-5">{{ $service->name }}</h1>
        <hr>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @forelse ($service->doctors as $doctor)
                    <div class="swiper-slide">
                        <div class="card d-flex align-items-center myBorder">
                            <img src="{{ asset('images/doctors/' . $doctor->img) }}"
                                class="card-img-top rounded-circle imgStyle" alt="...">
                            <div class="d-flex align-items-center mt-1">
                                @php
                                    $averageRating = round($doctor->averageRating(), 1);
                                @endphp
                                @for ($i = 0; $i < 5; $i++)
                                    <i class="fa fa-star"
                                        style="color: {{ $i < $averageRating ? '#ffd500' : '#e4e5e9' }};"></i>
                                @endfor
                            </div>
                            <div class="card-body text-center">
                                <h2>{{ $doctor->name }}</h2>
                                @forelse($doctor->schedules as $schedule)
                                    {{ __('day') }}: {{ __($schedule->day->value) }} {{ __('From') }}
                                    {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                                    {{ __('To') }}
                                    {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}<br>
                                @empty
                                    {{ __('no_schedule') }}
                                @endforelse
                            </div>
                            <div class="row justify-content-around p-0 m-0">
                                <div class="col-md-6">
                                    <form method="POST" action="{{ route('card.store', $doctor->id) }}">
                                        @csrf
                                        @method('post')
                                        <button type="submit" class="btn btn-outline-primary d-flex align-items-center">
                                            <i class="fas fa-check me-1"></i> {{ __('Book') }}
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <a href class="btn btn-outline-primary d-flex align-items-center" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop{{ $doctor->id }}">
                                        <i class="fa fa-star"></i> {{ __('Rate') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center alert alert-light">{{ __('No doctors available for this service') }}</div>
                @endforelse
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    @foreach ($service->doctors as $doctor)
        <div class="modal fade" id="staticBackdrop{{ $doctor->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">{{ __('Rate doctor') }} {{ $doctor->name }}!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="{{ route('ratings.store', $doctor->id) }}">
                        @csrf
                        @method('post')
                        <div class="modal-body">
                            <div class="container d-flex justify-content-center">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="stars">
                                            @for ($i = 5; $i >= 1; $i--)
                                                <input class="star star-{{ $i }}"
                                                    id="star-{{ $i }}-{{ $doctor->id }}" type="radio"
                                                    name="star" value="{{ $i }}">
                                                <label class="star star-{{ $i }}"
                                                    for="star-{{ $i }}-{{ $doctor->id }}"></label>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"
                                data-bs-dismiss="modal">{{ __('Save') }}</button>
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        document.querySelectorAll('.times').forEach(function(input) {
            input.addEventListener('change', function() {
                document.querySelectorAll('.times').forEach(function(otherInput) {
                    otherInput.disabled = true;
                });
                input.disabled = false;
            });
        });

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
