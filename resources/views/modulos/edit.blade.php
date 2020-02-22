@extends('plantillas.plantilla')
@section('titulo')
    Academia s.a
@endsection
@section('cabecera')
    Gestion de modulos
@endsection
@section('contenido')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $miError)
        <li>{{$miError}}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card bg-secondary">
    <div class="card-header text-center ">Editar Modulo</div>
    <div class="card-body">
    <form action="{{route('modulos.update', $modulo)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-row">
        <div class="col">
            <label for="nom" class="col-form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" value="{{$modulo->nombre}}"  required>
        </div>
        <div class="col">
                <label for="nom" class="col-form-label">Horas</label>
                <input type="text" name="horas" class="form-control"  value="{{$modulo->horas}}" required>
            </div>
    </div>

            <div class="form-row mt-3">
                <input type="submit" value="Editar" class="btn btn-success mr-3">
                <input type="reset" value="Limpiar" class="btn btn-danger mr-3">
            <a href="{{route('modulos.index')}}" class="btn btn-info" >Volver</a>
                    
            </div>
    </form>

    </div>

</div>

@endsection