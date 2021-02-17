@extends('blogs.layout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3><h2>Редагувати пост</h2></h3></div>
                    </div>
                </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Warning!</strong> Please check input field code<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="form-group">
                    <strong>Заголовок:</strong>
                    <textarea id="default" class="form-control" style="height:150px" name="Title" placeholder="Title">{{ $blog->title }}</textarea>
                </div>
            </div>

            <div class="col-md-10 col-md-offset-1">
                <div class="form-group">
                    <strong>Текст:</strong>
                    <textarea id="default" class="form-control" style="height:150px" name="description" placeholder="Description">{{ $blog->description }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-success">Зберегти</button>
            </div>
        </div>




    </form>
@endsection
