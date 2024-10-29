<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Requests\UpdateTaskStatus;
use App\Services\TaskService;
use Illuminate\Support\Facades\Redirect;

/**
 * Class TaskController
 * @package App\Http\Controllers
 *
 * This controller handles task management, including CRUD operations,
 * status updates, and recycle bin actions.
 */
class TaskController extends Controller
{
    protected $taskService;

    /**
     * TaskController constructor.
     *
     * @param TaskService $taskService
     */
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the tasks.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tasks = $this->taskService->getAllTasks();
        return view('dashboard', compact('tasks'));
    }


    /**
     * Show the form for creating a new task.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('tasks.add-task');
    }


    /**
     * Store a newly created task in storage.
     *
     * @param StoreTaskRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();
        $this->taskService->createTask($validated);
        return Redirect::route('dashboard')->with('success', 'Task Created Successfully');
    }


    /**
     * Show the form for editing the specified task.
     *
     * @param Task $task
     * @return \Illuminate\View\View
     */
    public function edit(Task $task)
    {
        return view('tasks.edit-task', compact('task'));
    }


    /**
     * Update the specified task in storage.
     *
     * @param UpdateTaskRequest $request
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $validated = $request->validated();
        $this->taskService->updateTask($validated, $task);
        return Redirect::route('dashboard')->with('success', 'Task Updated Successfully');
    }

    /**
     * Remove the specified task from storage (soft delete).
     *
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Task $task)
    {
        $this->taskService->deleteTask($task);
        return Redirect::route('dashboard')->with('Task Deleted Successfully');
    }

    /**
     * Display a listing of soft-deleted tasks.
     *
     * @return \Illuminate\View\View
     */
    public function recycleBinTasks()
    {
        $tasks = $this->taskService->getTrashedTasks();
        return view('tasks.task-recycle-bin', compact('tasks'));
    }
    /**
     * Permanently delete the specified soft-deleted task.
     *
     * @param int $taskId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete(int $taskId)
    {
        $this->taskService->forceDeleteTask($taskId);
        return Redirect::route('tasks.recycle')->with('Task Deleted Permanently');
    }

    /**
     * Permanently delete all soft-deleted tasks in the recycle bin.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function emptyRecycleBin()
    {
        $tasks = $this->taskService->emptyRecycleBin();
        return Redirect::route('tasks.recycle')->with('The recycle bin was emptied successfully.');
    }

    /**
     * Restore the specified soft-deleted task.
     *
     * @param int $taskId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(int $taskId)
    {
        $this->taskService->restoreTask($taskId);
        return Redirect::route('tasks.recycle')->with('Task restored Successfully');
    }

    /**
     * Update the status of the specified task.
     *
     * @param UpdateTaskStatus $request
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateTaskStatus(UpdateTaskStatus $request, Task $task)
    {
        $validated = $request->validated();
        $this->taskService->updateTaskStatus($validated['status'], $task);
        return Redirect::route('dashboard')->with('success', 'Task Status Updated Successfully');
    }
}
