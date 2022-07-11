<?php

namespace Modules\Addmajor\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Addmajor\Entities\AddMajor;
use Modules\Addmajor\Http\Requests\CreateAddMajorRequest;
use Modules\Addmajor\Http\Requests\UpdateAddMajorRequest;
use Modules\Addmajor\Repositories\AddMajorRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class AddMajorController extends AdminBaseController
{
    /**
     * @var AddMajorRepository
     */
    private $addmajor;

    public function __construct(AddMajorRepository $addmajor)
    {
        parent::__construct();

        $this->addmajor = $addmajor;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $addmajors = $this->addmajor->all();

        return view('addmajor::admin.addmajors.index', compact('addmajors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $sch = DB::table('school__schools')
            ->select('school_code', 'school_name')
            ->get();
        $mj = DB::table('major__majors')
            ->select('major_name', 'major_id')
            ->get();


        return view('addmajor::admin.addmajors.create', compact('sch', 'mj'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateAddMajorRequest $request
     * @return Response
     */
    public function store(CreateAddMajorRequest $request)
    {
//        dd($request->all());die();

        $major_value = $request-> major;
        $school_value = $request-> addMajor;

//        $arr = array();
//        array_push($arr, (object)[
//            'major_id' => current($major_value),
//            "school_code" => current($school_value)
//        ]);
        $test[] = [
            'major_id' => current($major_value),
            'school_code' => current($school_value)
        ];
//        dd(current($test)); die();
        DB::table('addmajor__addmajors')->insert(current($test));
//
//        $this->addmajor->create($request->all());

        return redirect()->route('admin.school.school.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('addmajor::addmajors.title.addmajors')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  AddMajor $addmajor
     * @return Response
     */
    public function edit(AddMajor $addmajor)
    {
        return view('addmajor::admin.addmajors.edit', compact('addmajor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AddMajor $addmajor
     * @param  UpdateAddMajorRequest $request
     * @return Response
     */
    public function update(AddMajor $addmajor, UpdateAddMajorRequest $request)
    {
        $this->addmajor->update($addmajor, $request->all());

        return redirect()->route('admin.addmajor.addmajor.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('addmajor::addmajors.title.addmajors')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  AddMajor $addmajor
     * @return Response
     */
    public function destroy(AddMajor $addmajor)
    {
        $this->addmajor->destroy($addmajor);

        return redirect()->route('admin.addmajor.addmajor.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('addmajor::addmajors.title.addmajors')]));
    }
}
