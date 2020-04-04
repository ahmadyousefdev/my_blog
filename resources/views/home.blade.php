@extends('layouts.app')

@section('admin_content')

    <div class="card-header">لوحة التحكم</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        تم تسجيل دخولك

        <a href="{{url('/admin/create')}}" class="btn btn-primary">إضافة مقالة جديدة</a>
    </div>
@endsection
