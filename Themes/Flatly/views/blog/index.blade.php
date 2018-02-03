@extends('layouts.master')

@section('title')
    Lista | @parent
@stop

@section('content')
    <section class="index">
            <?php if (isset($posts)): ?>
            <ul>
                <?php foreach ($posts as $post): ?>
                    <li>
                        <div class="inside">
                            <span class="date">Dodano <b>{{ $post->created_at->format('d-m-Y') }}r.</b></span>
                            <div><h3>
                                    <a href="{{ URL::route($currentLocale . '.blog.slug', [$post->slug]) }}">
                                        {{ $post->title }}
                                    </a>
                                </h3></div>
                            <span class="date">Najbliższy wolny termin <b style="color:#F39C12;">{{ $post->closest_term }}r.</b></span>
                        </div>
                        <img class="img-responsive" src="{{$post->getThumbnailAttribute()->path}}">
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
    </section>
@stop
