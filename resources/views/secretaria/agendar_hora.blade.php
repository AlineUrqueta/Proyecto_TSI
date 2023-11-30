@extends('layouts.master')
@section('title','Agendar Hora')
@section('contenido')
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #ddd;
        text-align: center;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
    }

    td {
        background-color: #ffffff;
    }

</style>

<div class="row mt-5">
    <div class="col-sm-12 col-md-4">
        <div class="card" style="width: auto; height: auto;">
            <div class="card-header text-center">
                <h4>Agendar hora médica</h4>
            </div>
            <div class="card-body">


                <form action="{{route('secretaria.agendar')}}" class='mt-4' method ="POST">
                    @csrf


                    <div class='m-3'>


                        <select class="custom-select custom-select-lg mb-3 form-control" id='rut_paciente' name='rut_paciente'>
                            <option value="">-- Seleccionar Paciente --</option>
                            @foreach ( $pacientes as $paciente )

                            <option value="{{$paciente->rut_paciente}}">{{$paciente->nom_paciente}} {{$paciente->apep_paciente}} {{$paciente->apem_paciente}}</option>
                            @endforeach

                        </select>
                    </div>


                    <div class='m-3'>
                        <select class="custom-select custom-select-lg mb-3 form-control" id='id_especialidad' name='id_especialidad'>
                            <option value="">-- Seleccionar Especialidad --</option>
                            @foreach ( $especialidades as $especialidad )

                            <option value="{{$especialidad->id_especialidad}}">{{$especialidad->nom_especialidad}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class='m-3'>
                        <select class="custom-select custom-select-lg mb-3 form-control" id='rut_profesional' name='rut_profesional'>
                            <option value="">-- Seleccionar Profesional --</option>
                            @foreach ( $profesionales as $profesional )

                            <option value="{{$profesional->rut_profesional}}">{{$profesional->nom_profesional}} {{$profesional->apep_profesional}} {{$profesional->apem_profesional}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="m-3">
                        <input type="date" class="form-control" id="fecha_atencion" name="fecha_atencion" value="{{ now()->format('Y-m-d') }}" min=" {{ now()->format('Y-m-d') }}" max="2024-01-01">

                    </div>



                    <div class="m-3">
                        <select class="form-control" name="hora_inicio" id="hora_inicio" onchange="actualizarHoraFin()">
                            <option value ="">-- Seleccionar Hora de Inicio --</option>
                            <option value="9:00">9:00</option>
                            <option value="9:45">9:45</option>
                            <option value="10:30">10:30</option>
                            <option value="11:15">11:15</option>
                            <option value="12:00">12:00</option>
                            <option value="12:45">12:45</option>
                            <option value="13:30">13:30</option>
                            <option value="14:15">14:15</option>
                            <option value="15:00">15:00</option>
                            <option value="15:45">15:45</option>
                            <option value="16:30">16:30</option>
                            <option value="17:15">17:15</option>
                            <option value="18:00">18:00</option>
                            <option value="18:45">18:45</option>
                            <option value="19:30">19:30</option>
                            <option value="20:15">20:15</option>
                        </select>

                    </div>

                    <div class="m-3">
                        <input type="text" class="form-control" name="hora_fin" id="hora_fin" value="00:00" readonly>
                        <script>
                            function actualizarHoraFin() {
                                var horaInicioSelect = document.getElementById('hora_inicio');
                                var horaFinInput = document.getElementById('hora_fin');

                                var horaInicioSeleccionada = horaInicioSelect.value;

                                var fechaInicio = new Date('2000-01-01 ' + horaInicioSeleccionada);

                                fechaInicio.setMinutes(fechaInicio.getMinutes() + 45);
                                var horaFin = ('0' + fechaInicio.getHours()).slice(-2) + ':' + ('0' + fechaInicio.getMinutes()).slice(-2);

                                horaFinInput.value = horaFin;
                            }

                            actualizarHoraFin();

                        </script>
                    </div>





                    <div class='m-2 text-end'>
                        <a href="{{route('secretaria.index')}}" class="btn btn-outline-dark  me-2">Menu Principal</a>

                        <button type='submit' class='btn btn-success me-2 '>Agendar Hora</button>
                    </div>



                </form>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var especialidadSelect = document.getElementById('id_especialidad');
                        var profesionalSelect = document.getElementById('rut_profesional');

                        especialidadSelect.addEventListener('change', function() {
                            var especialidadId = this.value;

                            fetch('/obtener-profesionales/' + especialidadId)
                                .then(response => response.json())
                                .then(data => {
                                    profesionalSelect.innerHTML = "<option value=''>-- Seleccionar Profesional --</option>";
                                    data.forEach(profesional => {
                                        profesionalSelect.innerHTML += "<option value='" + profesional.rut_profesional + "'>" + profesional.nom_profesional + " " + profesional.apep_profesional + " " + profesional.apem_profesional + "</option>";
                                    });
                                })
                                .catch(error => console.error('Error:', error));
                        });

                        profesionalSelect.addEventListener('change', function() {
                            var profesionalId = this.value;
                            fetch('/obtener-especialidad/' + profesionalId)
                                .then(response => response.json())
                                .then(data => {
                                    especialidadSelect.innerHTML = "<option value='" + data.id_especialidad + "'>" + data.nom_especialidad + "</option>";
                                })
                                .catch(error => console.error('Error:', error));
                        });
                    });

                </script>




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




    <div class="col-sm-12 col-md-8">
        <table>
            <tr>
                <th>Paciente</th>
                <th>Profesional | Especialidad</th>
                <th>Fecha | Hora </th>
                <th>Secretaria</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            @foreach ($atenciones as $atencion)
            <tr>
                <td>{{$atencion->paciente->nom_paciente}} {{$atencion->paciente->apep_paciente}} {{$atencion->paciente->apem_paciente}}</td>
                <td>{{$atencion->profesional->nom_profesional}} {{$atencion->profesional->apep_profesional}} | {{$atencion->profesional->especialidad->nom_especialidad}}</td>
                <td>{{$atencion->fecha_atencion}} | {{$atencion->hora_inicio}} </td>
                <td>{{$atencion->usuario->nom_usuario}} {{$atencion->usuario->apep_usuario}}</td>
                <td> 
                    @if($atencion->estado_atencion==1)Agendado
                    @elseif ($atencion->estado_atencion==0)Cancelada
                    @else Atendido
                    @endif
                </td>
                <td>
                    <div class="btn-group" role="group" aria-label="Ejemplo de Button Group">
                        <a class="btn btn-warning text-white d-inline-block" href="{{route('secretaria.editHora',$atencion->id_atencion)}}"><span class="material-symbols-outlined">
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






    @endsection
