@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('management::management.title.management') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('management::management.title.management') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.management.management.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('management::management.button.create management') }}
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
                                <th>STT</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Position</th>
                                <th>Major</th>
                                <th>University</th>
                                <th>Address</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($management)): ?>
                            <?php foreach ($management as $management): ?>
                            <tr>
                                <td>
                                    <a href="{{ route('admin.management.management.edit', [$management->id]) }}">
                                        {{ $management->id }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.management.management.edit', [$management->id]) }}">
                                        {{ $management->name }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.management.management.edit', [$management->id]) }}">
                                        {{ $management->phone }}
                                    </a>
                                </td>
                                <td>
                                    @foreach($managements as $key => $value)
                                        @if($value -> id === $management -> id)
                                        <a href="{{ route('admin.management.management.edit', [$management->id]) }}">
                                            {{$value -> position}}
                                        </a>
                                        @endif
                                     @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('admin.management.management.edit', [$management->id]) }}">
                                        {{ $management->major }}
                                    </a>
                                </td>
                                <td>
                                    @foreach($school as $key => $value)
                                        @if($value -> school_code === $management -> school_code)
                                            <a href="{{ route('admin.management.management.edit', [$management->id]) }}">
                                                {{$value -> school_name}}
                                            </a>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('admin.management.management.edit', [$management->id]) }}">
                                        {{ $management->address }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.management.management.edit', [$management->id]) }}">
                                        {{ $management->created_at -> format('d-m-Y')}}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.management.management.edit', [$management->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.management.management.destroy', [$management->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
{{--                            <tfoot>--}}
{{--                            <tr>--}}
{{--                                <th>STT</th>--}}
{{--                                <th>Name</th>--}}
{{--                                <th>Phone</th>--}}
{{--                                <th>Position</th>--}}
{{--                                <th>Major</th>--}}
{{--                                <th>Address</th>--}}
{{--                                <th>{{ trans('core::core.table.created at') }}</th>--}}
{{--                                <th>{{ trans('core::core.table.actions') }}</th>--}}
{{--                            </tr>--}}
{{--                            </tfoot>--}}
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
        <dd>{{ trans('management::management.title.create management') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.management.management.create') ?>" }
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
