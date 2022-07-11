<?php

namespace Modules\Task\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Management\Entities\Management;
use Modules\Task\Entities\Task;
use Modules\Task\Http\Requests\CreateTaskRequest;
use Modules\Task\Http\Requests\UpdateTaskRequest;
use Modules\Task\Repositories\TaskRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class TaskController extends AdminBaseController
{
    /**
     * @var TaskRepository
     */
    private $task;

    public function __construct(TaskRepository $task)
    {
        parent::__construct();

        $this->task = $task;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tasks = $this->task->all();
//        $test = DB::table('management__management')
//            ->select('management__management.name', 'id')
//            ->get();
//
//        dd(($test->id));die();

        return view('task::admin.tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
//       $std = DB::table('management__management')
//            ->select('management__management.name')
//            ->get();

        $std = Management::all()->pluck('name', 'id');
//           dd($std);die();
        return view('task::admin.tasks.create' , compact('std'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateTaskRequest $request
     * @return Response
     */
    public function store(CreateTaskRequest $request)
    {

//        dd($request->all());die();
        $this->task->create($request->all());
        return redirect()->route('admin.task.task.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('task::tasks.title.tasks')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Task $task
     * @return Response
     */
    public function edit(Task $task)
    {
        $relations = [
            'employees' => Management::get()->pluck('name', 'id')->prepend('Please select', ''),
        ];
        $std = Management::all()->pluck('name', 'id');
        return view('task::admin.tasks.edit', compact('task', 'std')  + $relations);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Task $task
     * @param  UpdateTaskRequest $request
     * @return Response
     */
    public function update(Task $task, UpdateTaskRequest $request)
    {
        $this->task->update($task, $request->all());
        return redirect()->route('admin.task.task.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('task::tasks.title.tasks')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Task $task
     * @return Response
     */
    public function destroy(Task $task)
    {
        $this->task->destroy($task);

        return redirect()->route('admin.task.task.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('task::tasks.title.tasks')]));
    }
}
