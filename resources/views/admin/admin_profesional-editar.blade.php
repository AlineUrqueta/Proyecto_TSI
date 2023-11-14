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
                        <input type="text" placeholder='Email' id='email' name='email' class="form-control" value="{{$profesional->email}}">
                    </div>

                    <div class='m-3'>
                        <select class="custom-select custom-select-lg mb-3 form-control" id='estado_vigente' name='estado_vigente'>
                            @if ($profesional->estado_vigente === 1)
                            <option value="1" selected>Vigente</option>
                            <option value="0"> No Vigente</option>
                            @else
                            <option value="1">Vigente</option>
                            <option value="0" selected> No Vigente</option>
                            @endif

                        </select>
                    </div>



                    <div class='m-3'>

                        <select class="custom-select custom-select-lg mb-3 form-control" id='id_especialidad' name='id_especialidad'>
                            @foreach ($especialidades as $especialidad)
                            @if ($especialidad->id_especialidad === $profesional->id_especialidad_profesional)
                            <option value="{{$especialidad->id_especialidad}}" selected>{{$especialidad->nom_especialidad}}</option>
                            @else
                            <option value="{{$especialidad->id_especialidad}}">
                                {{$especialidad->nom_especialidad}}
                            </option>
                            @endif
                            @endforeach
                        </select>


                    </div>





                    <div class='me-3 mt-4 text-end'>
                        <a href="{{route('admin.indexProfesional')}}" class="btn btn-primary">Volver a profesionales</a>
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
