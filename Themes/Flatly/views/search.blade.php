@extends('layouts.master')

@section('title')
    ... | @parent
@endsection

@section('content')
    <section class="show search">
    <div class="container">
        <div class="row">
            @if(!empty($allResults))
                @foreach( $allResults as $results )
                    @foreach( $results as $key=>$result )
                        @foreach( $result as $page )
                            <a href="{{ $key.$page->slug }}">
                                <h2>{{ $page->title }}</h2>
                            </a>
                            <p>Najbliższy wolny termin:<b> <span style="color:#F39C12;">{{$page->closest_term}}r.</span></b> <br>
                           Lokalizacja: <b> {!!strip_tags( $page->location )!!}</b><br>
                           Liczba miejsc:  <b>{!! strip_tags($page->numberOfPlaces) !!}</b></p>
                            <b>Opis:</b>
                            <p>
                                {{ substr(strip_tags($page->content), 0, 200) }}...<br>
                            </p>
                        @endforeach
                    @endforeach
                @endforeach
            @endif
        </div>
    </div>
    </section>
@endsection