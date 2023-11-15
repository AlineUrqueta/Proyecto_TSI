@extends('layouts.master')
@section('title','Editar Usuario')
@section('contenido')
<div class="row mt-5 ">

    <div class="col-md-5 col-sm-12 mx-auto ">
        <div class="card" style="width: 45rem; height: auto;">
            <div class="card-header text-center">
                <h4>Editar Usuario</h4>
            </div>
            <div class="card-body">

                {{-- {{route('usuario.update',$usuario->email)}}  --}}
                <form action="{{route('usuario.update',$usuario->email)}}" class='mt-4' method='POST'>
                    @csrf
                    @method('put')
                    <div class='m-3'>
                        <input type="text" placeholder='Email' id='email' name='email' class="form-control" value="{{$usuario->email}}" disabled>
                    </div>
                    <div class='m-3'>
                        <input type="text" placeholder='Nombre' id='nom_usuario' name='nom_usuario' class="form-control" value="{{$usuario->nom_usuario}}">
                    </div>

                    <div class='m-3'>
                        <input type="text" placeholder='Apellido Paterno' id='apep_usuario' name='apep_usuario' class="form-control" value="{{$usuario->apep_usuario}}">
                    </div>

                    <div class='m-3'>
                        <input type="text" placeholder='Apellido Materno' id='apem_usuario' name='apem_usuario' class="form-control" value="{{$usuario->apem_usuario}}">
                    </div>

                    <div class='m-3'>
                        <input type="text" placeholder='Celular' id='fono' name='fono' class="form-control" value="{{$usuario->fono}}">
                    </div>

                    @if ($usuario->id_tipo !==1)
                        <div class='m-3'>
                        <select class="custom-select custom-select-lg mb-3 form-control" id='estado_vigente' name='estado_vigente'>
                            @if ($usuario->estado_vigente === 1)
                            <option value="1" selected>Vigente</option>
                            <option value="0"> No Vigente</option>
                            @else
                            <option value="1">Vigente</option>
                            <option value="0" selected> No Vigente</option>
                            @endif

                        </select>
                    </div>

                    @endif
                    


                    <div class='me-3 mt-4 text-end'>
                        <a href="{{route('admin.showUsuario')}}" class="btn btn-primary">Volver a usuarios</a>
                        <button type='submit' class='btn btn-success '>Editar </button>
                        
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
                    @else
                        @if(session('editarCorrecto'))
                            <div class="alert alert-success">{{ session('editarCorrecto') }}</div>
                        @endif
                    @endif
                </div>
            </div>






        </div>
    </div>

</div>



@endsection
