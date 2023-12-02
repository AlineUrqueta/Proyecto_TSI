@extends('layouts.master')
@section('title','Editar Hora Medica')
@section('contenido')
<div class="row mt-5 ">

    <div class="col-md-5 col-sm-12 mx-auto ">
        <div class="card" style="width: 45rem; height: auto;">
            <div class="card-header text-center">
                <h4>Editar Hora Médica</h4>
            </div>
            <div class="card-body">

                <form action="{{route('secretaria.updateHora',$atencion->id_atencion)}}" class='mt-4' method="POST">
                    @csrf
                    @method('put')


                    <div class='m-3'>
                        <input type="text" class="form-control" value="{{$atencion->paciente->nom_paciente}} {{$atencion->paciente->apep_paciente}}" id="{{$atencion->paciente->rut_paciente}}" name="{{$atencion->paciente->rut_paciente}}" disabled>

                    </div>


                    <div class='m-3'>
                        <select class="custom-select custom-select-lg mb-3 form-control" id='id_especialidad' name='id_especialidad'>
                            @foreach ( $especialidades as $especialidad )
                            
                            <option value="{{ $especialidad->id_especialidad }}" {{ $atencion->profesional->id_especialidad == $especialidad->id_especialidad ? 'selected' : '' }}>
                                {{ $especialidad->nom_especialidad }}
                            </option>
                            

                            @endforeach
                            {{dd($atencion->profesional->id_especialidad == $especialidad->id_especialidad ? 'selected' : '' )}}
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
                            <option value="">-- Seleccionar Hora de Inicio --</option>
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
                        <a href="{{route('secretaria.index')}}" class="btn btn-outline-dark  ms-1">Menu Principal</a>

                        <button type='submit' class='btn btn-success me-3 '>Editar Hora</button>
                    </div>





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
