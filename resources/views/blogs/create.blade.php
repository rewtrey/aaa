@extends('blogs.layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Створити пост</h3></div>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Warning!</strong> Please check your input code<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('blogs.store') }}" method="POST" class="form-group" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="form-group">
                        <strong>Заголовок:</strong>
                        <textarea class="form-control" id="title" name="title"></textarea>
                    </div>

                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                        <strong>Текст:</strong>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>

                    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
                    <script>
                        CKEDITOR.replace( 'title' );
                        CKEDITOR.replace( 'description', {
                            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
                            filebrowserUploadMethod: 'form'
                        } );
                    </script>


                    <div class="col-md-10 col-md-offset-1">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <input type="submit" value="Створити" class="btn btn-success">
                            </div>
                    </div>
                </div>
            </form>

@endsection
