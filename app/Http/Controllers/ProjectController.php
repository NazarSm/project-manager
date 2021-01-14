<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Task;
use App\Repositories\ProjectRepository;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $projectRepository;
    protected $taskRepository;
    protected $userRepository;

    public function __construct(ProjectRepository $projectRepository,
                                TaskRepository $taskRepository,
                                UserRepository $userRepository)
    {
        $this->projectRepository = $projectRepository;
        $this->taskRepository = $taskRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authUser = $this->userRepository->findAuthUser();
        $projects = $this->projectRepository->findAllByUser($authUser->id);

        return view('projects', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('update_project');
    }


    public function store(ProjectRequest $projectRequest)
    {
        $this->projectRepository->newProject()
            ->create([
                'title' => $projectRequest->input('title'),
                'user_id' => $this->userRepository->findAuthUser()->id
            ]);

        return redirect()->route('projects.index')
            ->with('success', 'Project created');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $authUser = $this->userRepository->findAuthUser();
        $project = $this->projectRepository->findById($id);

        if ($authUser->id != $project->user_id) {
            return redirect()->route('projects.index');
        }

        $newTasks = $this->taskRepository->findByStatus($id, Task::STATUSES['new']);
        $inProgressTasks = $this->taskRepository->findByStatus($id, Task::STATUSES['in_progress']);
        $doneTasks = $this->taskRepository->findByStatus($id, Task::STATUSES['done']);

        return view('show_project', compact('project', 'newTasks', 'inProgressTasks', 'doneTasks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editProject = $this->projectRepository->findById($id);
        $authUser = $this->userRepository->findAuthUser();

        if ($authUser->id != $editProject->user_id) {
            return redirect()->route('projects.index');
        }

        return view('update_project', compact('editProject'));
    }


    public function update(ProjectRequest $projectRequest, $id)
    {
        ($this->projectRepository->findById($id))->fill($projectRequest->input())->save();

        return redirect()->route('projects.index')
            ->with('success', 'Project updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->projectRepository->findById($id)->forceDelete();

        return redirect()->route('projects.index')
            ->with('msg', 'Project deleted');
    }
}
