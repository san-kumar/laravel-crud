@extends('_route_.layout')

@section('_vars_.content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <ol class="breadcrumb m-0 p-0">
                    _breadcrumbs_
                    <li class="breadcrumb-item">@lang('Create new')</li>
                </ol>
            </div>

            <div class="card-body">
                <form action="{{ route('_route_.store', /*_cparentvars_*/) }}" method="POST" class="m-0 p-0">
                    <div class="card-body">
                        @csrf
                        _create_
                    </div>

                    <div class="card-footer">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <a href="{{ route('_route_.index', /*_cparentvars_*/) }}" class="btn btn-light">@lang('Cancel')</a>
                            <button type="submit" class="btn btn-primary">@lang('Create new _title_')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
