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
                            <a href="{{ route('my_posts.index') }}" class="btn btn-primary">Мои статьи</a>
                        </div>
                    </div>
                </div>
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Main content -->
                    <section class="content">
                        {!! Form::open(['route' => 'my_posts.store', 'files' => true]) !!}
                        <!-- Default box -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h1 class="box-title">Добавить статью</h1>
                                @include('admin.errors')
                            </div>
                            <div class="box-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Название</label>
                                        <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                                            value="{{ old('title') }}" placeholder="">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputFile">Лицевая картинка</label>
                                        <input type="file" name="image" id="exampleInputFile">

                                        <p class="help-block">Какое-нибудь уведомление о форматах..</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Категория</label>
                                        {{ Form::select('category_id',
                                        $categories,
                                        null,
                                        ['class' => 'form-control select2'])
                                        }}
                                    </div>
                                    <div class="form-group">
                                        <label>Теги</label>
                                        {{ Form::select('tags[]',
                                            $tags,
                                            null,
                                            ['class' => 'form-control select2', 'multiple' => 'multiple', 'data-placeholder' => 'Выберите теги'])
                                            }}
                                    </div>
                                    <!-- Date -->
                                    <div class="form-group">
                                        <label>Дата:</label>

                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" name="date"
                                                value="{{ old('date') }}" id="datepicker">
                                        </div>
                                        <!-- /.input group -->
                                    </div>

                                    <!-- checkbox -->
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" class="minimal" name="is_featured">
                                        </label>
                                        <label>
                                            Рекомендовать
                                        </label>
                                    </div>

                                    <!-- checkbox -->
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" class="minimal" name="status">
                                        </label>
                                        <label>
                                            Черновик
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Описание</label>
                                        <textarea name="description" id="" cols="30" rows="10"
                                            class="form-control">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Полный текст</label>
                                        <textarea name="content" id="" cols="30" rows="10"
                                            class="form-control">{{ old('content') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer col-md-12">
                                <a href="{{ route('my_posts.index') }}" class="btn btn-default">Назад</a>
                                <button class="btn btn-success pull-right">Добавить</button>
                            </div>
                            <!-- /.box-footer-->
                        </div>
                        <!-- /.box -->
                        {!! Form::close() !!}
                    </section>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->

            </div>
            @include('pages._sitebar')

        </div>
    </div>
</div>
<!-- end main content-->
@endsection