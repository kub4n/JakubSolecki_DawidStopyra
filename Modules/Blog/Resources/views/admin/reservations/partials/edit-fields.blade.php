<div class="box-body">
    <p>
            @if ($reservation->owner_id == Auth::id())
                {{Form::select('status', array('1' => 'Potwierdzam', '2' => 'Odrzucam'))}}
                @if($reservation->comment_ask != '')
                    <p>Od klienta na temat pobytu: {{$rezervation->comment_ask}}</p>
                    <p>Dodaj odpowiedź:</p> {{Form::textarea('comment_reply', null, ['class' => 'field'])}}
                @endif
            @elseif($reservation->user_id == Auth::id())
                @if ($reservation->status == 1)
                    <p>Dodaj komentarz na temat pobytu :<p>
                {{Form::textarea('comment_ask', null, ['class' => 'field'])}}
                @endif
            @endif
    </p>
</div>
