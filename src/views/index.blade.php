@if ($layout_master_exists)
    @extends('layouts.master')

    @section('content')
@endif

<br><br>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Blog</div>
        <div class="list-group">
            @foreach ($categories as $category)
                <a href="{{ route('blog.show.category', $category->alias) }}" class="list-group-item">

                    @if (config('blog.category_thumb'))
                        <div class="row">
                            <div class="col-sm-4"><img src="{{ $category->thumbnail() }}" alt="{{ $category->name }}"></div>
                            <div class="col-sm-8">
                    @endif

                    <h4 class="list-group-item-heading">{{ $category->name }}</h4>
                    <p class="list-group-item-text">{{ str_limit($category->description) }}</p>

                    @if (config('blog.category_thumb'))
                            </div>
                        </div>
                    @endif

                </a>
            @endforeach
        </div>
    </div>
</div>

@if ($layout_master_exists)
    @stop()
@endif
