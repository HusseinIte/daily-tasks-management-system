<?php

namespace App\Models;

use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'status',
        'description',
        'due_date',
        'user_id'
    ];

    protected function casts()
    {
        return [
            'due_date' => 'date'
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
