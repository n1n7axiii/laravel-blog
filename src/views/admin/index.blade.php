@extends('layouts.master-admin')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            Blog
            <div class="floatR"><a href="{{ route('admin.blog.category.create') }}"><i class="fa fa-plus"></i> Add Category</a></div>
        </div>
        @if (isset($categories) && count($categories))
            <table class="table table-responsive table-striped">
                <thead>
                    <tr>
                        @if (config('blog.category_thumb'))
                            <th>Thumbnail</th>
                        @endif
                        <th>Name</th>
                        <th>Description</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            @if (config('blog.category_thumb'))
                                <td><img src="{{ $category->thumbnail() }}" alt=""></td>
                            @endif
                            <td><a href="{{ route('admin.blog.category.show', $category->id) }}">{{ $category->name }}</a></td>
                            <td>{{ str_limit($category->description) }}</td>
                            <td class="text-right">
                                <a href="{{ route('admin.blog.category.edit', $category->id) }}"><i class="fa fa-pencil-square"></i></a>
                                <a href="{{ route('admin.blog.category.destroy', $category->id) }}" class="btn-destroy" data-confirm="All blog in this category will be delete?" data-token="{{ csrf_token() }}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="panel-body">
                You're currently didn't have any category.
            </div>
        @endif
    </div>
</div>
@stop