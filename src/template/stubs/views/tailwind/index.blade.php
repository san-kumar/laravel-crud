@extends('_route_.layout')

@section('_vars_.content')
    <div class="container mx-auto sm:px-4">
        <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
            <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900 flex flex-col md:flex-row justify-between">
                <ol class="inline-flex items-center space-x-1 md:space-x-3 mb-3 md:mb-0">
                    _breadcrumbs_
                </ol>
                <form action="{{ route('_route_.index', /*_cparentvars_*/) }}" method="GET" class="m-0 p-0">
                    <div class="relative flex items-stretch w-full">
                        <input type="text" class="block appearance-none w-full py-1 px-2 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded py-1 px-2 text-sm leading-normal rounded mr-2" name="search" placeholder="Search _titles_..." value="{{ request()->search }}">
                        <button class="group relative px-3 whitespace-nowrap overflow-hidden rounded-lg bg-white text-sm shadow" type="submit">@lang('Go!')</button>
                    </div>
                </form>
            </div>
            <div class="flex-auto p-6">
                _index_

                {{ $_vars_->withQueryString()->links() }}
            </div>
            <div class="text-center my-2">
                <a href="{{ route('_route_.create', /*_cparentvars_*/) }}" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600"><i class="fa fa-plus"></i> @lang('Create new _title_')</a>
            </div>
        </div>
    </div>
@endsection
