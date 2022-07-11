@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('timetable::timetables.title.timetables') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('timetable::timetables.title.timetables') }}</li>
    </ol>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

    <div id='calendar'></div>
@stop



@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('timetable::timetables.title.create timetable') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.timetable.timetable.create') ?>" }
                ]
            });
        });
    </script>
    <?php $locale = locale(); ?>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
    <script>
        $(document).ready(function() {
            // page is now ready, initialize the calendar...
            $('#calendar').fullCalendar({
                // put your options and callbacks here
                defaultView: 'agendaWeek',
                events : [
                        @foreach($test as $hour)
                    {
                        title : '{{ $hour->student_id }}',
                        start : '{{ $hour->date . ' ' . $hour->start_time }}',
                        end : '{{ $hour->date . ' ' . $hour->end_time }}',
                        url : '{{ route('admin.task.task.edit', $hour->id) }}'
                    },
                    @endforeach
                ]
            })
        });
    </script>
@endpush
