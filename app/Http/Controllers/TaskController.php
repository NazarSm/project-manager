<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Repositories\ProjectRepository;
use App\Repositories\TaskRepository;
use App\Manager\FileManager;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $projectRepository;
    protected $taskRepository;
    protected $uploaderManager;
    protected $userRepository;

    public function __construct(ProjectRepository $projectRepository,
                                TaskRepository $taskRepository,
                                FileManager $uploaderManager,
                                UserRepository $userRepository)
    {
        $this->projectRepository = $projectRepository;
        $this->taskRepository = $taskRepository;
        $this->uploaderManager = $uploaderManager;
        $this->userRepository = $userRepository;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projectId = $_GET['project_id'];

        return view('update_task', compact('projectId'));
    }

    public function store(TaskRequest $taskRequest)
    {
        $newTask = $this->taskRepository->newTask()
            ->create([
                'title' => $taskRequest->input('title'),
                'description' => $taskRequest->input('description'),
                'project_id' => $taskRequest->input('projectId'),
                'status' => Task::STATUSES['new']
            ]);

        $file = $taskRequest->file('file');

        if($file){
            $this->uploaderManager->upload($file, $newTask->id);
        }

        return redirect()->route('projects.show', $newTask->project_id)
            ->with('success', 'Task created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = $this->taskRepository->findById($id);
        $authUser = $this->userRepository->findAuthUser();
        $statuses = Task::STATUSES;

        if ($authUser->id != $task->project->user_id) {
            return redirect()->route('projects.index');
        }

        return view('show_task', compact('task', 'statuses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editTask = $this->taskRepository->findById($id);
        $projectId = $editTask['project_id'];
        $authUser = $this->userRepository->findAuthUser();

        if ($authUser->id != $editTask->project->user_id) {
            return redirect()->route('projects.index');
        }

        return view('update_task', compact('editTask', 'projectId'));
    }


    public function update(TaskRequest $taskRequest, $id)
    {
        $updateTask = $this->taskRepository->findById($id);
        $file = $taskRequest->file('file');

        if($file){
            $this->uploaderManager->upload($file, $updateTask->id);
        }

        $this->taskRepository->findById($id)->fill([
                'title' => $taskRequest->input('title'),
                'description' => $taskRequest->input('description'),
                'project_id' => $taskRequest->input('projectId'),
            ])
            ->save();

        return back()->with('success', 'Task updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteTask = $this->taskRepository->findById($id);
        $deleteTask->forceDelete();

        return redirect()->route('projects.show', $deleteTask->project_id)
            ->with('msg', 'Task deleted');
    }

    public function changeStatus(Request $request)
    {
        $task = $this->taskRepository->findById($request->input('id'));
        $task->status = $request->input('status');
        $task->save();

        return redirect()
            ->route('projects.show', $task->project_id);
    }
}
