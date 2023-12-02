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


                <form action="{{route('secretaria.agendar')}}" class='mt-4' method="POST">
                    @csrf


                    <div class='m-3'>
                        <select class="custom-select custom-select-lg mb-3 form-control" id='rut_paciente_atenciones' name='rut_paciente_atenciones'>
                            <option value="">-- Seleccionar Paciente --</option>
                            @foreach ( $pacientes as $paciente )
                                @if($paciente->estado_vigente==1)
                                    <option value="{{$paciente->rut_paciente}}">{{$paciente->nom_paciente}} {{$paciente->apep_paciente}} {{$paciente->apem_paciente}}</option>
                                @endif
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
                        <select class="custom-select custom-select-lg mb-3 form-control" id='rut_profesional_atenciones' name='rut_profesional_atenciones'>
                            <option value="">-- Seleccionar Profesional --</option>
                            @foreach ( $profesionales as $profesional )

                            <option value="{{$profesional->rut_profesional}}">{{$profesional->nom_profesional}} {{$profesional->apep_profesional}} {{$profesional->apem_profesional}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="m-3">
                        <input type="date" class="form-control" id="fecha_atencion" name="fecha_atencion" value="{{ now()->format('Y-m-d') }}" min=" {{ now()->format('Y-m-d') }}" max="2024-01-01">
                    </div>

                    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

                    <script>
                        const picker = document.getElementById('fecha_atencion');
                        picker.addEventListener('input', function(e) {
                            var diaSeleccionado = new Date(this.value).getUTCDay();
                            if (diaSeleccionado === 0) {
                                e.preventDefault();
                                this.value = '';
                                alert('No se atiende los domingos');
                            }
                        });
                    </script>

                    <div class="m-3">

                        <select class="form-control" name="hora_inicio" id="hora_inicio" onchange="actualizarHoraFin()">
                            <option value="">-- Seleccionar Hora de Inicio --</option>
                            @foreach ($horas as $hora)
                            <option value="{{$hora}}">{{$hora}}</option>
                            @endforeach
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
                        var profesionalSelect = document.getElementById('rut_profesional_atenciones');
                        var fechaSelect = document.getElementById('fecha_atencion');
                        var horasSelect = document.getElementById('hora_inicio');

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

                        fechaSelect.addEventListener('change', function() {
                            var profesionalId = profesionalSelect.value;
                            var fechaSeleccionada = this.value;

                            if (profesionalId && fechaSeleccionada) {
                                // Realiza el fetch para obtener las horas disponibles
                                fetch('/obtener-horas-disponibles/' + profesionalId + '/' + fechaSeleccionada)
                                    .then(response => response.json())
                                    .then(data => {
                                        console.log(data); // Imprime la respuesta en la consola
                                        horasSelect.innerHTML = "<option value=''>-- Seleccionar Hora --</option>";
                                        data.forEach(hora => {
                                            horasSelect.innerHTML += "<option value='" + hora + "'>" + hora + "</option>";
                                        });
                                    })
                                    .catch(error => console.error('Error:', error));
                            }
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
                

            </tr>
            @endforeach


        </table>
    </div>





   
    @endsection
