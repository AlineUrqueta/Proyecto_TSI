@extends('layouts.master')
@section('title','Citas Medicas - Centro Médico Epojé')
@section('contenido')


<div class="row mt-4" style="position: relative;">
    <div class="col-3">
        <div id="list-example" class="list-group">
            <a class="list-group-item list-group-item-action" href="#list-item-1">Agendadas</a>
            <a class="list-group-item list-group-item-action" href="#list-item-2">Por Confirmar</a>
            <a class="list-group-item list-group-item-action" href="#list-item-3">Confirmadas</a>
            <a class="list-group-item list-group-item-action" href="#list-item-4">Anuladas</a>
        </div>
    </div>
    <div class="col-9" style="position: relative; height: 40rem; overflow-y: scroll;" tabindex="0">
        <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-offset="0" class="scrollspy-example" tabindex="0">
            <div class="col">
                <h4 id="list-item-1">Agendadas</h4>
                <table class="table table-bordered border-success" style="width:auto;height:auto">
                    <tr>
                        <th>Paciente</th>
                        <th>Profesional | Especialidad</th>
                        <th>Fecha | Hora </th>
                        <th>Secretaria</th>
                        <th>Acciones</th>
                    </tr>
                    @foreach ($atencionesAgendadas as $atencion)
                    <tr>
                        <td>{{$atencion->paciente->nom_paciente}} {{$atencion->paciente->apep_paciente}} {{$atencion->paciente->apem_paciente}}</td>
                        <td>{{$atencion->profesional->nom_profesional}} {{$atencion->profesional->apep_profesional}} | {{$atencion->profesional->especialidad->nom_especialidad}}</td>
                        <td>{{$atencion->fecha_atencion}} | {{$atencion->hora_inicio}} </td>
                        <td>{{$atencion->usuario->nom_usuario}} {{$atencion->usuario->apep_usuario}}</td>

                        <td>
                            <div class="btn-group" role="group" aria-label="Ejemplo de Button Group">
                                <a href="{{route('secretaria.editHora',['atencion'=>$atencion->id_atencion])}}" class="btn btn-warning text-white d-inline-block"><span class="material-symbols-outlined">
                                        manufacturing
                                    </span></a>
                                <form method="POST" action="{{ route('secretaria.atendida', ['atencionId' => $atencion->id_atencion]) }}">
                                    @csrf
                                    @method('POST')
                                    <button class="btn btn-success text-white d-inline-block" type="submit"><span class="material-symbols-outlined">
                                            check
                                        </span></button>
                                </form>
                                <form method="POST" action="{{ route('secretaria.cancelada', ['atencionId' => $atencion->id_atencion]) }}">
                                    @csrf
                                    @method('POST')
                                    <button class="btn btn-danger text-white d-inline-block" type="submit"><span class="material-symbols-outlined">
                                            block
                                        </span></button>
                                </form>

                            </div>
                        </td>

                    </tr>
                    @endforeach


                </table>
            </div>

            <div class="col">
                <h4 id="list-item-2">Por confirmar (3 dias)</h4>
                <table class="table table-bordered border-success" style="width:auto;height:auto">
                    <tr>
                        <th>Paciente</th>
                        <th>Profesional | Especialidad</th>
                        <th>Fecha | Hora </th>
                        <th>Secretaria</th>
                        <th>Acciones</th>
                    </tr>
                    @foreach ($atencionesPorConfirmar as $atencion)
                    <tr>
                        <td>{{$atencion->paciente->nom_paciente}} {{$atencion->paciente->apep_paciente}} {{$atencion->paciente->apem_paciente}}</td>
                        <td>{{$atencion->profesional->nom_profesional}} {{$atencion->profesional->apep_profesional}} | {{$atencion->profesional->especialidad->nom_especialidad}}</td>
                        <td>{{$atencion->fecha_atencion}} | {{$atencion->hora_inicio}} </td>
                        <td>{{$atencion->usuario->nom_usuario}} {{$atencion->usuario->apep_usuario}}</td>

                        <td>
                            <div class="btn-group" role="group" aria-label="Ejemplo de Button Group">
                                <button class="btn btn-warning text-white d-inline-block"><span class="material-symbols-outlined">
                                        manufacturing
                                    </span></button>
                                <form method="POST" action="{{ route('secretaria.atendida', ['atencionId' => $atencion->id_atencion]) }}">
                                    @csrf
                                    @method('POST')
                                    <button class="btn btn-success text-white d-inline-block" type="submit"><span class="material-symbols-outlined">
                                            check
                                        </span></button>
                                </form>
                                <form method="POST" action="{{ route('secretaria.cancelada', ['atencionId' => $atencion->id_atencion]) }}">
                                    @csrf
                                    @method('POST')
                                    <button class="btn btn-danger text-white d-inline-block" type="submit"><span class="material-symbols-outlined">
                                            block
                                        </span></button>
                                </form>

                            </div>
                        </td>

                    </tr>
                    @endforeach


                </table>
            </div>

            <div class="col">
                <h4 id="list-item-3">Confirmadas</h4>
                <table class="table table-bordered border-success" style="width:auto;height:auto">
                    <tr>
                        <th>Paciente</th>
                        <th>Profesional | Especialidad</th>
                        <th>Fecha | Hora </th>
                        <th>Secretaria</th>
                        <th>Acciones</th>
                    </tr>
                    @foreach ($atencionesConfirmadas as $atencion)
                    <tr>
                        <td>{{$atencion->paciente->nom_paciente}} {{$atencion->paciente->apep_paciente}} {{$atencion->paciente->apem_paciente}}</td>
                        <td>{{$atencion->profesional->nom_profesional}} {{$atencion->profesional->apep_profesional}} | {{$atencion->profesional->especialidad->nom_especialidad}}</td>
                        <td>{{$atencion->fecha_atencion}} | {{$atencion->hora_inicio}} </td>
                        <td>{{$atencion->usuario->nom_usuario}} {{$atencion->usuario->apep_usuario}}</td>

                        <td>
                            <div class="btn-group" role="group" aria-label="Ejemplo de Button Group">

                                <a href="{{route('secretaria.editHora',['atencion'=>$atencion->id_atencion])}}" class="btn btn-warning text-white d-inline-block"><span class="material-symbols-outlined">
                                        manufacturing
                                    </span></a>
                                <form method="POST" action="{{ route('secretaria.atendida', ['atencionId' => $atencion->id_atencion]) }}">
                                    @csrf
                                    @method('POST')
                                    <button class="btn btn-success text-white d-inline-block" type="submit"><span class="material-symbols-outlined">
                                            check
                                        </span></button>
                                </form>
                                <form method="POST" action="{{ route('secretaria.cancelada', ['atencionId' => $atencion->id_atencion]) }}">
                                    @csrf
                                    @method('POST')
                                    <button class="btn btn-danger text-white d-inline-block" type="submit"><span class="material-symbols-outlined">
                                            block
                                        </span></button>
                                </form>

                            </div>
                        </td>

                    </tr>
                    @endforeach


                </table>
            </div>

            <div class="col">
                <h4 id="list-item-4">Anuladas</h4>
                <table class="table table-bordered border-success" style="width:auto;height:auto">
                    <tr>
                        <th>Paciente</th>
                        <th>Profesional | Especialidad</th>
                        <th>Fecha | Hora </th>
                        <th>Secretaria</th>
                        <th>Acciones</th>
                    </tr>
                    @foreach ($atencionesCanceladas as $atencion)
                    <tr>
                        <td>{{$atencion->paciente->nom_paciente}} {{$atencion->paciente->apep_paciente}} {{$atencion->paciente->apem_paciente}}</td>
                        <td>{{$atencion->profesional->nom_profesional}} {{$atencion->profesional->apep_profesional}} | {{$atencion->profesional->especialidad->nom_especialidad}}</td>
                        <td>{{$atencion->fecha_atencion}} | {{$atencion->hora_inicio}} </td>
                        <td>{{$atencion->usuario->nom_usuario}} {{$atencion->usuario->apep_usuario}}</td>

                        <td>
                            <div class="btn-group" role="group" aria-label="Ejemplo de Button Group">
                                <button class="btn btn-warning text-white d-inline-block"><span class="material-symbols-outlined">
                                        manufacturing
                                    </span></button>
                                <form method="POST" action="{{ route('secretaria.atendida', ['atencionId' => $atencion->id_atencion]) }}">
                                    @csrf
                                    @method('POST')
                                    <button class="btn btn-success text-white d-inline-block" type="submit"><span class="material-symbols-outlined">
                                            check
                                        </span></button>
                                </form>
                                <form method="POST" action="{{ route('secretaria.cancelada', ['atencionId' => $atencion->id_atencion]) }}">
                                    @csrf
                                    @method('POST')
                                    <button class="btn btn-danger text-white d-inline-block" type="submit"><span class="material-symbols-outlined">
                                            block
                                        </span></button>
                                </form>

                            </div>
                        </td>

                    </tr>
                    @endforeach


                </table>
            </div>


        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('body').scrollspy({
            target: '#list-example'
        });
    });

</script>

@endsection
