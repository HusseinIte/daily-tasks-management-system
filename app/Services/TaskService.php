<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

/**
 * Class TaskService
 *
 * This service class provides various methods for managing tasks,
 * including retrieving, creating, updating, deleting, and restoring tasks.
 */
class TaskService
{
    /**
     * Get all tasks belonging to the authenticated user.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllTasks()
    {
        return Task::where('user_id', Auth::id())->get();
    }

    /**
     * Get all trashed (soft-deleted) tasks belonging to the authenticated user.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTrashedTasks()
    {
        return Task::onlyTrashed()->where('user_id', Auth::id())->get();
    }


    /**
     * Create a new task for the authenticated user.
     *
     * @param array $data Data to create the task (title, description, due date).
     * @return void
     */
    public function createTask(array $data)
    {
        Task::create([
            'title'       => $data['title'],
            'description' => !empty($data['description']) ? $data['description'] : null,
            'due_date'    => $data['due_date'],
            'user_id'     => Auth::id()
        ]);
    }

    /**
     * Update an existing task.
     *
     * @param array $data Data to update the task.
     * @param \App\Models\Task $task The task instance to be updated.
     * @return void
     */
    public function updateTask(array $data, $task)
    {
        $task->update(array_filter($data));
    }

    /**
     * Soft delete a task.
     *
     * @param \App\Models\Task $task The task instance to be deleted.
     * @return void
     */
    public function deleteTask(Task $task)
    {
        $task->delete();
    }

    /**
     * Permanently delete a task, including soft-deleted tasks.
     *
     * @param int $taskId The ID of the task to be permanently deleted.
     * @return void
     */
    public function forceDeleteTask($taskId)
    {
        $task = Task::withTrashed()->find($taskId);
        $task->forceDelete();
    }


    /**
     * Restore a soft-deleted task.
     *
     * @param int $taskId The ID of the task to be restored.
     * @return void
     */
    public function restoreTask($taskId)
    {
        $task = Task::withTrashed()->find($taskId);
        $task->restore();
    }

    /**
     * Permanently delete all soft-deleted tasks.
     *
     * @return void
     */
    public function emptyRecycleBin()
    {
        Task::onlyTrashed()->forceDelete();
    }

    /**
     * Update the status of a task.
     *
     * @param string $newStatus The new status to set for the task.
     * @param \App\Models\Task $task The task instance whose status is to be updated.
     * @return void
     */
    public function updateTaskStatus($newStatus, $task)
    {
        $task->status = $newStatus;
        $task->save();
    }
}
