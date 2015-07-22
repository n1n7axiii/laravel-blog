@if ($layout_master_exists)
    @extends('layouts.master')

    @section('content')
@endif

<br><br>
<div class="container">
    <h2>{{ $blog->title }}</h2>
    <div>
        {!! $blog->content !!}
    </div>
</div>

@if ($layout_master_exists)
    @stop()
@endif
