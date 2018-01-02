@extends('master')
<div>
    <table class="table">
        <caption>List of all galleries. (hover the titles. sort by count and titles are clickable twice)</caption>
        <thead>
        <tr>
            <th>
                @if(isset($type) && $type == 'date')
                    <a href="/" title="Sort by date">#</a>
                @else
                    <a href="/sort/date" title="Sort by date">#</a>
                @endif
            </th>
            <th>
                @if(isset($type) && $type == 'abc')
                    <a href="/sort/abcDesc" title="Sort by alphabetic (Z to A)">Title</a>
                @else
                    <a href="/sort/abc" title="Sort by alphabetic (A to Z)">Title</a>
                @endif
            </th>
            <th>
                @if(isset($type) && $type == 'count')
                    <a href="/sort/countDesc" title="Sort by images count (many to less)">Images</a>
                @else
                    <a href="/sort/count" title="Sort by images count (less to many)">Images</a>
                @endif
            </th>
            <th>Link</th>
        </tr>
        </thead>
        <tbody>
        @foreach($galleries as $gallery)
            <tr>
                <th scope="row">{{ $gallery->id }}</th>
                <td>{{ $gallery->title }}</td>
                <td>{{ count($gallery->images) }}</td>
                <td><a href="/gallery/{{ $gallery->id }}">Go</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
