<ul class="nav">
         <li>
            <a href="{{route('homepage')}}">Strona główna</a>
       </li>
        <il>
           <a href="/apartamenty/lista">Lista apartamentów</a>
       </il>
    <li>
        <?php echo Form::open(['class' => 'search-input', 'url' => 'search', 'method' => 'get']); ?>
        <?php echo Form::text('searchword', '', ['required' => 'true', 'placeholder' => 'Wyszukiwarka..', 'class' => 'form-control']); ?>
        <button class="btn btn-warning" type="submit">
            Szukaj
        </button>
        <?php echo Form::close() ?>
    </li>
    <li>

    </li>
        <li class="float-right">
            @auth Zalogowany jako: {{$user->first_name}} {{$user->last_name}}

            <a class="button" href="/backend" target="_blank"><button class="btn btn-success">Panel dodawania apartamentu</button></a>
            <a class="button" href="/auth/logout"><button class="btn btn-warning">wyloguj się</button></a>



            @else <a class="button" href="/auth/login"><button class="btn btn-warning">Zaloguj się</button></a>
            @endauth
     </li>
</ul>
