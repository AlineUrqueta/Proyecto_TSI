@extends('layouts.master')
@section('title','Mantenedor de Pacientes')
@section('contenido')
<div class="row mt-5">
    <div class="col-sm-12 col-md-7 mb-sm-5 order-md-first order-sm-last">
        <form action="{{route('pacientes.search')}}" method="GET">
            @csrf
            <div class="row mb-4">
                <div class="col-6">
                    <input type="text" name="buscar" placeholder="Buscar por apellido paterno o rut" class="form-control">
                </div>
                <div class="col-4">
                    <button type="submit" class='btn btn-success '>Buscar</button>
                </div>
            </div>
        </form>

        @if (count($pacientes) === 0)
        <div class="alert alert-danger">No hay pacientes registrados</div>
        @else

        <table class="table table-bordered border-success">
            <thead>
                <tr>
                    <th scope="col">RUT</th>
                    <th scope="col">NOMBRE COMPLETO</th>
                    <th scope="col" class ="text-center">ESTADO</th>
                    <th scope="col" class ="text-center">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $pacientes as $paciente )
                <tr>
                    <td>{{$paciente->rut_paciente}}</td>
                    <td>{{$paciente->nom_paciente}} {{$paciente->apep_paciente}} {{$paciente->apem_paciente}}</td>
                    @if ($paciente->estado_vigente == 1)
                    <td class="text-center"><span class="material-symbols-outlined">
                            check
                        </span></td>
                    @else
                    <td class="text-center"><span class="material-symbols-outlined">
                            do_not_disturb_on
                        </span></td>
                    @endif
                    <td class = "text-center"> 
                        <a class='btn btn-primary text-white ' href="{{route('pacientes.show',$paciente->rut_paciente)}}"><span class="material-symbols-outlined">
                                contact_page
                            </span></a>


                        <a class='btn btn-warning text-white' href="{{route('pacientes.edit',$paciente->rut_paciente)}}"><span class="material-symbols-outlined">
                                manufacturing
                            </span>
                        </a>

                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        @endif



    </div>

    <div class="col-md-5  mb-sm-5 order-md-last order-sm-first">
        <div class="card" style="width: auto; height: auto;">
            <div class="card-header text-center">
                <h4>Registro de Pacientes</h4>
            </div>
            <div class="card-body">


                <form action="{{route('pacientes.store')}}" class='mt-4' method='POST'>
                    @csrf

                    <div class='m-3'>
                        <input type="text" placeholder='Rut' id='rut_paciente' name='rut_paciente' class="form-control" value="{{ old('rut_paciente') }}">
                        <small class="ms-2"> Formato: 9999999-K</small>
                    </div>
                    <div class='m-3'>
                        <input type="text" placeholder='Nombre' id='nom_paciente' name='nom_paciente' class="form-control" value="{{ old('nom_paciente') }}">
                    </div>

                    <div class='m-3'>
                        <input type="text" placeholder='Apellido Paterno' id='apep_paciente' name='apep_paciente' class="form-control" value="{{ old('apep_paciente') }}">
                    </div>

                    <div class='m-3'>
                        <input type="text" placeholder='Apellido Materno' id='apem_paciente' name='apem_paciente' class="form-control" value="{{ old('apem_paciente') }}">
                    </div>

                    <div class='m-3'>
                        <input type="text" placeholder='Celular' id='fono' name='fono' class="form-control" value="{{ old('fono') }}">
                    </div>

                    <div class='m-3'>
                        <select class="custom-select custom-select-lg mb-3 form-control" id='corp_tea' name='corp_tea'>
                            <option value="">¿Pertenece a la Corporación TEA?</option>
                            <option value="1">Si pertenece</option>
                            <option value="0">No pertenece</option>
                        </select>
                    </div>

                    <div class='m-3'>
                        <small class="ms-2"> Fecha de Nacimiento</small>
                        <input type="date" placeholder='Fecha de nacimiento' id='fecha_nacimiento' name='fecha_nacimiento' class="form-control" value="{{ old('fecha_nacimiento') }}">

                    </div>



                    <div class='me-3 mt-4 text-end'>
                        @if (auth()->user()->id_tipo == 1)
                        <a href="{{route('admin.index')}}" class="btn btn-light ">Menu Principal</a>
                        @else
                        <a href="{{route('secretaria.index')}}" class="btn btn-outline-dark">Menu Principal</a>
                        @endif
                        <button type='submit' class='btn btn-success '>Crear paciente</button>
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



@endsection

{{-- Eliminar --}}
{{-- <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter{{$paciente->rut_paciente}}">
Eliminar
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter{{$paciente->rut_paciente}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Paciente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Desea eliminar a {{$paciente->nom_paciente}} {{$paciente->apep_paciente}} con RUT {{$paciente->rut_paciente}} ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form action="{{route('pacientes.destroy',$paciente->rut_paciente)}}" method="POST">
                    @csrf
                    @method('delete')

                    <button class='btn btn-danger' type="submit">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div> --}}
