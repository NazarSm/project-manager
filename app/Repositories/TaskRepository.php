<?php


namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    public function newTask()
    {
        return (new Task());
    }

    public function findAll()
    {
        return Task::all();
    }

    public function findById($id)
    {
        return Task::find($id);
    }

    public function findByStatus($idProject, $status)
    {
        return Task::where([
            ['project_id', $idProject],
            ['status', $status],
        ])
            ->orderBy('id','DESC')
            ->get();
    }
}
