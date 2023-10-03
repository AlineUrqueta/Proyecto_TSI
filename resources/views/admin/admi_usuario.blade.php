@extends('layouts.master')
@section('title','Mantenedor de usuarios')
@section('contenido')
<div class="row mt-5">
    <div class="col-sm-12 col-md-7  order-md-first order-sm-last">
        <form action="">
            {{-- @csrf --}}
            <div class="row mb-4">
                <div class="col-6">
                    <input type="text" name="buscar" placeholder="Buscar usuario" class="form-control">
                </div>
                <div class="col-4">
                    <button type="" class='btn btn-success '>Buscar</button>
                </div>
            </div>
        </form>
        @if (count($usuarios) === 0 )
        <div class="alert alert-danger">No hay usuarios registrados</div>
        @elseif(count($usuarios) === 1)
        <div class="alert alert-danger">No hay usuarios registrados</div>
        @else
        <table class="table table-bordered border-success  class ='btn btn-warning'">
            <thead>
                <tr>
                    <th scope="col">NOMBRE COMPLETO</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">FONO</th>
                    <th scope="col">ACCIONES</th>
                </tr>
            </thead>
            <tbody>

                @foreach ( $usuarios as $usuario)
                @if($usuario->id_tipo <> 1)
                    <tr>
                        <th>{{$usuario->nom_usuario}} {{$usuario->apep_usuario}} {{$usuario->apem_usuario}}</th>
                        <td>{{$usuario->email}}</td>
                        <td>{{$usuario->fono}}</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
                                Eliminar
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Usuario</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Desea eliminar?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <form action="">
                                                <button class='btn btn-danger'>Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a class='btn btn-primary text-white' href="">Editar</a>

                        </td>
                    </tr>
                    @endif

                @endforeach


            </tbody>
        </table>
        @endif

    </div>

    {{-- <div class="col-md-4  mb-sm-5 order-md-last order-sm-first">
        <div class="card" style="width: auto; height: auto;">
            <div class="card-header text-center">
                <h4>Registro de Usuario</h4>
            </div>
            <div class="card-body">


                <form action="" class='mt-4'>
                    @csrf

                    <div class='m-3'>
                        <input type="text" placeholder='Nombre' id='nom_paciente' name='nom_paciente' class="form-control">
                    </div>

                    <div class='m-3'>
                        <input type="text" placeholder='Apellido Paterno' id='apep_paciente' name='apep_paciente' class="form-control">
                    </div>

                    <div class='m-3'>
                        <input type="text" placeholder='Apellido Materno' id='apem_paciente' name='apem_paciente' class="form-control">
                    </div>

                    <div class='m-3'>
                        <input type="text" placeholder='Celular' id='fono' name='fono' class="form-control">
                    </div>

                    <div class='m-3'>
                        <input type="password" placeholder='Contraseña' id='fecha_nacimiento' name='fecha_nacimiento' class="form-control">
                    </div>




                    <div class='me-3 mt-4 text-end'>
                        <a href="{{route('admin.index')}}" class="btn btn-outline-dark me-2">Menu Principal</a>
    <button type='submit' class='btn btn-success '>Crear usuario</button>
</div>



</form>
</div>






</div>
</div> --}}
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
                        <input type="text" placeholder='Nombre' id='nom_usuario' name='nom_usuario' class="form-control">
                    </div>

                    <div class='m-3'>
                        <input type="text" placeholder='Apellido Paterno' id='apep_usuario' name='apep_usuario' class="form-control">
                    </div>

                    <div class='m-3'>
                        <input type="text" placeholder='Apellido Materno' id='apem_usuario' name='apem_usuario' class="form-control">
                    </div>

                    <div class='m-3'>
                        <input type="text" placeholder='Celular' id='fono' name='fono' class="form-control">
                    </div>

                    <div class='m-3'>
                        <input type="email" placeholder='Email' id='email' name='email' class="form-control">
                    </div>

                    <div class='m-3'>
                        <input type="password" placeholder='Contraseña' id='password' name='password' class="form-control">
                    </div>

                    <div class='m-3'>
                        <input type="password" placeholder='Confirmar Contraseña' id='password_confirmation' name='password_confirmation' class="form-control">
                    </div>


                    <div class='me-3 mt-4 text-end'>
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
