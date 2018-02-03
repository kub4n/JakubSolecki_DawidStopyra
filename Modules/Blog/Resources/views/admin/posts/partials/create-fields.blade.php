<div class="box-body">
    <div class='form-group{{ $errors->has("$lang.title") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[title]", trans('blog::post.form.title')) !!}
        {!! Form::text("{$lang}[title]", old("$lang.title"), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('blog::post.form.title')]) !!}
        {!! $errors->first("$lang.title", '<span class="help-block">:message</span>') !!}
    </div>
    <div class='form-group{{ $errors->has("$lang.slug") ? ' has-error' : '' }}'>
       {!! Form::label("{$lang}[slug]", trans('blog::post.form.slug')) !!}
       {!! Form::text("{$lang}[slug]", old("$lang.slug"), ['class' => 'form-control slug', 'data-slug' => 'target', 'placeholder' => trans('blog::post.form.slug')]) !!}
       {!! $errors->first("$lang.slug", '<span class="help-block">:message</span>') !!}
    </div>
    <div class='form-group{{ $errors->has("$lang.address") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[address]", trans('blog::post.form.address')) !!}
        {!! Form::textarea("{$lang}[address]", old("$lang.address"), ['class' => 'form-control ckeditor', 'placeholder' => trans('blog::post.form.address')]) !!}
        {!! $errors->first("$lang.address", '<span class="help-block">:message</span>') !!}
    </div>
    <div class='form-group{{ $errors->has("$lang.location") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[location]", trans('blog::post.form.location')) !!}
        {!! Form::textarea("{$lang}[location]", old("$lang.location"), ['class' => 'form-control ckeditor', 'placeholder' => trans('blog::post.form.location')]) !!}
        {!! $errors->first("$lang.location", '<span class="help-block">:message</span>') !!}
    </div>
    <div class='form-group{{ $errors->has("$lang.numberOfPlaces") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[numberOfPlaces]", trans('blog::post.form.numberOfPlaces')) !!}
        {!! Form::number("{$lang}[numberOfPlaces]", old("$lang.numberOfPlaces"), ['class' => 'form-control', 'placeholder' => trans('blog::post.form.numberOfPlaces')]) !!}
        {!! $errors->first("$lang.numberOfPlaces", '<span class="help-block">:message</span>') !!}
    </div>
    <div class='form-group{{ $errors->has("$lang.rezervation_date") ? ' has-error' : '' }}'>

        {!! Form::label("{$lang}[rezervation_date]", trans('blog::post.form.rezervation_date')) !!}
        {!! Form::textarea("{$lang}[rezervation_date]", old("$lang.rezervation_date"), ['class' => 'form-control ckeditor', 'placeholder' => trans('blog::post.form.rezervation_date')]) !!}
        {!! $errors->first("$lang.rezervation_date", '<span class="help-block">:message</span>') !!}
    </div>
    <div class='form-group{{ $errors->has("$lang.closest_term") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[closest_term]", trans('blog::post.form.closest_term')) !!}
        {!! Form::date("{$lang}[closest_term]", old("$lang.closest_term"), ['class' => 'form-control ckeditor', 'placeholder' => trans('blog::post.form.closest_term')]) !!}
        {!! $errors->first("$lang.closest_term", '<span class="help-block">:message</span>') !!}
    </div>
    @editor('content', trans('blog::post.form.content'), old("{$lang}.content"), $lang)

    <?php if (config('asgard.blog.config.post.partials.translatable.create') !== []): ?>
        <?php foreach (config('asgard.blog.config.post.partials.translatable.create') as $partial): ?>
        @include($partial)
        <?php endforeach; ?>
    <?php endif; ?>
</div>
