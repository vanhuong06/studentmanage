<?php

namespace Modules\Manage\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Manage\Entities\Manage;
use Modules\Manage\Http\Requests\CreateManageRequest;
use Modules\Manage\Http\Requests\UpdateManageRequest;
use Modules\Manage\Repositories\ManageRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ManageController extends AdminBaseController
{
    /**
     * @var ManageRepository
     */
    private $manage;

    public function __construct(ManageRepository $manage)
    {
        parent::__construct();

        $this->manage = $manage;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
//        $manages = $this->manage->all();

        return view('manage::admin.manages.index')->with(['manages' => Manage::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('manage::admin.manages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateManageRequest $request
     * @return Response
     */
    public function store(CreateManageRequest $request)
    {
        $this->manage->create($request->all());

        return redirect()->route('admin.manage.manage.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('manage::manages.title.manages')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Manage $manage
     * @return Response
     */
    public function edit(Manage $manage)
    {
        return view('manage::admin.manages.edit', compact('manage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Manage $manage
     * @param  UpdateManageRequest $request
     * @return Response
     */
    public function update(Manage $manage, UpdateManageRequest $request)
    {
        $this->manage->update($manage, $request->all());

        return redirect()->route('admin.manage.manage.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('manage::manages.title.manages')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Manage $manage
     * @return Response
     */
    public function destroy(Manage $manage)
    {
        $this->manage->destroy($manage);

        return redirect()->route('admin.manage.manage.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('manage::manages.title.manages')]));
    }
}
