@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('manage::manages.title.manages') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('manage::manages.title.manages') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.manage.manage.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('manage::manages.button.create manage') }}
                    </a>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data-table table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>Attendance</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>


                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($manages)): ?>
                            <?php foreach ($manages as $manage): ?>
                            <tr>
                                <td>{{ $manage->attendance_date }}</td>
                                <td>{{ $manage->emp_id }}</td>
                                <td>{{ $manage->employee->name }}</td>
                                <td>{{ $manage->attendance_time }}
                                    @if ($manage->status == 1)
                                        <span class="badge badge-primary badge-pill float-right">On Time</span>
                                    @else
                                        <span class="badge badge-danger badge-pill float-right">Late</span>
                                @endif
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.manage.manage.edit', [$manage->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.manage.manage.destroy', [$manage->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>

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
        <dd>{{ trans('manage::manages.title.create manage') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.manage.manage.create') ?>" }
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
