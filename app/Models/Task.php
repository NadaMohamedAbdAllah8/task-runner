<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'project_id', 'status_id', 'type_id', 'file_name', 'file_path', 'no_of_occurrences', 'started_at',
        'ended_at', 'failure_reason', 'random_id',
    ];

    public function type()
    {
        return $this->belongsTo(TaskType::class);
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
