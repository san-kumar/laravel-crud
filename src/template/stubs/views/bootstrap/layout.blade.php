@extends('_layout_')

@section('_section_')
    @if ($errors->any())
        <div class="container">
            <div class="alert alert-danger rounded-0">
                <ol class="py-0 my-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ol>
            </div>
        </div>
    @endif

    @if (session('success') || session('error'))
        <div class="container">
            <div class="alert alert-{{session('error') ? 'danger' : 'success'}} alert-dismissible fade show" role="alert">
                {{ session('success') ? : session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @yield('_vars_.content')
@endsection