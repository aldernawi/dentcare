@extends('layouts.master')
@section('css')
@section('title')
    <?php echo $title = __('Services'); ?>
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
                                <th>{{ __('Image') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Descritpion') }}</th>
                                <th>{{ __('Control') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <th><img class="img-small avatar-small"
                                            src="{{ URL::asset('images/services/' . $service->img) }}" alt="">

                                    <td>{{ $service->name }}</td>
                                    <td>{{ \Str::limit($service->desc, 50) }}</td>
                                    <td>
                                        <button type="button" data-toggle="modal"
                                            data-target="#edit{{ $service->id }}" title="{{ __('main.edit') }}"
                                            class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $service->id }}" title="حذف"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                </div>
                <!-- edit_modal_Section -->
                <div class="modal fade" id="edit{{ $service->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    {{ __('edit :item', ['item' => __('Service')]) }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('adminServices.update', $service->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    {{ method_field('put') }}
                                    @csrf
                                    <label for="Name" class="mr-sm-2"> {{ __(':h name', ['h' => __('Arabic')]) }}
                                        :</label>
                                    <input class="form-control" value="{{ $service->getTranslation('name', 'ar') }}"
                                        type="text" name="AR_name" required />
                                    <label for="Name" class="mr-sm-2"> {{ __(':h name', ['h' => __('English')]) }}
                                        :</label>
                                    <input class="form-control" value="{{ $service->getTranslation('name', 'en') }}"
                                        type="text" name="EN_name" required />
                                    <label for="Name" class="mr-sm-2"> {{ __('Price') }}
                                        :</label>
                                    <input class="form-control" type="number" name="price"
                                        value="{{ $service->price }}" required />
                                    <label for="Name" class="mr-sm-2">
                                        {{ __(':h Description', ['h' => __('Arabic')]) }}
                                        :</label>

                                    <input class="form-control" type="text" name="AR_desc"
                                        value="{{ $service->getTranslation('desc', 'ar') }}" required />
                                    <label for="Name" class="mr-sm-2">
                                        {{ __(':h Description', ['h' => __('English')]) }}
                                        :</label>
                                    <input class="form-control" value="{{ $service->getTranslation('desc', 'en') }}"
                                        type="text" name="EN_desc" required />
                                    <label for="Name" class="mr-sm-2"> {{ __('main.img') }}
                                        :</label>

                                    <input class="form-control" type="file" name="img" />
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
                <div class="modal fade" id="delete{{ $service->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    {{ __('Delete :item', ['item' => __('Service')]) }}

                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('adminServices.destroy', $service->id) }}" method="post">
                                    {{ method_field('Delete') }}
                                    @csrf
                                    <h3 class="text-center">{{ __('Are you sure you want to delete?') }}</h3>
                                    <p class="text-center">
                                        {{ __('If deleted, everything related to this :item will also be deleted', ['item' => __('Service')]) }}
                                    </p>
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
                    {{ __('Add :item', ['item' => __('Service')]) }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('adminServices.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="Name" class="mr-sm-2"> {{ __(':h name', ['h' => __('Arabic')]) }}
                        :</label>
                    <input class="form-control" type="text" name="AR_name" required />
                    <label for="Name" class="mr-sm-2"> {{ __(':h name', ['h' => __('English')]) }}
                        :</label>
                    <input class="form-control" type="text" name="EN_name" required />
                    <label for="Name" class="mr-sm-2"> {{ __('Price') }}
                        :</label>
                    <input class="form-control" type="number" name="price" required />
                    <label for="Name" class="mr-sm-2"> {{ __(':h Description', ['h' => __('Arabic')]) }}
                        :</label>
                    <input class="form-control" type="text" name="AR_desc" required />
                    <label for="Name" class="mr-sm-2"> {{ __(':h Description', ['h' => __('English')]) }}
                        :</label>
                    <input class="form-control" type="text" name="EN_desc" required />
                    <label for="Name" class="mr-sm-2"> {{ __('main.img') }}
                        :</label>

                    <input class="form-control" type="file" name="img" />
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
