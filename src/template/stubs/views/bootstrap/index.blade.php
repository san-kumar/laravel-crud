@extends('_route_.layout')

@section('_vars_.content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex flex-column flex-md-row align-items-md-center justify-content-between">
                <ol class="breadcrumb m-0 p-0 flex-grow-1 mb-2 mb-md-0">
                    _breadcrumbs_
                </ol>

                <form action="{{ route('_route_.index', /*_cparentvars_*/) }}" method="GET" class="m-0 p-0">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm me-2" name="search" placeholder="Search _titles_..." value="{{ request()->search }}">
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-search"></i> @lang('Go!')</button>
                        </span>
                    </div>
                </form>
            </div>
            <div class="card-body">
                _index_

                {{ $_vars_->withQueryString()->links() }}
            </div>
            <div class="text-center my-2">
                <a href="{{ route('_route_.create', /*_cparentvars_*/) }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('Create new _title_')</a>
            </div>
        </div>
    </div>
@endsection
