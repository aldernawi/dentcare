@extends('layouts.home.app')

@section('title')
    {{ __('Feedback') }}
@stop

@section('content')
    <section>
        <div class="container py-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-10 col-xl-8 text-center">
                    <h3 class="fw-bold mt-5">{{ __('Feedback') }}</h3>
                    <p class="mb-4 pb-2 mb-md-5 pb-md-0">
                        {{ __('Here you can view all customer feedback') }}
                    </p>
                </div>
            </div>
            <div class="row text-center flex-row-reverse justify-content-start">
                @forelse ($contacts as $contact)
                    <div class="col-md-4 mb-2">
                        <div class="card myBorder">
                            <div class="card-body py-4 mt-2  Myheight">
                                <h5 class="font-weight-bold"><a href>{{ $contact->user->name }}
                                    </a> {{ __('Name') }}</h5>
                                <hr>

                                <p class="mb-2">
                                    <i class="fas fa-quote-left pe-2"></i><a href>{{ $contact->message }} </a>:
                                    {{ __('Feedback') }}

                                </p>
                            </div>
                        </div>
                    </div>

                @empty
                    <div class="alert alert-info text-center">{{ __('No feedback available') }}</div>
                @endforelse
            </div>

        </div>
        <section class="sec3">

            <div class="contactForm myBorder fade-left my-2">
                <h3 class="text-contact ">{{ __('Add Feedback') }}</h3>
                <form action="{{ route('contact.store') }}" method="post">
                    @csrf
                    @method('post')

                    <textarea class="mt-2" name="message" id="message" maxlength="40" rows="5"
                        placeholder="{{ __('Your feedback matters to us') }}"></textarea>

                    <input type="submit" class="mt-2" name="sub" value="{{ __('Send') }}">

                </form>
            </div>
        </section>
    </section>

@endsection
@section('js')

@endsection
