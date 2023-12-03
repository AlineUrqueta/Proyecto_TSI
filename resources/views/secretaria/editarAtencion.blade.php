@extends('layouts.master')
@section('title','Editar Atención')
@section('contenido')
<div class="row h-100 justify-content-center align-items-center mt-4 ">

    <div class="col-md-5 col-sm-12">
        <div class="card" style="width: auto; height: auto;">
            <div class="card-header text-center">
                <h4>Editar Atención</h4>
            </div>
            <div class="card-body">


                <form action="{{route('secretaria.updateHora',$atencion->id_atencion)}}" method='POST'>
                    @csrf
                    @method('put')
                    <div class='m-3'>
                        <small>Rut Paciente</small>
                        <input type="text" placeholder='Nombre paciente' id='rut_paciente_atenciones' name='rut_paciente_atenciones' class="form-control mb-3" value="{{$atencion->paciente->rut_paciente}}" readonly>
                        <small class="mt-3">Nombre Paciente</small>
                        <input type="text" placeholder='' class="form-control" value="{{$atencion->paciente->nom_paciente}} {{$atencion->paciente->apep_paciente}} {{$atencion->paciente->apem_paciente}}" readonly>
                    </div>

                    <div class='m-3'>
                        <small>Especialidad</small>
                        <select class="custom-select custom-select-lg mb-3 form-control" id='id_especialidad' name='id_especialidad'>
                            @foreach ($especialidades as $especialidad)
                            <option value="{{$especialidad->id_especialidad}}" {{ $atencion->profesional->especialidad->nom_especialidad == $especialidad->nom_especialidad ? 'selected' : '' }}>
                                {{$especialidad->nom_especialidad}}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class='m-3'>
                        <small>Profesional</small>
                        <select class="custom-select custom-select-lg mb-3 form-control" id='rut_profesional_atenciones' name='rut_profesional_atenciones'>
                            @foreach ($profesionales as $profesional)
                            <option value="{{$profesional->rut_profesional}}" {{ $atencion->profesional->rut_profesional == $profesional->rut_profesional ? 'selected' : '' }}>
                                {{$profesional->nom_profesional}} {{$profesional->apep_profesional}} {{$profesional->apem_profesional}}
                            </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="m-3">
                        <small>Fecha Atención</small>
                        <input type="date" class="form-control" id="fecha_atencion" name="fecha_atencion" value="{{$atencion->fecha_atencion}}" min=" {{ now()->format('Y-m-d') }}" max="2024-01-01">
                    </div>

                    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

                    <div class="m-3">
                        <small>Hora Inicio</small>
                        <select class="form-control" name="hora_inicio" id="hora_inicio" onchange="actualizarHoraFin()">
                            @foreach ($horas as $hora)
                            <option value="{{$hora}}" {{ $atencion->hora_inicio == $hora ? 'selected' : '' }}>
                                {{$hora}}
                            </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="m-3">
                        <small>Hora Termino</small>
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



                    <!-- Button trigger modal -->
                    <div class='me-3 mt-4 text-end'>
                        <a href="{{route('secretaria.listadoCitas')}}" class="btn btn-primary">Volver a Listado</a>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
                            Editar</button>
                    </div>


                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Editar Atención</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    ¿Desea editar la hora de {{$atencion->paciente->nom_paciente}} {{$atencion->paciente->apep_paciente}}?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                                    <button class='btn btn-success' type="submit">Editar</button>

                                </div>
                            </div>
                        </div>
                    </div>

                </form>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var especialidadSelect = document.getElementById('id_especialidad');
                        var profesionalSelect = document.getElementById('rut_profesional_atenciones');
                        var pacienteSelect = document.getElementById('rut_paciente_atenciones');
                        var fechaSelect = document.getElementById('fecha_atencion');
                        var horasSelect = document.getElementById('hora_inicio');

                        // Obtener valores iniciales
                        var especialidadId = especialidadSelect.value;
                        var profesionalId = profesionalSelect.value;
                        var fechaSeleccionada = fechaSelect.value;
                        var pacienteSeleccionado = pacienteSelect.value;

                        // Evento de cambio de especialidad
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

                        // Evento de cambio de profesional
                        profesionalSelect.addEventListener('change', function() {
                            var profesionalId = this.value;
                            fetch('/obtener-especialidad/' + profesionalId)
                                .then(response => response.json())
                                .then(data => {
                                    especialidadSelect.innerHTML = "<option value='" + data.id_especialidad + "'>" + data.nom_especialidad + "</option>";
                                })
                                .catch(error => console.error('Error:', error));
                        });

                        // Evento de cambio de fecha
                        
                        fechaSelect.addEventListener('change', function() {
                            
                            var profesionalId = profesionalSelect.value;
                            var fechaSeleccionada = this.value;

                            if (profesionalId && fechaSeleccionada && pacienteSeleccionado) {
                                // Realiza el fetch para obtener las horas disponibles
                                fetch('/obtener-horas-disponibles/' + profesionalId + '/' + fechaSeleccionada + '/' + pacienteSeleccionado)
                                    .then(response => response.json())
                                    .then(data => {
                                        console.log(data); // Imprime la respuesta en la consola
                                        horasSelect.innerHTML = "<option value='" + horasSelect.value + "'>"+ horasSelect.value +"</option>";
                                        data.forEach(hora => {
                                            horasSelect.innerHTML += "<option value='" + hora + "'>" + hora + "</option>";
                                        });
                                    })
                                    .catch(error => console.error('Error:', error));
                            }
                        });

                        // Al cargar la página, ejecutar el evento de cambio de fecha para obtener las horas disponibles iniciales
                        fechaSelect.dispatchEvent(new Event('change'));
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
