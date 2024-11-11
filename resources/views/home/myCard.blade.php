@extends('layouts.home.app')

@section('title')
    {{ __('Home') }}
@stop

@section('content')
    <section class="container sec2" style="min-height: 90vh !important;">
        <h1 class="text-center mt-5">{{ __('My Bookings') }}</h1>
        <hr>
        <div class="d-flex flex-column align-items-center">
            @forelse ($cards as $card)
                <!-- Example of booking card, repeat this block for each booking -->
                <div class="card mb-3 p-0 m-0" style="width:50vw;">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <img src="{{ asset('images/doctors/' . $card->doctor->img) }}" class="card-img imgStyle2"
                                alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"> {{ $card->doctor->name }} </h5>
                                <p class="card-text">
                                    {{ __('You can visit this doctor during their scheduled working hours') }}</p>
                                @if ($card->status == 0)
                                    <p class="text-warning">{{ __('Pending') }}</p>
                                @else
                                    <p class="text-success">{{ __('Accepted') }}</p>
                                @endif
                                <p></p>
                                <a href="{{ route('card.edit', $card->id) }}" class="btn btn-danger"><i class="fa fa-trash"
                                        aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            @empty
                <div class="alert alert-warning">{{ __('No bookings available') }} <a
                        href="{{ route('services.index') }}">{{ __('Make a booking now') }}</a>
                </div>
            @endforelse
        </div>
    </section>
@endsection

@section('js')

@endsection
