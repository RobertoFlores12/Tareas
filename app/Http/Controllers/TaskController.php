<?php

namespace App\Http\Controllers;

use App\Models\tasks;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = tasks::query();

        $data['tasks'] = $query->orderBy('id')->paginate(5);
        return view('layouts.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { 
         return view('layouts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        $tasks = new tasks();
        $tasks->title= $request->title;
        $tasks->description= $request->description;
        $tasks->due_date= $request->due_date;
        $tasks->status = $request->status;
        if ($tasks->save()) {
            return redirect()->route('index')->with('alerta', 'Guardado con éxito');
        } else {
            return redirect()->route('index')->with([
                'alerta' => 'Ocurrió un error al agregar',
                'tipo' => 'error',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $task = tasks::find($id);

        return view('layouts.update',compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        $task = tasks::find($id);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->due_date = $request->due_date;
        $task->status = $request->status;

        if ($task->save()) {
            return redirect()->route('index')->with('alerta', 'Tarea actualizada con éxito');
        } else {
            return redirect()->route('index')->with([
                'alerta' => 'Ocurrió un error al actualizar la tarea',
                'tipo' => 'error',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $tarea = tasks::findOrFail($id);
        $tarea->delete();
        if ($tarea->save()) {
            return redirect()->route('index')->with('alerta','La tarea ha sido eliminada exitosamente');
        } else {
            return redirect()->route('index')->with([
                'alerta' => 'Ocurrió un error al actualizar la tarea',
                'tipo' => 'error',
            ]);
        }

    }
}
