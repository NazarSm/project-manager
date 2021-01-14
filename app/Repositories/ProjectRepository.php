<?php


namespace App\Repositories;


use App\Models\Project;

class ProjectRepository
{
    public function newProject()
    {
        return (new Project());
    }

    public function findAllByUser($userId)
    {
        return Project::where('user_id', $userId)->get();
    }

    public function findById($id)
    {
        return Project::find($id);
    }
}
