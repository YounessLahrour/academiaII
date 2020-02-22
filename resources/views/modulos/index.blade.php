@extends('plantillas.plantilla')
@section('titulo')
    Academia s.a
@endsection
@section('cabecera')
    Gestion de modulos
@endsection
@section('contenido')
@if ($texto=Session::get('mensaje'))
<p class="alert alert-success my-3">{{$texto}}</p>    
@endif
<form name="search" action="{{route('modulos.index')}}" method="GET" class="form-inline float-right">
        
  <i class="fa fa-search ml-2 mr-2" aria-hidden="true"></i>           
  Buscar por alumnos:
  <select name="alumno_id" onchange="this.form.submit()">
          <option value="%">Todos...</option>
          @foreach ($alumnos as $item)
          @if ($item->id== $request->alumno_id)
              <option value="{{$item->id}}"  selected>{{$item->nombre}}</option>
            @else
              <option value="{{$item->id}}" >{{$item->nombre}}</option>
          @endif
          @endforeach    
  </select>  
  <input type="submit" value="Buscar" class="btn btn-info ml-2">
    </form>
<a href="{{route('modulos.create')}}" class="btn btn-info " ><i class="fa fa-plus"></i> Crear modulo</a>
<table class="table table-dark mt-3">
        <thead>
          <tr>
            <th scope="col" class="align-middle">Id</th>
            <th scope="col" class="align-middle">Nombre</th>
            <th scope="col" class="align-middle">Horas</th>
            <th scope="col" class="align-middle">Acciones</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($modulos as $modulo)
            <tr>
            <td class="align-middle">{{$modulo->id}}</td>
            <td class="align-middle">{{$modulo->nombre}}</td>
            <td class="align-middle">{{$modulo->horas}}</td>
                <td class="align-middle">
                <form class="form-inline" action="{{route('modulos.destroy', $modulo)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('¿Desea borrar modulo?')" class="fa fa-trash btn btn-danger"></button>
                <a href="{{route('modulos.edit', $modulo)}}" class="ml-2 fa fa-edit fa-2x"></a>
                </form>
                </td>
            </tr>
            @endforeach
          
          
        </tbody>

      </table>
    <a href="{{route('index')}}" class="btn btn-success float-right">Volver al Index</a>
      {{$modulos->appends(Request::except('page'))->links()}}
@endsection