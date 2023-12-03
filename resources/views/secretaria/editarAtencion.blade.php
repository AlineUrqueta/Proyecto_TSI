@extends('layouts.master')
@section('title','Editar Atención')
@section('contenido')
<div class="row mt-5 ">

    <div class="col-md-5 col-sm-12 mx-auto ">
        <div class="card" style="width: 45rem; height: auto;">
            <div class="card-header text-center">
                <h4>Editar Atención</h4>
            </div>
            <div class="card-body">

                
                <form action="{{route('secretaria.updateHora',$atencion->id_atencion)}}" class='mt-4' method='POST'>
                    @csrf
                    @method('put')
                    <div class='m-3'>
                        <input type="text" placeholder='Nombre del paciente' id='paciente' name='paciente' class="form-control" value="{{$atencion->paciente->nom_paciente}} {{$atencion->paciente->apep_paciente}} {{$atencion->paciente->apem_paciente}}" disabled>
                    </div>

                    <div class='m-3'>
                        <select class="custom-select custom-select-lg mb-3 form-control" id='id_especialidad' name='id_especialidad'>
                            <option value="">{{$atencion->profesional->especialidad->nom_especialidad}}</option>
                            @foreach ( $especialidades as $especialidad )

                            <option value="{{$especialidad->id_especialidad}}">{{$especialidad->nom_especialidad}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class='m-3'>
                        <select class="custom-select custom-select-lg mb-3 form-control" id='rut_profesional_atenciones' name='rut_profesional_atenciones'>
                            <option value="">{{$atencion->profesional->nom_profesional}} {{$atencion->profesional->apep_profesional}} {{$atencion->profesional->apem_profesional}}</option>
                            @foreach ( $profesionales as $profesional )

                            <option value="{{$profesional->rut_profesional}}">{{$profesional->nom_profesional}} {{$profesional->apep_profesional}} {{$profesional->apem_profesional}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="m-3">
                        <input type="date" class="form-control" id="fecha_atencion" name="fecha_atencion" value="{{$atencion->fecha_atencion}}" min=" {{ now()->format('Y-m-d') }}" max="2024-01-01">
                    </div>

                    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

                    <div class="m-3">
                        @php
                            $horas = array("9:00", "9:45", "10:30", "11:15", "12:00", "12:45", "13:30", "14:15", "15:00", "15:45", "16:30", "17:15", "18:00", "18:45", "19:30", "20:15");
                        @endphp
                        <select class="form-control" name="hora_inicio" id="hora_inicio" onchange="actualizarHoraFin()">
                            <option value="">{{$atencion->hora_inicio}}</option>
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



                    <!-- Button trigger modal -->
                    <div class='me-3 mt-4 text-end'>
                        <a href="{{route('secretaria.listadoCitas')}}" class = "btn btn-primary">Volver a Listado</a>
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

</div>



@endsection
