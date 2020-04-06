@extends('layouts.default')

@section('body')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @include('includes.messages')
                @yield('admin_content')
            </div>
        </div>
    </div>
</div>
@endsection
