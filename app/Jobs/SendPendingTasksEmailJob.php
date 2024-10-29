<?php

namespace App\Jobs;

use App\Enums\TaskStatus;
use App\Mail\PendingTasks;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendPendingTasksEmailJob implements ShouldQueue
{
    use Queueable;

    public $user;
    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $pendingTasks = $this->user->tasks()->where('status', TaskStatus::Pending->value)->get();
        Mail::to($this->user->email)->send(new PendingTasks($this->user, $pendingTasks));
    }
}
