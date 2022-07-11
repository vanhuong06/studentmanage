<?php

namespace Modules\Attendance\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Attendance\Entities\Attendance;
use Modules\Attendance\Http\Requests\CreateAttendanceRequest;
use Modules\Attendance\Http\Requests\UpdateAttendanceRequest;
use Modules\Attendance\Repositories\AttendanceRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Manage\Entities\Manage;
use Modules\Management\Entities\Management;

class AttendanceController extends AdminBaseController
{
    /**
     * @var AttendanceRepository
     */
    private $attendance;

    public function __construct(AttendanceRepository $attendance)
    {
        parent::__construct();

        $this->attendance = $attendance;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $attendances = $this->attendance->all();
        return view('attendance::admin.attendances.index', compact('attendances'))->with(['employees' => Management::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('attendance::admin.attendances.create')->with(['employees' => Management::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateAttendanceRequest $request
     * @return Response
     */

    public function store(CreateAttendanceRequest $request)
    {
        $this->attendance->create($request->all());
        if (isset($request->attd)) {
            foreach ($request->attd as $keys => $values) {
                foreach ($values as $key => $value) {
                    if ($employee = Management::whereId(request('emp_id'))->first()) {
                        if (
                            !Manage::whereAttendance_date($keys)
                                ->whereEmp_id($key)
                                ->whereType(0)
                                ->first()
                        ) {
                            $data = new Manage();

                            $data->emp_id = $key;
                            $emp_req = Management::whereId($data->emp_id)->first();
                            $data ->attendance_time = Carbon::now()->format('H:i:s');
                            $data->attendance_date = $keys;

                            // $emps = date('H:i:s', strtotime($employee->schedules->first()->time_in));
                            // if (!($emps >= $data->attendance_time)) {
                            //     $data->status = 0;

                            // }
                            $data->save();
                        }
                    }
                }
            }
        }
//        dd($request->all());
        return redirect()->route('admin.attendance.attendance.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('attendance::attendances.title.attendances')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Attendance $attendance
     * @return Response
     */
    public function edit(Attendance $attendance)
    {
        return view('attendance::admin.attendances.edit', compact('attendance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Attendance $attendance
     * @param  UpdateAttendanceRequest $request
     * @return Response
     */
    public function update(Attendance $attendance, UpdateAttendanceRequest $request)
    {
        $this->attendance->update($attendance, $request->all());

        return redirect()->route('admin.attendance.attendance.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('attendance::attendances.title.attendances')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Attendance $attendance
     * @return Response
     */
    public function destroy(Attendance $attendance)
    {
        $this->attendance->destroy($attendance);

        return redirect()->route('admin.attendance.attendance.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('attendance::attendances.title.attendances')]));
    }
}
