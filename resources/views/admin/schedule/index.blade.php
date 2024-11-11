@extends('layouts.master')
@section('css')
@section('title')
    <?php echo $title = __('Schedule'); ?>
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ $title }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="/schedule" class="default-color">{{ __('Go Home') }}</a></li>
                <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
    {{ __('Add') }}
</button>
<br><br>
<div class="row">
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if ($errors->any())
                    <?php Alert::error($errors->all(), __('Error'))->showConfirmButton(__('Done'), '#c0392b'); ?>
                @endif
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0 table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Doctor') }}</th>
                                <th>{{ __('Day') }}</th>
                                <th>{{ __('Time') }}</th>
                                <th>{{ __('Control') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $schedule)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $schedule->doctor->email }}
                                    </td>
                                    <td>{{ __($schedule->day->name) }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }} <br>
                                        {{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}


                                    </td>
                                    <td>
                                        <button type="button" data-toggle="modal"
                                            data-target="#edit{{ $schedule->id }}" title="{{ __('main.edit') }}"
                                            class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $schedule->id }}" title="حذف"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                </div>
                <!-- edit_modal_Section -->
                <div class="modal fade" id="edit{{ $schedule->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    {{ __('edit :item', ['item' => __('Schedule')]) }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('schedules.update', $schedule->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    {{ method_field('put') }}
                                    @csrf
                                    <label for="Name" class="mr-sm-2"> {{ __('Day') }}
                                        :</label>
                                    <select class="form-control p-2" name="day" required>
                                        @foreach (App\Enums\Days::cases() as $day)
                                            <option value="{{ $day->value }}"
                                                {{ $day->name == $schedule->day->name ? 'selected' : '' }}>
                                                {{ __($day->name) }}</option>
                                        @endforeach

                                    </select>

                                    <label for="start_time" class="mr-sm-2">{{ __('Start Time') }}:</label>
                                    <input class="form-control" type="time"
                                        value="{{ old('start_time', \Carbon\Carbon::parse($schedule->start_time)->format('H:i')) }}"
                                        name="start_time" required />

                                    <label for="end_time" class="mr-sm-2">{{ __('End Time') }}:</label>
                                    <input class="form-control" type="time"
                                        value="{{ old('end_time', \Carbon\Carbon::parse($schedule->end_time)->format('H:i')) }}"
                                        name="end_time" required />


                                    <label class="mr-sm-2" for="doctor_id">{{ __('Doctor') }}:</label>
                                    <select name="doctor_id" id="doctor_id" class="form-control p-2">
                                        @foreach ($doctors as $doctor)
                                            <option value="{{ $doctor->id }}"
                                                {{ $doctor->id == $schedule->doctor_id ? 'selected' : '' }}>
                                                {{ $doctor->name }}</option>
                                        @endforeach
                                    </select>

                                    <br><br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ __('Back') }}</button>
                                <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                            </div>
                            </form>

                        </div>
                    </div>
                </div>
                <!-- delete_modal_Section -->
                <div class="modal fade" id="delete{{ $schedule->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    {{ __('Delete :item', ['item' => __('Schedule')]) }}

                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('schedules.destroy', $schedule->id) }}" method="post">
                                    {{ method_field('Delete') }}
                                    @csrf
                                    <h3 class="text-center">{{ __('Are you sure you want to delete?') }}</h3>
                                    <p class="text-center">
                                        {{ __('If deleted, everything related to this :item will also be deleted', ['item' => __('Schedule')]) }}
                                    </p>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{ __('Back') }}</button>
                                        <button type="submit" class="btn btn-danger">{{ __('Save') }}</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<!-- add_modal_Section -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ __('Add :item', ['item' => __('Schedule')]) }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('schedules.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="Name" class="mr-sm-2"> {{ __('Day') }}
                        :</label>
                    <select class="form-control p-2" name="day" required>
                        @foreach (App\Enums\Days::cases() as $day)
                            <option value="{{ $day->value }}">{{ __($day->name) }}</option>
                        @endforeach
                    </select>

                    <label for="Name" class="mr-sm-2">{{ __('Start Time') }}
                        :</label>
                    <input class="form-control"type="time" name="start_time" required />
                    <label for="Name" class="mr-sm-2">{{ __('End Time') }}
                        :</label>
                    <input class="form-control" type="time" name="end_time" required />

                    <label class="mr-sm-2" for="doctor_id">{{ __('Doctor') }}:</label>
                    <select name="doctor_id" id="doctor_id" class="form-control p-2">
                        @foreach ($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                        @endforeach
                    </select>


                    <br><br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('Back') }}</button>
                        <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- row closed -->

@endsection
@section('js')

@endsection
