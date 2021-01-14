<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    public const PATH = 'app/public/files';

    protected $fillable = [
        'name',
        'original_name',
        'task_id',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

}
