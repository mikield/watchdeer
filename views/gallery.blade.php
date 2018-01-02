@extends('master')
<style>
    html,body {
        height:100%;
        background-color:#fff;
    }

    .carousel-inner,.carousel,.item,.fill {
        height:100%;
        width:100%;
        background-position:center center;
        background-size: cover;
    }
</style>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        @foreach($gallery->images as $key => $image)
            <li data-target="#myCarousel" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
        @endforeach
    </ol>
    <div class="carousel-inner" role="listbox">
            @foreach($gallery->images as $key => $image)
                <div class="item {{ $key == 0 ? 'active' : '' }}">
                    <div class="fill" style="background-image:url('{{ $gallery->url }}/{{ $image->name }}');"></div>
                </div>
            @endforeach

    </div>
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>