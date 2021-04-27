@extends('layout')

@section('content')
<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel-group">
                    <div class="btn-group">
                        <a href="/profile" class="btn btn-primary">Мой профиль</a>
                    </div>
                    <div class="btn-group pull-right">
                        <div class="pull-right">
                            <a href="{{route('my_posts.create')}}" class="btn btn-success">+ Создать статью</a>
                        </div>
                    </div>
                </div>
                <div class="leave-comment mr0">
                    <!--leave comment-->
                    <h3 class="text-uppercase">My posts</h3>
                    @foreach ($posts as $post)
                    <div class="row mt-3 wow fadeIn">

                        <div class="col-lg-5 col-xl-4 mb-4 ">
                            <div class="view overlay rounded z-depth-1">
                                <a href="{{route('post.show', $post->slug)}}" target="_blank">
                                    <div class="mask rgba-white-slight"><img src="{{ $post->getImage() }}"
                                            class="img-fluid" alt=""></div>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-7 col-xl-7 ml-xl-4 mb-4">
                            <h3 class="mb-3 font-weight-bold dark-grey-text">
                                <strong>{{ $post->title }}</strong>
                            </h3>
                            <p class="grey-text">{!! $post->description !!}</p>
                            <br>
                            <div class="panel-group">
                                <div class="btn-group">
                                    <a href="{{route('post.show', $post->slug)}}" class="btn btn-primary btn-sm"
                                        target="_blank">Read more <i class="fas fa-play ml-2"></i></a>
                                </div>
                                <div class="btn-group">
                                    <a href="{{ route('my_posts.edit', $post->id) }}"
                                        class="btn btn-warning btn-sm">Edit <i class="fa fa-edit ml-2"></i></a>
                                </div>
                                <div class="btn-group">
                                    {{ Form::open(['route'=>['my_posts.destroy',$post->id], 'method'=>'delete']) }}
                                    <button onclick="return confirm('are you sure?')" type="submit"
                                        class="btn btn-danger btn-sm delete">
                                        Delete <i class="fa fa-times-circle ml-2"></i>
                                    </button>
                                    {{ Form::close() }}
                                </div>
                            </div>

                        </div>

                    </div>

                    <hr class="mb-5">
                    @endforeach
                    {{ $posts->links() }}

                </div>
                <div class="box-footer">
                    <a href="/profile" class="btn btn-default">Назад</a>
                </div>
                <!--end leave comment-->
            </div>
            @include('pages._sitebar')

        </div>
    </div>
</div>
<!-- end main content-->
@endsection