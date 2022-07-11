<?php

namespace Modules\Management\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Management\Entities\Management;
use Modules\Management\Http\Requests\CreateManagementRequest;
use Modules\Management\Http\Requests\UpdateManagementRequest;
use Modules\Management\Repositories\ManagementRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use App\Job;

class ManagementController extends AdminBaseController
{
    /**
     * @var ManagementRepository
     */
    private $management;
    public $managements;

    public function __construct(ManagementRepository $management)
    {
        parent::__construct();

        $this->management = $management;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $management = $this->management->all();
        $managements = DB::table('management__management')
            ->join('job', 'management__management.position', '=', 'job.job_id')
            ->select('job.position', 'management__management.id')
            ->get();
        $school = DB::table('management__management')
            ->join('school__schools', 'management__management.school_code', '=', 'school__schools.school_code')
            ->select('school__schools.school_name', 'management__management.school_code')
            ->get();
//        dd($school);
//        $management = Management::with('jobs')->get();
//        $job = Job::with('management')->get();
        return view('management::admin.management.index', compact('management', 'managements', 'school'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('management::admin.management.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateManagementRequest $request
     * @return Response
     */
    public function store(CreateManagementRequest $request)
    {
//        Management::create($request->except('_token'));
        $this->management->create($request->all());
        return redirect()->route('admin.management.management.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('management::management.title.management')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Management $management
     * @return Response
     */
    public function edit(Management $management)
    {
        $managements = DB::table('management__management')
            ->join('job', 'management__management.position', '=', 'job.job_id')
            ->select('job.position', 'management__management.id')
            ->get();
//        dd($data);
        return view('management::admin.management.edit', compact('management'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Management $management
     * @param  UpdateManagementRequest $request
     * @return Response
     */
    public function update(Management $management, UpdateManagementRequest $request)
    {
        $this->management->update($management, $request->all());

        return redirect()->route('admin.management.management.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('management::management.title.management')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Management $management
     * @return Response
     */
    public function destroy(Management $management)
    {
        $this->management->destroy($management);

        return redirect()->route('admin.management.management.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('management::management.title.management')]));
    }
}
