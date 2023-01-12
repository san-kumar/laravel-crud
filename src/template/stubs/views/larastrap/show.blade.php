@extends('_route_.layout')

@section('_vars_.content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <ol class="breadcrumb m-0 p-0">
                    _breadcrumbs_
                    <li class="breadcrumb-item">@lang('_title_') #{{$_var_->id}}</li>
                </ol>

                <a href="{{ route('_route_.index', /*_cparentvars_*/) }}" class="btn btn-light"><i class="fa fa-caret-left"></i> Back</a>
            </div>

            <div class="card-body">
                _show_
            </div>

            <div class="card-footer d-flex flex-column flex-md-row align-items-center justify-content-end">
                <a href="{{ route('_route_.edit', /*_callvars_*/) }}" class="btn btn-info text-nowrap me-1"><i class="fa fa-edit"></i> @lang('Edit')</a>
                <form action="{{ route('_route_.destroy', /*_callvars_*/) }}" method="POST" class="m-0 p-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger text-nowrap"><i class="fa fa-trash"></i> @lang('Delete')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
