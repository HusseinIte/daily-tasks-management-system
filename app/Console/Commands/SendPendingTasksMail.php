<?php

namespace App\Console\Commands;

use App\Enums\TaskStatus;
use App\Jobs\SendPendingTasksEmailJob;
use App\Mail\PendingTasks;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Messenger\SendEmailMessage;

class SendPendingTasksMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:pending-tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending Mail to User';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::WhereRelation('tasks', 'status', TaskStatus::Pending->value)->get();
        foreach ($users as $user) {
            SendPendingTasksEmailJob::dispatch($user);
        }
    }
}
