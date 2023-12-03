@extends('layouts.master')
@section('title','Citas Medicas - Centro Médico Epojé')
@section('contenido')


<div class="row mt-4">

    <div class="row">

        <div class="col-2 mt-1">
            <h5>Seleccione:</h5>

        </div>
        <div class="col-6">
            <select id="tableSelector" class="form-select" onchange="showTable()">
                <option value="agendadas">Agendadas</option>
                <option value="porConfirmar">Por confirmar (3 días)</option>
                <option value="confirmadas">Confirmadas</option>
                <option value="realizadas">Realizadas</option>
                <option value="anuladas">Anuladas</option>
            </select>
        </div>
        <div class="col-4 text-end">
            <a href="{{route('secretaria.index')}}" class="btn btn-outline-dark ">Menu Principal</a>
            <a href="{{route('secretaria.filtrar')}}" class="btn btn-outline-dark ">Filtrar Profesionales</a>
        </div>

    </div>


    <div class="col-12 mt-4">

        <div class="col-12" id="agendadasTable">
            <h4>Agendadas</h4>
            <table class="table table-bordered border-success">
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



        <div class="col-12" id="porConfirmarTable" style="display: none;">
            <h4>Por confirmar (3 dias)</h4>
            <table class="table table-bordered border-success">
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

        <div class="col-12" id="confirmadasTable" style="display: none;">
            <h4>Confirmadas</h4>
            <table class="table table-bordered border-success">
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
                            {{-- <form method="POST" action="{{ route('secretaria.atendida', ['atencionId' => $atencion->id_atencion]) }}">
                            @csrf
                            @method('POST')
                            <button class="btn btn-success text-white d-inline-block" type="submit"><span class="material-symbols-outlined">
                                    check
                                </span></button>
                            </form> --}}
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

        <div class="col-12" id="realizadasTable" style="display: none;">
            <h4>Realizadas</h4>
            <table class="table table-bordered border-success">
                <tr>
                    <th>Paciente</th>
                    <th>Profesional | Especialidad</th>
                    <th>Fecha | Hora </th>
                    <th>Secretaria</th>
                    {{-- <th>Acciones</th> --}}
                </tr>
                @foreach ($atencionesRealizadas as $atencion)
                <tr>
                    <td>{{$atencion->paciente->nom_paciente}} {{$atencion->paciente->apep_paciente}} {{$atencion->paciente->apem_paciente}}</td>
                    <td>{{$atencion->profesional->nom_profesional}} {{$atencion->profesional->apep_profesional}} | {{$atencion->profesional->especialidad->nom_especialidad}}</td>
                    <td>{{$atencion->fecha_atencion}} | {{$atencion->hora_inicio}} </td>
                    <td>{{$atencion->usuario->nom_usuario}} {{$atencion->usuario->apep_usuario}}</td>

                    {{-- <td>
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
        </td> --}}

        </tr>
        @endforeach


        </table>

    </div>

    <div class="col-12" id="anuladasTable" style="display: none;">
        <h4>Anuladas</h4>
        <table class="table table-bordered border-success">
            <tr>
                <th>Paciente</th>
                <th>Profesional | Especialidad</th>
                <th>Fecha | Hora </th>
                <th>Secretaria</th>
                {{-- <th>Acciones</th> --}}
            </tr>
            @foreach ($atencionesCanceladas as $atencion)
            <tr>
                <td>{{$atencion->paciente->nom_paciente}} {{$atencion->paciente->apep_paciente}} {{$atencion->paciente->apem_paciente}}</td>
                <td>{{$atencion->profesional->nom_profesional}} {{$atencion->profesional->apep_profesional}} | {{$atencion->profesional->especialidad->nom_especialidad}}</td>
                <td>{{$atencion->fecha_atencion}} | {{$atencion->hora_inicio}} </td>
                <td>{{$atencion->usuario->nom_usuario}} {{$atencion->usuario->apep_usuario}}</td>

                {{-- <td>
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
    </td> --}}

    </tr>
    @endforeach


    </table>
</div>

<script>
    function showTable() {
        var selectedValue = document.getElementById("tableSelector").value;

        // Hide all tables
        document.getElementById("agendadasTable").style.display = "none";
        document.getElementById("porConfirmarTable").style.display = "none";
        document.getElementById("confirmadasTable").style.display = "none";
        document.getElementById("realizadasTable").style.display = "none";
        document.getElementById("anuladasTable").style.display = "none";
        // Hide other tables...

        // Show the selected table
        document.getElementById(selectedValue + "Table").style.display = "block";
    }

</script>



</div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


@endsection
