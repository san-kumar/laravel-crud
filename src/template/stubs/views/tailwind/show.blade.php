@extends('_route_.layout')

@section('_vars_.content')
    <div class="container mx-auto sm:px-4">
        <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
            <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900 flex flex-row items-center justify-between">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    _breadcrumbs_
                </ol>

                <a href="{{ route('_route_.index', /*_cparentvars_*/) }}" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-gray-100 text-gray-800 hover:bg-gray-200"><i class="fa fa-caret-left"></i> Back</a>
            </div>

            <div class="flex-auto p-6">
                _show_
            </div>

            <div class="py-3 px-6 bg-gray-200 border-t-1 border-gray-300 flex flex-col md:flex-row items-center justify-end">
                <a href="{{ route('_route_.edit', /*_callvars_*/) }}" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-teal-500 text-white hover:bg-teal-600 whitespace-nowrap me-1"><i class="fa fa-edit"></i> @lang('Edit')</a>
                <form action="{{ route('_route_.destroy', /*_callvars_*/) }}" method="POST" class="m-0 p-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-red-600 text-white hover:bg-red-700 whitespace-nowrap"><i class="fa fa-trash"></i> @lang('Delete')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
