@extends('layouts.master-admin')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            {{ $category->name }}
            <div class="floatR"><a href="{{ route('admin.blog.item.create', $category->id) }}"><i class="fa fa-plus"></i> Add Item</a></div>
        </div>
        @if ($category->items()->count())
            <table class="table table-responsive table-striped">
                <thead>
                    <tr>
                        <th width="30%">Thumbnail</th>
                        <th>Title</th>
                        <th>Alias</th>
                        <th>Short Description</th>
                        @if (config('blog.highlight'))<th class="text-center">Highlight</th>@endif
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category->items as $item)
                        <tr>
                            <td>
                                @if ($item->thumbnail)<img src="{{ $item->thumbnail() }}" alt="">@endif
                            </td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->alias }}</td>
                            <td>{{ str_limit($item->short_description) }}</td>
                            @if (config('blog.highlight'))<td class="text-center">@if($item->highlight)<p class="text-success"><i class="fa fa-check"></i></p>@endif</td>@endif
                            <td class="text-right">
                                <a href="{{ route('admin.blog.item.edit', [$category->id, $item->id]) }}"><i class="fa fa-pencil-square"></i></a>
                                <a href="{{ route('admin.blog.item.destroy', [$category->id, $item->id]) }}" class="btn-destroy" data-confirm="Are you want to delete this blog?" data-token="{{ csrf_token() }}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="panel-body">
                This category didn't have any blog.
            </div>
        @endif
    </div>
</div>
@stop