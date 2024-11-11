@extends('layouts.master')
@section('css')
@section('title')
    <?php echo $title = __('Profile'); ?>
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
                <li class="breadcrumb-item"><a href="/admin" class="default-color">{{ __('Go Home') }}</a></li>
                <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->


<div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">
            <form action="{{ route('doctor.profile.update', auth()->user()->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                {{ method_field('put') }}
                <label for="Name" class="mr-sm-2"> {{ __('Name') }}
                    :</label>
                <input class="form-control" type="text" value="{{ auth()->user()->name }}" name="name" required />
                <label for="Name" class="mr-sm-2">{{ __('Email') }}
                    :</label>
                <input class="form-control" type="email" name="email" value="{{ auth()->user()->email }}"
                    required />
                <label for="Name" class="mr-sm-2">{{ __('Password') }}
                    :</label>
                <input class="form-control" type="password" name="password" />
                <label for="Name" class="mr-sm-2"> {{ __('Image') }}
                    :</label>
                <input class="form-control" type="file" name="img" />

                <br><br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Back') }}</button>
                    <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>


@endsection
@section('js')

@endsection
