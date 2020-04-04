@extends('layouts.app')

@section('admin_content')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
          selector: '#mytextarea',
          menubar: false,
          language: 'ar'
        });
      </script>

    <div class="card-header">إضافة مقالة</div>

    <div class="card-body">
        <form class="form-horizontal" method="post">
            <div class="form-group">
                <textarea id="mytextarea">النص هنا</textarea>
            </div>
            <div class="form-group">
                <input class="btn btn-success" type="submit" value="نشر"/>
            </div>
        </form>
    </div>
@endsection
