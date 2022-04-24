<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\TaskType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class TaskController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Add task',
            'taskTypes' => TaskType::get(),
        ];

        return view('user.pages.task.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate
        $request->validate([
            'project_id' => 'required',
            'type_id' => 'required|exists:task_types,id',
            'file' => 'required',
        ], [
            'type_id.exists' => 'The :attribute field has to be a valid type id.',
        ]);

        if (!$request->hasFile('file')) {
            return back()->with('error', 'Select a file');
        }

        $projectId = $request->input('project_id');

        // each task belongs to a project. While choosing the project id, the project id can be
        // a new project id, or an old project id. In case of a new project id insert a new
        // project

        // check project id
        $project = Project::where('id', $projectId)->first();

        if (is_null($project)) {
            // create a new project
            $project = new Project();
            $project->id = $projectId;
            $project->save();
        }

        $task = new Task();

        $file = $request->file('file');
        $fileName = Str::random(16) . time() . $file->getClientOriginalName();

        $filePath = config('global.filesPath');

        if (!File::isDirectory($filePath)) {
            File::makeDirectory($filePath, 0777, true, true);
        }

        // move uploaded file
        $file->move($filePath, $fileName);

        $task->project_id = $projectId;
        $task->status_id = config('global.runningStatusId');
        $task->type_id = $request->input('type_id');
        $task->file_name = $fileName;
        $task->file_path = $filePath;
        $task->random_id = Str::random(16);

        //save
        try {
            $task->save();
        } catch (\Exception $e) {
            return back()->with('error', 'saving failed' . $e->getMessage());
        }

        return redirect()->route('task.create')
            ->with('success', 'Added');
    }

}
