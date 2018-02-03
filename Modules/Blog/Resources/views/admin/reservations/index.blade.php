@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('blog::reservations.title.reservations') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('blog::reservations.title.reservations') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <!--
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.blog.reservation.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('blog::reservations.button.create reservation') }}
                    </a>
                </div>
            </div>
            -->
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data-table table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Typ</th>
                                <th>Data</th>
                                <th>Komentarz</th>
                                <th>Status</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($reservations)): ?>
                            <?php foreach ($reservations as $reservation): ?>
                            <tr>
                                <td>
                                    <a href="{{ route('admin.blog.reservation.edit', [$reservation->id]) }}">
                                        <?php
                                            if ($reservation->owner_id == $user)
                                                echo 'u ciebie rezerwują';
                                            elseif ($reservation->user_id == $user)
                                                echo 'ty rezerwujesz';
                                        ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.blog.reservation.edit', [$reservation->id]) }}">
                                        {{ $reservation->data }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.blog.reservation.edit', [$reservation->id]) }}">
                                        <?php
                                        if ($reservation->owner_id == $user)
                                            echo $reservation->comment_ask;
                                        elseif ($reservation->user_id == $user)
                                            echo $reservation->comment_reply;
                                        ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.blog.reservation.edit', [$reservation->id]) }}">
                                        @if($reservation->status == 0)
                                            Oczekuje na potwierdzenie
                                        @elseif($reservation->status == 1)
                                            Potwierdzone
                                        @elseif($reservation->status == 2)
                                            Odrzucone
                                        @endif
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.blog.reservation.edit', [$reservation->id]) }}">
                                        {{ $reservation->created_at }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.blog.reservation.edit', [$reservation->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                    <!--
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.blog.reservation.destroy', [$reservation->id]) }}"><i class="fa fa-trash"></i></button>
                                    -->
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Typ</th>
                                <th>Data</th>
                                <th>Komentarz</th>
                                <th>Status</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th>{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </tfoot>
                        </table>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    @include('core::partials.delete-modal')
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('blog::reservations.title.create reservation') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.blog.reservation.create') ?>" }
                ]
            });
        });
    </script>
    <?php $locale = locale(); ?>
    <script type="text/javascript">
        $(function () {
            $('.data-table').dataTable({
                "paginate": true,
                "lengthChange": true,
                "filter": true,
                "sort": true,
                "info": true,
                "autoWidth": true,
                "order": [[ 0, "desc" ]],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                }
            });
        });
    </script>
@endpush
