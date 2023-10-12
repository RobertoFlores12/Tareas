@extends('layouts.base')

@section('content')
    <div class="row mt-4">
        @if (!empty(session()->has('alerta')))
            <div class="alert alert-{{ session()->get('tipo') ?? 'success' }}" role="alert">
                {!! session()->get('alerta') !!}
            </div>

            <script>
                $(document).ready(function(){
                    setTimeout(function() {
                        $('.alert').alert('close');
                    }, {{ session()->has('tiempo') ? session()->get('tiempo') : 3000 }});
                });
            </script>
        @endif
    </div>
    <div class="row">
        <div class="col-12">
            <div>
                <h2 class="text-white">CRUD de Tareas</h2>
            </div>
            <div>
                <a href="{{route('Create')}}" class="btn btn-primary">Crear tarea</a>
            </div>
        </div>

        <div class="col-md-12 mt-4">
            <table class="table table-bordered text-white">
                <thead class="">
                <tr class="text-primary">
                    <th>Tarea</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
                </thead>
                <tbody>
                @if (count ($tasks) !=0)
                    @foreach ($tasks as $value)
                        <tr>
                            <td class="fw-bold">{{$value->title}}</td>
                            <td>{{$value->description}}</td>
                            <td>{{ \Carbon\Carbon::parse($value->due_date)->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge bg-warning fs-6">{{$value->status}}</span>
                            </td>
                            <td>
                                <a href="{{ route('edit', $value->id) }}" class="btn btn-warning">Editar</a>

                                <form action="{{ route('delete',$value->id)}}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" id="eliminar" value="" class="btn btn-danger">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="fs-5 m-3 text-center">No hay registros que mostrar</td>
                    </tr>
                @endif

                </tbody>

            </table>
            {{$tasks->links()}}

        </div>
    </div>
@endsection
