@extends('layouts.master')

@section('title')
    {{ $post->title }} | @parent
@stop
<?php
use Modules\Blog\Repositories\Eloquent\EloquentPostRepository;

?>
@inject('reservation','Modules\Blog\Entities\Reservation')
@section('content')
    <div class="container show">
    <div class="row">
        <span class="linkBack">
            <a class="btn btn-warning" href="{{ URL::route($currentLocale . '.blog') }}"><i class="glyphicon glyphicon-chevron-left"></i> Powrót do listy</a>
        </span>
            <div style="margin-top:10px;"><span class="date">Dodano: {{ $post->created_at->format('d-m-Y') }}</span></div>
        <h1>{{ $post->title }}</h1>
            <div class="panel-group" id="accordion">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Lokalizacja:</a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">
                            {!! $post->location !!}
                        </div>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Adres: </a>
                        </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse">
                        <div class="panel-body">
                            {!! $post->address !!}
                        </div>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Liczba miejsc: </a>
                        </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse">
                        <div class="panel-body">
                            {{$post->numberOfPlaces}}
                        </div>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Ogólne informacje: </a>
                        </h4>
                    </div>
                    <div id="collapse4" class="panel-collapse collapse">
                        <div class="panel-body">
                            {!! $post->content !!}
                        </div>
                    </div>
                </div>                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">Wolne terminy: </a>
                        </h4>
                    </div>
                    <div id="collapse5" class="panel-collapse collapse">
                        <div class="panel-body">
                            {!! $post->rezervation_date !!}
                        </div>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">Dodatkowe atuty </a>
                        </h4>
                    </div>
                    <div id="collapse6" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul class="no-padding">
                            @foreach($post->tags as $tag)
                                    <li>
                                        {{$tag->name}}
                                    </li>
                            @endforeach
                            </ul>

                        </div>
                    </div>
                </div>
            <h1>Interesuje cię wybrany apartament? Wyślij zapytanie </h1>
        @if ( isset($user) && $user != $post->user_id)
                <?php
                    $reserv = $reservation->all()->where('post_id', $post->id)->where('user_id', $user)->where('owner_id', $post->user_id)->first();
                    ?>

                        <form  method="POST" action="{{ route($currentLocale . '.blog.post.reserve', [$post]) }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        {!! Form::text('data', '', ['placeholder' => 'Interesujące terminy', 'class' => 'form-control contact-input', 'required' => 'true' ]) !!}
                                    </div>
                                    <div class="col-12">
                                        {!! Form::submit('Wyślij wiadomość', ['class' => 'btn btn-success']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
            @endif

                <?php
                    $comments = $reservation->all()->where('status', 1)->where('post_id', $post->id);
                ?>
        <h1>Komentarze: </h1>

    @if(!empty($comments ))
                        @foreach($comments as $comment)
                            <div class="panel panel-warning">
                                @if($comment->comment_ask)
                                <div class="panel-heading">Klient</div>
                                <div class="panel-body">{{$comment->comment_ask}}</div>
                                @endif
                                @if($comment->comment_reply)
                                <div class="panel-heading">Właściciel</div>
                                <div class="panel-body">{{$comment->comment_reply}}</div>
                                @endif
                            </div>
                        @endforeach
                    @endif


        </div>
    </div>
    </div>

@stop
