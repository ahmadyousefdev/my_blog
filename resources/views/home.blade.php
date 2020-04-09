@extends('layouts.app')

@section('admin_content')

<div class="card-header">لوحة التحكم</div>

<div class="card-body">
    <div class="row">
        <div class="col-md-12 mb-4">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            تم تسجيل دخولك
            <a href="{{url('/admin/create')}}" class="btn btn-primary">إضافة مقالة جديدة</a>
        </div>
        <div class="col-md-12 mb-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>العنوان</th>
                        <th>تاريخ الإضافة</th>
                        <th>تعديل</th>
                    </tr>
                    <thead>
                <tbody>
                    @foreach ($articles as $article)
                    <tr>
                        <td>{{$article->id}}</td>
                        <td>{{$article->title}}</td>
                        <td>{{$article->created_at}}</td>
                    <td><a class="btn btn-danger" href="{{url('admin/edit/'.$article->id)}}">تعديل</a></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            {{$articles->links()}}
        </div>
    </div>

</div>
@endsection