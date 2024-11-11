@extends('layouts.master')
@section('css')
    <style>
        .working-hour {
            background-color: #28a745;
            /* لون أخضر */
            color: white;
        }
    </style>
@endsection
@section('title')
    {{ __('Doctor Schedules') }}
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ __('Doctor Schedules') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="/admin" class="default-color">{{ __('Go Home') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('Doctor Schedules') }}</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- جدول مواعيد الدكاترة -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>{{ __('Doctor') }}</th>
                    @for ($hour = 0; $hour < 24; $hour++)
                        <th>{{ $hour }}:00</th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @foreach ($doctors as $doctor)
                    <tr>
                        <td>{{ $doctor->name }}</td>
                        @for ($hour = 0; $hour < 24; $hour++)
                            @php
                                $isWorking = false;
                                foreach ($doctor->schedules as $schedule) {
                                    $startHour = \Carbon\Carbon::parse($schedule->start_time)->format('H');
                                    $endHour = \Carbon\Carbon::parse($schedule->end_time)->format('H');

                                    if ($hour >= $startHour && $hour < $endHour) {
                                        $isWorking = true;
                                        break;
                                    }
                                }

                            @endphp
                            <td class="{{ $isWorking ? 'working-hour' : '' }}">
                                {{ $isWorking ? __('Working') : '' }}
                            </td>
                        @endfor
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('js')
    <!-- يمكن إضافة أكواد JavaScript هنا لتنسيق الجدول بشكل أفضل -->
@endsection
