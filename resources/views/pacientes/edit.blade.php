@extends('layouts.master')
@section('title','Editar Paciente')
@section('contenido')
<div class="row mt-5 ">

    <div class="col-md-5 col-sm-12 mx-auto ">
        <div class="card" style="width: 45rem; height: auto;">
            <div class="card-header text-center">
                <h4>Editar Paciente</h4>
            </div>
            <div class="card-body">


                <form action="{{route('pacientes.update',$paciente->rut_paciente)}}" class='mt-4' method='POST'>
                    @csrf
                    @method('put')
                    <div class='m-3'>
                        <input type="text" placeholder='RUT' id='rut_paciente' name='rut_paciente' class="form-control" value="{{$paciente->rut_paciente}}" disabled>
                    </div>
                    <div class='m-3'>
                        <input type="text" placeholder='Nombre' id='nom_paciente' name='nom_paciente' class="form-control" value="{{$paciente->nom_paciente}}">
                    </div>

                    <div class='m-3'>
                        <input type="text" placeholder='Apellido Paterno' id='apep_paciente' name='apep_paciente' class="form-control" value="{{$paciente->apep_paciente}}">
                    </div>

                    <div class='m-3'>
                        <input type="text" placeholder='Apellido Materno' id='apem_paciente' name='apem_paciente' class="form-control" value="{{$paciente->apem_paciente}}">
                    </div>

                    <div class='m-3'>
                        <input type="text" placeholder='Celular' id='fono' name='fono' class="form-control" value="{{$paciente->fono}}">
                    </div>

                    <div class='m-3'>
                        <select class="custom-select custom-select-lg mb-3 form-control" id='estado_vigente' name='estado_vigente'>
                            @if($paciente->estado_vigente == 1)
                                <option value="1" selected>Vigente</option>
                                <option value="0" > No Vigente</option>
                            @else
                                <option value="1"  >Vigente</option>
                                <option value="0" selected> No Vigente</option>
                            @endif
                            
                        </select>
                    </div>

                    <div class='m-3'>
                        <select class="custom-select custom-select-lg mb-3 form-control" id='corp_tea' name='corp_tea'>
                            @if($paciente->corp_tea == 1)
                                <option value="1" selected>Si pertenece a la Corporación TEA</option>
                                <option value="0"> No pertenece a la Corporación TEA</option>
                            @else
                                <option value="1" >Si pertenece a la Corporación TEA</option>
                                <option value="0" selected> No pertenece a la Corporación TEA</option>
                            @endif
                            
                        </select>
                    </div>

                    <div class='m-3'>
                        <small class="ms-2"> Fecha de Nacimiento</small>
                        <input type="date" placeholder='Fecha de nacimiento' id='fecha_nacimiento' name='fecha_nacimiento' class="form-control" value="{{$paciente->fecha_nacimiento}}">
                    </div>



                    <!-- Button trigger modal -->
                    <div class='me-3 mt-4 text-end'>
                        <a href="{{route('pacientes.index')}}" class = "btn btn-primary">Volver a Pacientes</a>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
                            Editar</button>
                    </div>


                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Editar Paciente</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    ¿Desea editar a {{$paciente->nom_paciente}} {{$paciente->apep_paciente}} con RUT {{$paciente->rut_paciente}} ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                                    <button class='btn btn-success' type="submit">Editar</button>

                                </div>
                            </div>
                        </div>
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
