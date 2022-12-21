@extends('_route_.layout')

@section('_vars_.content')
    <div class="container mx-auto sm:px-4">
        <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
            <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900 flex flex-row items-center justify-between">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    _breadcrumbs_
                </ol>
            </div>

            <div class="flex-auto p-6">
                <form action="{{ route('_route_.store', /*_cparentvars_*/) }}" method="POST" class="m-0 p-0">
                    <div class="flex-auto p-6">
                        @csrf
                        _create_
                    </div>

                    <div class="py-3 px-6 bg-gray-200 border-t-1 border-gray-300">
                        <div class="flex flex-row items-center justify-between">
                            <a href="{{ route('_route_.index', /*_cparentvars_*/) }}" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-gray-100 text-gray-800 hover:bg-gray-200">@lang('Cancel')</a>
                            <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">@lang('Create new _title_')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
