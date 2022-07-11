<?php

namespace Modules\Timetable\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Modules\Task\Entities\Task;
use Illuminate\Support\Facades\DB;
use Modules\Timetable\Service\CalenderService;
use Illuminate\Http\Response;
use Modules\Timetable\Entities\TimeTable;
use Modules\Timetable\Http\Requests\CreateTimeTableRequest;
use Modules\Timetable\Http\Requests\UpdateTimeTableRequest;
use Modules\Timetable\Repositories\TimeTableRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class TimeTableController extends AdminBaseController
{
    /**
     * @var TimeTableRepository
     */
    private $timetable;

    public function __construct(TimeTableRepository $timetable)
    {
        parent::__construct();

        $this->timetable = $timetable;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $timetables = $this->timetable->all();
        $workinghours = DB::table('task__tasks')->get();
        $test = $workinghours;
//        dd($workinghours);die();
//        dd($weekdays);die();
//        $lessons   = Task::with('class')
//            ->calendarByRoleOrClassId()
//            ->get();


        return view('timetable::admin.timetables.index', compact('test'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(CalenderService $calendarService)
    {
        $weekdays = Task::WEEK_DAYS;
        $test = $weekdays;
        $calendarData = $calendarService->generateCalendarData($weekdays);
        dd($calendarData);die();
        $lessons   = Task::with('class')
            ->calendarByRoleOrClassId()
            ->get();

        return view('timetable::admin.timetables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateTimeTableRequest $request
     * @return Response
     */
    public function store(CreateTimeTableRequest $request)
    {
        $this->timetable->create($request->all());

        return redirect()->route('admin.timetable.timetable.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('timetable::timetables.title.timetables')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  TimeTable $timetable
     * @return Response
     */
    public function edit(TimeTable $timetable)
    {

        return view('timetable::admin.timetables.edit', compact('timetable'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TimeTable $timetable
     * @param  UpdateTimeTableRequest $request
     * @return Response
     */
    public function update(TimeTable $timetable, UpdateTimeTableRequest $request)
    {
        $this->timetable->update($timetable, $request->all());

        return redirect()->route('admin.timetable.timetable.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('timetable::timetables.title.timetables')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  TimeTable $timetable
     * @return Response
     */
    public function destroy(TimeTable $timetable)
    {
        $this->timetable->destroy($timetable);

        return redirect()->route('admin.timetable.timetable.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('timetable::timetables.title.timetables')]));
    }
}
