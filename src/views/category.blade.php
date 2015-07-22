@if ($layout_master_exists)
    @extends('layouts.master')

    @section('content')
@endif

<br><br>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">{{ $category->name }}</div>
        <div class="list-group">
            @foreach ($blogs as $blog)
                <a href="{{ route('blog.show.item', [$category->alias, $blog->alias]) }}" class="list-group-item">
                    <div class="row">
                        <div class="col-sm-4"><img src="{{ $blog->thumbnail() }}" alt="{{ $blog->name }}"></div>
                        <div class="col-sm-8">
                            <h4 class="list-group-item-heading">{{ $blog->title }}</h4>
                            <p class="list-group-item-text">{{ str_limit($blog->short_description) }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <div class="paginate text-center">{!! $blogs->render() !!}</div>
</div>

@if ($layout_master_exists)
    @stop()
@endif
