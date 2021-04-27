@extends('admin.layout')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Blank page
            <small>it all starts here</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Листинг сущности</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group">
                    <a href="{{route('posts.create')}}" class="btn btn-success">Добавить</a>
                </div>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Картинка</th>
                            <th width="7%">Рекомендуемые</th>
                            <th width="7%">Паблик/черновик</th>
                            <th>Действия</th>
                            <th>Категория</th>
                            <th>Теги</th>
                            <th>Автор</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td><a href="{{route('post.show', $post->slug)}}">{{ $post->title }}</a></td>
                            <td>
                                <img src="{{ $post->getImage() }}" alt="" width="100">
                            </td>
                            <td>@if ($post->is_featured == 0)
                                <a href="/admin/posts/is_featured/{{ $post->id }}" class="fa fa-lock"></a>
                                @else
                                <a href="/admin/posts/is_featured/{{ $post->id }}" class="fa fa-thumbs-o-up"></a>
                                @endif
                            </td>
                            <td>@if ($post->status == 1)
                                <a href="/admin/posts/toggle/{{ $post->id }}" class="fa fa-lock"></a>
                                @else
                                <a href="/admin/posts/toggle/{{ $post->id }}" class="fa fa-thumbs-o-up"></a>
                                @endif
                            </td>
                            <td><a href="{{ route('posts.edit', $post->id) }}" class="fa fa-pencil"></a>
                                {{ Form::open(['route'=>['posts.destroy',$post->id], 'method'=>'delete']) }}
                                <button onclick="return confirm('are you sure?')" type="submit" class="delete">
                                    <i class="fa fa-remove"></i>
                                </button>
                                {{ Form::close() }}</td>
                            <td>{{$post->getCategoryTitle()}}</td>
                            <td>{{$post->getTagsTitles()}}</td>
                            <td>{{ $post->author->name }}</td>
                        </tr>

                        @endforeach
                        </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection