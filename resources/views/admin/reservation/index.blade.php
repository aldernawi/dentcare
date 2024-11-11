@extends('layouts.master')
@section('css')
@section('title')
    <?php echo $title = __('Reservations'); ?>
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
                <li class="breadcrumb-item"><a href="/card" class="default-color">{{ __('Go Home') }}</a></li>
                <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->

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
                                <th>{{ __('Image') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Control') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cards as $card)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <th><img class="img-small avatar-small"
                                            src="{{ URL::asset('images/users/' . $card->user->img) }}" alt="">

                                    <td><a class="text-primary"
                                            href="mailto:{{ $card->user->email }}">{{ $card->user->email }}</a></td>

                                    <td>

                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $card->id }}" title="حذف"><i
                                                class="fa fa-trash"></i></button>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#check{{ $card->id }}" title="حفظ"><i
                                                class="fa fa-check"></i></button>
                                    </td>
                                </tr>
                </div>

                <div class="modal fade" id="delete{{ $card->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    {{ __('Delete :item', ['item' => __('Reservation')]) }}

                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('adminReservations.destroy', $card->id) }}" method="post">
                                    {{ method_field('Delete') }}
                                    @csrf
                                    <h3 class="text-center">{{ __('Are you sure you want to delete?') }}</h3>
                                    <p class="text-center">
                                        {{ __('If deleted, everything related to this :item will also be deleted', ['item' => __('Reservation')]) }}
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

                <div class="modal fade" id="check{{ $card->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    {{ __('Save :item', ['item' => __('Reservation')]) }}

                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('adminReservations.update', $card->id) }}" method="post">
                                    {{ method_field('put') }}
                                    @csrf
                                    <h3 class="text-center">{{ __('Are you sure you want to Save?') }}</h3>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{ __('Back') }}</button>
                                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

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



<!-- row closed -->

@endsection
@section('js')

@endsection
