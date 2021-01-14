<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    const STATUSES = [
      'new'         => 1,
      'in_progress' => 2,
      'done'        => 3
    ];

    protected $fillable = [
        'title',
        'description',
        'file_path',
        'project_id',
        'status',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }
}
