@extends('layouts.master')
@section('title','Editar Profesional')
@section('contenido')
<div class="row mt-5 ">

    <div class="col-md-5 col-sm-12 mx-auto ">
        <div class="card" style="width: 45rem; height: auto;">
            <div class="card-header text-center">
                <h4>Editar profesional</h4>
            </div>
            <div class="card-body">


                <form action="{{route('profesional.update',$profesional->rut_profesional)}}" class='mt-4' method='POST'>
                    @csrf
                    @method('put')
                    <div class='m-3'>
                        <input type="text" placeholder='RUT' id='rut_profesional' name='rut_profesional' class="form-control" value="{{$profesional->rut_profesional}}" disabled>
                    </div>
                    <div class='m-3'>
                        <input type="text" placeholder='Nombre' id='nom_profesional' name='nom_profesional' class="form-control" value="{{$profesional->nom_profesional}}">
                    </div>

                    <div class='m-3'>
                        <input type="text" placeholder='Apellido Paterno' id='apep_profesional' name='apep_profesional' class="form-control" value="{{$profesional->apep_profesional}}">
                    </div>

                    <div class='m-3'>
                        <input type="text" placeholder='Apellido Materno' id='apem_profesional' name='apem_profesional' class="form-control" value="{{$profesional->apem_profesional}}">
                    </div>

                    <div class='m-3'>
                        <input type="text" placeholder='Celular' id='fono' name='fono' class="form-control" value="{{$profesional->fono}}">
                    </div>

                    <div class='m-3'>
                        <select class="custom-select custom-select-lg mb-3 form-control" id='estado_vigente' name='estado_vigente'>
                            @if($profesional->estado_vigente == 1)
                                <option value="1" selected>Vigente</option>
                                <option value="0" > No Vigente</option>
                            @else
                                <option value="1"  >Vigente</option>
                                <option value="0" selected> No Vigente</option>
                            @endif
                            
                        </select>
                    </div>

                    

                    <div class='m-3'>
                        <small class="ms-2"> Fecha de Nacimiento</small>
                        <input type="date" placeholder='Fecha de nacimiento' id='fecha_nacimiento' name='fecha_nacimiento' class="form-control" value="{{$profesional->fecha_nacimiento}}">
                    </div>



                    <!-- Button trigger modal -->
                    <div class='me-3 mt-4 text-end'>
                        <a href="{{route('profesionals.index')}}" class = "btn btn-primary">Volver a profesionals</a>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
                            Editar</button>
                    </div>


                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Editar profesional</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    ¿Desea editar a {{$profesional->nom_profesional}} {{$profesional->apep_profesional}} con RUT {{$profesional->rut_profesional}} ?
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
