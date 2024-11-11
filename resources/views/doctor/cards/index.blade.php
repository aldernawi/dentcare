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
                                        @if ($card->status == 1)
                                            <a href="{{ route('doctor.card.edit', $card->id) }}"
                                                class="btn btn-primary btn-sm" title="حفظ"><i
                                                    class="fa fa-check"></i></a>
                                        @endif

                                    </td>
                                </tr>
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
