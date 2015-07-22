@extends('layouts.master-admin')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Add Blog for {{ $category->name }}</div>
        <div class="panel-body">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::open(['class' => 'form-horizontal', 'files' => 'true', 'url' => route('admin.blog.item.store', $category->id)]) !!}
                <div class="form-group">
                    <label class="col-md-4 control-label">Title</label>
                    <div class="col-md-6">
                        {!! Form::text('title', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Alias</label>
                    <div class="col-md-6">
                        {!! Form::text('alias', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Thumbnail</label>
                    <div class="col-md-6">
                        {!! Form::file('thumbnail') !!}
                        <p class="help-block">Size {{ config('blog.thumb_width') }} x {{ config('blog.thumb_height') }} px</p>
                    </div>
                </div>

                @if (config('blog.highlight'))
                    <div class="form-group">
                        <div class="col-md-4">&nbsp;</div>
                        <div class="col-md-6">
                            <label>
                                {!! Form::checkbox('highlight', '1', false, ['style' => 'vertical-align:bottom;']) !!} Highlight
                            </label>
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <label class="col-md-4 control-label">Short Description</label>
                    <div class="col-md-6">
                        {!! Form::textarea('short_description', null, ['class' => 'form-control', 'rows' => '5']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                            Create
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        {!! Form::textarea('content', null, ['class' => 'form-control field-edit', 'rows' => '5']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                            Create
                        </button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop