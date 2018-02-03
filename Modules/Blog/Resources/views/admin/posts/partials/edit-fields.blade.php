<div class="box-body">
    <div class='form-group{{ $errors->has("$lang.title") ? ' has-error' : '' }}'>
        <?php $oldTitle = isset($post->translate($lang)->title) ? $post->translate($lang)->title : ''; ?>
        {!! Form::label("{$lang}[title]", trans('blog::post.form.title')) !!}
        {!! Form::text("{$lang}[title]", old("$lang.title", $oldTitle), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('blog::post.form.title')]) !!}
        {!! $errors->first("$lang.title", '<span class="help-block">:message</span>') !!}
    </div>
    <div class='form-group{{ $errors->has("$lang.slug") ? ' has-error' : '' }}'>
        <?php $oldSlug = isset($post->translate($lang)->slug) ? $post->translate($lang)->slug : ''; ?>
       {!! Form::label("{$lang}[slug]", trans('blog::post.form.slug')) !!}
       {!! Form::text("{$lang}[slug]", old("$lang.slug", $oldSlug), ['class' => 'form-control slug', 'data-slug' => 'target', 'placeholder' => trans('blog::post.form.slug')]) !!}
       {!! $errors->first("$lang.slug", '<span class="help-block">:message</span>') !!}
    </div>
    <div class='form-group{{ $errors->has("$lang.address") ? ' has-error' : '' }}'>

        <?php $oldTitle = isset($post->translate($lang)->title) ? $post->translate($lang)->title : ''; ?>
        {!! Form::label("{$lang}[address]", trans('blog::post.form.address')) !!}
        {!! Form::textarea("{$lang}[address]", old("$lang.address", $oldTitle), ['class' => 'form-control ckeditor', 'placeholder' => trans('blog::post.form.address')]) !!}
        {!! $errors->first("$lang.address", '<span class="help-block">:message</span>') !!}
    </div>
    <div class='form-group{{ $errors->has("$lang.location") ? ' has-error' : '' }}'>
        <?php $oldLocation = isset($post->translate($lang)->location) ? $post->translate($lang)->location : ''; ?>

        {!! Form::label("{$lang}[location]", trans('blog::post.form.location')) !!}
        {!! Form::textarea("{$lang}[location]", old("$lang.location", $oldLocation), ['class' => 'form-control ckeditor', 'placeholder' => trans('blog::post.form.location')]) !!}
        {!! $errors->first("$lang.location", '<span class="help-block">:message</span>') !!}
    </div>
    <div class='form-group{{ $errors->has("$lang.numberOfPlaces") ? ' has-error' : '' }}'>
        <?php $oldNumberOfPlaces = isset($post->translate($lang)->numberOfPlaces) ? $post->translate($lang)->numberOfPlaces : ''; ?>

        {!! Form::label("{$lang}[numberOfPlaces]", trans('blog::post.form.numberOfPlaces')) !!}
        {!! Form::number("{$lang}[numberOfPlaces]", old("$lang.numberOfPlaces", $oldNumberOfPlaces), ['class' => 'form-control', 'placeholder' => trans('blog::post.form.numberOfPlaces')]) !!}
        {!! $errors->first("$lang.numberOfPlaces", '<span class="help-block">:message</span>') !!}
    </div>
    <div class='form-group{{ $errors->has("$lang.rezervation_date") ? ' has-error' : '' }}'>
        <?php $oldRezervationDate = isset($post->translate($lang)->rezervation_date) ? $post->translate($lang)->rezervation_date : ''; ?>
        {!! Form::label("{$lang}[rezervation_date]", trans('blog::post.form.rezervation_date')) !!}
        {!! Form::textarea("{$lang}[rezervation_date]", old("$lang.rezervation_date", $oldRezervationDate), ['class' => 'form-control ckeditor', 'placeholder' => trans('blog::post.form.rezervation_date')]) !!}
        {!! $errors->first("$lang.rezervation_date", '<span class="help-block">:message</span>') !!}
    </div>
    <div class='form-group{{ $errors->has("$lang.closest_term") ? ' has-error' : '' }}'>
        <?php $oldClosestTerm = isset($post->translate($lang)->closest_term) ? $post->translate($lang)->closest_term : ''; ?>
        {!! Form::label("{$lang}[closest_term]", trans('blog::post.form.closest_term')) !!}
        {!! Form::date("{$lang}[closest_term]", old("$lang.closest_term", $oldClosestTerm), ['class' => 'form-control ckeditor', 'placeholder' => trans('blog::post.form.closest_term')]) !!}
        {!! $errors->first("$lang.closest_term", '<span class="help-block">:message</span>') !!}
    </div>
    <?php $old = isset($post->translate($lang)->content) ? $post->translate($lang)->content : ''; ?>
    @editor('content', trans('blog::post.form.content'), old("$lang.content", $old), $lang)

    <?php if (config('asgard.blog.config.post.partials.translatable.edit') !== []): ?>
        <?php foreach (config('asgard.blog.config.post.partials.translatable.edit') as $partial): ?>
        @include($partial)
        <?php endforeach; ?>
    <?php endif; ?>
</div>
