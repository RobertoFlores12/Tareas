@extends('layouts.base')
@section('content')
    <div class="row">
        <div class="col-12">
            <div>
                <h2>Crear Tarea</h2>
            </div>
            <div>
                <a href="{{route('index')}}" class="btn btn-primary">Volver</a>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible mt-4">
                <strong>Por las chancas de mi madre!</strong> Algo fue mal..<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

            <script>
                $(document).ready(function () {
                    setTimeout(function () {
                        $('.alert').alert('close');
                    }, 8000);
                });
            </script>
        @endif


        <form action="{{ route('update', $task->id) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <div class="form-group">
                        <strong>Tarea:</strong>
                        <input type="text" value="{{ $task->title }}" name="title" class="form-control"
                               placeholder="Tarea">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <div class="form-group">
                        <strong>Descripción:</strong>
                        <textarea class="form-control" style="height:150px" id="description" name="description"
                                  placeholder="Descripción...">{{ $task->description }}</textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                    <div class="form-group">
                        <strong>Fecha límite:</strong> <span>Fecha Actual {{(\Carbon\Carbon::parse($task->due_date))->format('d/m/Y')}}</span>
                        <input type="date" name="due_date" class="form-control" id="due_date" value="{{(\Carbon\Carbon::parse($task->due_date))->format('d/m/Y')}})">
                    </div>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                    <div class="form-group">
                        <strong>Estado (inicial):</strong>
                        <select name="status" class="form-select" id="status">
                            <option value="">-- Elige el status --</option>
                            <option value="Pendiente" @if($task->status == 'Pendiente') selected @endif>Pendiente
                            </option>
                            <option value="En progreso" @if($task->status == 'En progreso') selected @endif>En
                                progreso
                            </option>
                            <option value="Completada" @if($task->status == 'Completada') selected @endif>
                                Completada
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
