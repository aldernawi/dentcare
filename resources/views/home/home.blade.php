@extends('layouts.home.app')

@section('title')
    {{ __('Home') }}
@stop

@section('content')
    <!-- row -->

    <section class="sec1 ScaleOut">
        <div class="titles">
            <h1 class="background-Anim title1">{{ __('Welcome') }}
                <span>{{ __('We are happy to offer you') }}</span>
            </h1>
            <h3 class="background-Anim title12"><span>{{ __('Healthy Smile') }}</span></h3>
        </div>
        <div class="main">
            <h1 class="textAnim">{{ __('Your Smile is on Us') }}
                <div class="roller">
                    <span id="rolltext">{{ __('For Better Dental Health') }}<br />
                        <span id="spare-time">{{ __('Smile for Dental Surgery') }}</span><br />
                </div>
            </h1>
        </div>
    </section>

    <script>
        const toggleThemeButton = document.getElementById('toggle-theme');

        toggleThemeButton.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
        });
    </script>
    <section id="sec2" class="container sec2">
        <h1 class="text-center">{{ __('Specialist Doctors') }}</h1>
        <hr>
        <div class="animate doctorsSec">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ($doctors as $doctor)
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
                                    <h2>{{ $doctor->name }} </h2>
                                    <p>
                                        @forelse($doctor->schedules as $schedule)
                                            {{ __('Day') }}: {{ __($schedule->day->value) }}
                                            {{ __('From') }}
                                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                                            {{ __('To') }}
                                            {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}<br>
                                        @empty
                                            {{ __('No specific time available') }}
                                        @endforelse
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!-- row closed -->
@endsection

@section('js')
@endsection
