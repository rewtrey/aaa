@extends('blogs.layout')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <ul class="nav navbar-nav">
                    @if ($userEmail)
                        <li><a href="{{ url('/blogs/create') }}">Створити пост</a></li>
                    @endif
                </ul>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Заголовок</th>
                        <th>Текст</th>
                        <th>Автор</th>
                        @if ($userEmail)
                            <th>Добавлено</th>
                        @endif
                    </tr>
                    </thead>
                    @foreach ($blogs as $blog)
                        <tr>
                            <td>{{ $blog['id']}}</td>
                            <td>{!! $blog['title'] !!}</td>
                            <td>{!! $blog['description'] !!}</td>
                            <td>{{ $blog->user->name }}</td>
                            <td>{{ $blog['created_at']}}</td>
                            <td>
                                @if ($userEmail)
                                    <form action="{{ route('blogs.destroy',$blog['id']) }}" method="POST">
                                        <a class="btn btn-success" href="{{ route('blogs.show',$blog['id']) }}">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        @if ($blog->user_id == Auth::user()->id)
                                            <a class="btn btn-primary" href="{{ route('blogs.edit',$blog['id']) }}">
                                                <i class="fa fa-pencil" ></i>
                                            </a>

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endif
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        </div>
@endsection

