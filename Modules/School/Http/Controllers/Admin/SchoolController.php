<?php

namespace Modules\School\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Modules\School\Entities\School;
use Modules\School\Http\Requests\CreateSchoolRequest;
use Modules\School\Http\Requests\UpdateSchoolRequest;
use Modules\School\Repositories\SchoolRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class SchoolController extends AdminBaseController
{
    /**
     * @var SchoolRepository
     */
    protected $casts = [
        'school_major' => 'json'
    ];
    private $school;

    public function __construct(SchoolRepository $school)
    {
        parent::__construct();

        $this->school = $school;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $schools = $this->school->all();
//        dd($schools);die();
        return view('school::admin.schools.index', compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $jobs = DB::table('job')
            ->select('job.position')
            ->get();
        return view('school::admin.schools.create', compact('jobs'));
    }


//    public function getMajor(Request $request){
//        $data = $request->major;
//        return response()->json($data);
//    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateSchoolRequest $request
     * @return Response
     */
    public function store(CreateSchoolRequest $request)
    {
        $major = json_encode($request-> school_major);
//        foreach ($major as $value)
//        $major_in = Db::table('school__schools')
//            ->select('school__schools.school_major')
//            ->insert([json_decode($major, true)])
//            ->get();
//        dd(json_decode($major, true)); die();
        $this->school->create( $request->all());
//        dd($request->all());
        return redirect()->route('admin.school.school.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('school::schools.title.schools')]));
    }

//    public function updateMajor(Request $request, $id){
//        $data = School::find($id);
//        $data -> school_major = $request -> major;
//        $data->save();
//
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  School $school
     * @return Response
     */
    public function edit(School $school)
    {
        $jobs = DB::table('addmajor__addmajors')
            ->select('major_id', 'school_code')
            ->get();
//            ->pluck('job.job_id')
//            ->toArray();
        foreach ($jobs as $value)
            $test[] = [
                current($value),
            ];
        $object = (object)$test;
//        dd($value); die();
        return view('school::admin.schools.edit', compact('school', 'jobs', 'test'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  School $school
     * @param  UpdateSchoolRequest $request
     * @return Response
     */
    public function update(School $school, UpdateSchoolRequest $request)
    {

        $this->school->update($school, $request->all());

        return redirect()->route('admin.school.school.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('school::schools.title.schools')]));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  School $school
     * @return Response
     */
    public function destroy(School $school)
    {
        $this->school->destroy($school);

        return redirect()->route('admin.school.school.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('school::schools.title.schools')]));
    }
}
