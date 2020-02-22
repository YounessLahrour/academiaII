@extends('plantillas.plantilla')
@section('titulo')
    Academia s.a
@endsection
@section('cabecera')
    Gestion de alumnos
@endsection
@section('contenido')
@if ($texto=Session::get('mensaje'))
<p class="alert alert-success my-3">{{$texto}}</p>    
@endif
<form name="search" action="{{route('alumnos.index')}}" method="GET" class="form-inline float-right">
        
  <i class="fa fa-search ml-2 mr-2" aria-hidden="true"></i>           
  Buscar por modulos:
  <select name="modulo_id" onchange="this.form.submit()">
          <option value="%">Todos...</option>
          @foreach ($modulos as $item)
          @if ($item->id== $request->modulo_id)
              <option value="{{$item->id}}"  selected>{{$item->nombre}}</option>
            @else
              <option value="{{$item->id}}" >{{$item->nombre}}</option>
          @endif
          @endforeach    
  </select>  
  <input type="submit" value="Buscar" class="btn btn-info ml-2">
    </form>
<a href="{{route('alumnos.create')}}" class="btn btn-info " ><i class="fa fa-plus"></i> Crear alumno</a>
<table class="table table-dark mt-3">
        <thead>
          <tr>
            <th scope="col" class="align-middle">Detalles</th>
            <th scope="col" class="align-middle">Apellidos, Nombre</th>
            <th scope="col" class="align-middle">Mail</th>
            <th scope="col" class="align-middle">Imagen</th>
            <th scope="col" class="align-middle">Acciones</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($alumnos as $alumno)
            <tr>
            <th scope="row">
                <a href="{{route('alumnos.show', $alumno)}}" style="text-decoration:none"><i class="fa-2x fa fa-address-card"></i></a>
            </th>
            <td class="align-middle">{{$alumno->nombre.", ".$alumno->apellido}}</td>
            <td class="align-middle">{{$alumno->mail}}</td>
                <td class="align-middle">
                <img src="{{asset($alumno->logo)}}" width="90px" height="90px" class="rounded-circle">
                </td>
                <td class="align-middle">
                <form class="form-inline" action="{{route('alumnos.destroy', $alumno)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('¿Desea borrar Alumno?')" class="fa fa-trash btn btn-danger"></button>
                <a href="{{route('alumnos.edit', $alumno)}}" class="ml-2 fa fa-edit fa-2x"></a>
                </form>
                </td>
            </tr>
            @endforeach
          
          
        </tbody>
      </table>
      <a href="{{route('index')}}" class="btn btn-success float-right">Volver al Index</a>
      {{$alumnos->appends(Request::except('page'))->links()}}
@endsection