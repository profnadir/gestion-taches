<?php

namespace App\Http\Controllers;

use App\Events\TaskUpdated;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titre' => 'required|max:255',
            'description' => 'required',
            'date_echeance' => 'required|date',
            'statut' => 'required|in:en cours,terminée'
        ]);
    
        $task = new Task;
        $task->titre = $validatedData['titre'];
        $task->description = $validatedData['description'];
        $task->date_echeance = $validatedData['date_echeance'];
        $task->statut = $validatedData['statut'];
        $task->save();
    
        return redirect()->route('tasks.index')->with('success', 'Tâche ajoutée avec succès !');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'date_echeance' => 'required|date',
            'statut' => 'required|in:en cours,terminée',
        ]);
    
        $task->titre = $validatedData['titre'];
        $task->description = $validatedData['description'];
        $task->date_echeance = $validatedData['date_echeance'];
        $task->statut = $validatedData['statut'];
        $task->save();
    
        event(new TaskUpdated($task));

        return redirect()->route('tasks.index')->with('success', 'La tâche a été mise à jour avec succès.');
    }

    public function delete(Task $task)
    {
        return view('tasks.delete', compact('task'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        if (!$task) {
            return redirect()->route('tasks.index')->with('error', 'La tâche que vous essayez de supprimer n\'existe pas.');
        }
    
        $task->delete();
    
        return redirect()->route('tasks.index')->with('success', 'La tâche a été supprimée avec succès.');
    }
}
