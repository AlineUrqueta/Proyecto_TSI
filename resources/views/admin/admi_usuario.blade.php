@extends('layouts.master')
@section('title','Mantenedor de usuarios')
@section('contenido')
<div class="row mt-5">
    <div class="col-sm-12 col-md-7  order-md-first order-sm-last">
        <form action="{{route('usuario.search')}}" method="GET">
            @csrf
            <div class="row mb-4">
                <div class="col-6">
                    <input type="text" name="buscar" placeholder="Buscar usuario por nombre o apellido" class="form-control">
                </div>
                <div class="col-4">
                    <button type="" class='btn btn-success '>Buscar</button>
                </div>
            </div>
        </form>
        @if (count($usuarios) === 0 )
        <div class="alert alert-danger">No hay usuarios registrados</div>
        @else
        <table class="table table-bordered border-success  class ='btn btn-warning'">
            <thead>
                <tr>
                    <th scope="col">NOMBRE COMPLETO</th>
                    <th scope="col">EMAIL</th>
                    <th class = "text-center" scope="col">ESTADO</th>
                    <th class = "text-center" scope="col">ACCION</th>
                </tr>
            </thead>
            <tbody>

                @foreach ( $usuarios as $usuario)

                <tr>
                    <th>{{$usuario->nom_usuario}} {{$usuario->apep_usuario}} {{$usuario->apem_usuario}}</th>
                    <td>{{$usuario->email}}</td>
                    
                    @if ($usuario->estado_vigente == 1)
                    <td class="text-center"><span class="material-symbols-outlined">
                            check
                        </span></td>
                    @else
                    <td class="text-center"><span class="material-symbols-outlined">
                            do_not_disturb_on
                        </span></td>
                    @endif
                    <td class = "text-center">    
                        <a class='btn btn-warning text-white' href="{{route('usuario.edit',$usuario->email)}}"><span class="material-symbols-outlined">
                                manufacturing
                            </span></a>

                    </td>
                </tr>


                @endforeach


            </tbody>
        </table>
        @endif

    </div>

<div class="col-sm-12 col-md-5  mb-sm-5  order-md-last order-sm-first">
    <div class="d-flex justify-content-center align-items-center">
        <div class="card" style="width: 45rem; height: auto;">
            <div class="card-header text-center">
                <h4>Registro de Usuarios</h4>
            </div>
            <div class="card-body">


                <form action="{{route('registro.store')}}" class='mt-4' method='POST'>
                    @csrf
                    <div class='m-3'>
                        <input type="text" placeholder='Nombre' id='nom_usuario' name='nom_usuario' class="form-control" value = "{{old('nom_usuario')}}">
                    </div>

                    <div class='m-3'>
                        <input type="text" placeholder='Apellido Paterno' id='apep_usuario' name='apep_usuario' class="form-control" value = "{{old('apep_usuario')}}">
                    </div>

                    <div class='m-3'>
                        <input type="text" placeholder='Apellido Materno' id='apem_usuario' name='apem_usuario' class="form-control" value = "{{old('apem_usuario')}}">
                    </div>

                    <div class='m-3'>
                        <input type="text" placeholder='Celular' id='fono' name='fono' class="form-control" value = "{{old('fono')}}">
                    </div>

                    <div class='m-3'>
                        <input type="email" placeholder='Email' id='email' name='email' class="form-control" value = "{{old('email')}}">
                    </div>

                    <div class='m-3'>
                        <input type="password" placeholder='Contraseña' id='password' name='password' class="form-control" >
                    </div>

                    <div class='m-3'>
                        <input type="password" placeholder='Confirmar Contraseña' id='password_confirmation' name='password_confirmation' class="form-control" >
                    </div>


                    <div class='me-3 mt-4 text-end'>
                        <a href="{{route('admin.index')}}" class="btn btn-outline-dark me-2">Menu Principal</a>
                        <button type='submit' class='btn btn-success '>Crear Usuario</button>
                    </div>






                </form>



                <div class='m-3'>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <p>Por favor solucione los siguientes errores: </p>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>




            </div>
        </div>
    </div>
</div>

</div>



@endsection
