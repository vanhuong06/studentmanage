<?php

namespace Modules\Major\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Major\Entities\Major;
use Modules\Major\Http\Requests\CreateMajorRequest;
use Modules\Major\Http\Requests\UpdateMajorRequest;
use Modules\Major\Repositories\MajorRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class MajorController extends AdminBaseController
{
    /**
     * @var MajorRepository
     */
    private $major;

    public function __construct(MajorRepository $major)
    {
        parent::__construct();

        $this->major = $major;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $majors = $this->major->all();

        return view('major::admin.majors.index', compact('majors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('major::admin.majors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateMajorRequest $request
     * @return Response
     */
    public function store(CreateMajorRequest $request)
    {
        $this->major->create($request->all());

        return redirect()->route('admin.major.major.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('major::majors.title.majors')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Major $major
     * @return Response
     */
    public function edit(Major $major)
    {
        return view('major::admin.majors.edit', compact('major'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Major $major
     * @param  UpdateMajorRequest $request
     * @return Response
     */
    public function update(Major $major, UpdateMajorRequest $request)
    {
        $this->major->update($major, $request->all());

        return redirect()->route('admin.major.major.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('major::majors.title.majors')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Major $major
     * @return Response
     */
    public function destroy(Major $major)
    {
        $this->major->destroy($major);

        return redirect()->route('admin.major.major.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('major::majors.title.majors')]));
    }
}
