<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    @include('layouts.head')
</head>

<body>

    <div class="wrapper">

        <!--=================================
 preloader -->

        <div id="pre-loader">
            <img src="assets/images/pre-loader/loader-01.svg" alt="">
        </div>

        <!--=================================
 preloader -->

        @include('layouts.main-header')

        @if (Auth::guard('admin')->check())
            @include('layouts.sidebars.admin-sidebar')
        @endif
        @if (Auth::guard('doctor')->check())
            @include('layouts.sidebars.doctor-sidebar')
        @endif


        <!--=================================
 Main content -->
        <!-- main-content -->
        <div class="content-wrapper">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="mb-5"> {{ __('Dashboard') }}</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        </ol>
                    </div>
                </div>
            </div>
            <!-- widgets -->

            <div class="row">
                <div class=" col-md-6 mb-30">
                    <div class="card card-statistics ">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-right">
                                    <a href="#" class="arror_down_latest"> <i class="fa fa-arrow-down"></i></a>
                                </div>
                                <div class="float-left">
                                    <h4>{{ __('Working Hours') }} </h4>
                                </div>

                            </div>
                            <hr>
                            <div class="latest_card" style="display: none">
                                @forelse ($schedules as $schedule)
                                    <h4>{{ __($schedule->day->value) }}</h4>
                                    <p class=" text-secondary">
                                        {{ __('From') }}
                                        <span class="text-primary">
                                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i a') }}</span>
                                        {{ __('To') }}
                                        <span class="text-primary">
                                            {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i a') }}
                                        </span>
                                    </p>
                                    <hr>
                                @empty
                                    <h3 class="text-center">{{ __('No working hours available') }} </h3>
                                @endforelse

                            </div>
                        </div>
                    </div>
                </div>
                <div class=" col-md-6 mb-30">
                    <div class="card card-statistics ">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-right">
                                    <a href="#" class="arror_down_latest"> <i class="fa fa-arrow-down"></i></a>
                                </div>
                                <div class="float-left">
                                    <h4>{{ __('Last :num reservations', ['num' => '5']) }}</h4>
                                </div>

                            </div>
                            <hr>
                            <div class="latest_card" style="display: none">
                                @forelse ($last_5 as $card)
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <a href="mailto:{{ $card->user->email }}"
                                                class="text-primary">{{ $card->user->email }}</a>
                                            <p class=" text-secondary">
                                                {{ $card->user->name }}
                                            </p>
                                        </div>


                                        <a href="{{ route('doctor.card.edit', $card->id) }}" class="btn btn-primary">
                                            <i class="fa fa-check"></i>
                                        </a>
                                    </div>


                                    <hr>
                                @empty
                                    <h3 class="text-center">لايوجد حجوزات جديدة </h3>
                                @endforelse

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--=================================
 footer -->

            @include('layouts.footer')
        </div><!-- main content wrapper end-->
    </div>
    </div>
    </div>

    <!--=================================
 footer -->

    @include('layouts.footer-scripts')
    <script>
        $(".arror_down_latest").on("click", function() {

            $(this).closest(".card-body").find(".latest_card").first().slideToggle("slow");

            $(this).find("i").toggleClass("fa-arrow-down fa-arrow-up");
        });
    </script>

</body>

</html>
