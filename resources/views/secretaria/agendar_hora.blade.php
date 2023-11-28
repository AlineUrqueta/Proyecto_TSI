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
    <div class="col-sm-12 col-md-6">
        <div class="card" style="width: auto; height: auto;">
            <div class="card-header text-center">
                <h4>Agendar hora médica</h4>
            </div>
            <div class="card-body">


                <form action="" class='mt-4'>
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

                    

                    {{-- <div class='m-3'>
                        <select class="custom-select custom-select-lg mb-3 form-control" id='' name=''>
                            <option value="">-- Seleccionar Semana --</option>
                            <option value="0">02/10/2023 - 08/10/2023</option>
                            <option value="1">09/10/2023 - 15/10/2023</option>
                            <option value="2">16/10/2023 - 22/10/2023</option>
                            <option value="3">23/10/2023 - 29/10/2023</option>
                        </select>
                    </div> --}}
                    <div class = "m-3">
                        <input type="date" class= "form-control" value="{{ now()->format('Y-m-d') }}"" min="{{ now()->format('Y-m-d') }}" max="2024-01-01">
                        
                    </div>


                    <div class='me-3 mt-4 text-end'>
                        <a href="{{route('secretaria.index')}}" class="btn btn-outline-dark me-2 ">Menu Principal</a>
                        <a href="{{route('secretaria.agendar')}}" class="btn btn-warning me-2 text-white">Limpiar</a>

                        <button type='submit' class='btn btn-success '>Buscar Hora</button>
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

    {{-- <div class="col-sm-12 col-md-6">
    <table class="table">
        <tr>
            <th>Lunes</th>
            <th>Martes</th>
            <th>Miércoles</th>
            <th>Jueves</th>
            <th>Viernes</th>
        </tr>
        @for ($i = 0; $i < 16; $i++)
            <tr>
                @for ($j = 0; $j < 5; $j++)
                    @php
                        $horaInicio = strtotime("09:00") + ($i * 45 * 60);
                        $horaFin = $horaInicio + (45 * 60);
                        $esEvento = $j == 3 && $i == 1 || $j == 1 && $i == 3 || $j == 0 && $i == 4;
                    @endphp
                    <td>
                        @if ($esEvento)
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                {{ date('H:i', $horaInicio) }} - {{ date('H:i', $horaFin) }}
                            </button>
                        @else
                            {{ date('H:i', $horaInicio) }} - {{ date('H:i', $horaFin) }}
                        @endif
                    </td>
                @endfor
            </tr>
        @endfor
    </table>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">Agendar Hora</h5>
                </div>
                <div class="modal-body">
                    <h5>Nombre del Paciente: Paciente 1</h5>
                    <h5>Especialidad: Psicología</h5>
                    <h5>Fecha: 08/10/2023</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Agendar Hora</button>
                </div>
            </div>
        </div>
    </div>

</div> --}}


    {{-- <div class="col-sm-12 col-md-6">
        <table>
            <tr>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miércoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
            </tr>
            <tr>
                <td>10:00 - 10:45</td>
                <td>10:00 - 10:45</td>
                <td>10:00 - 10:45</td>
                <td>10:00 - 10:45</td>
                <td>10:00 - 10:45</td>
            </tr>
            <tr>
                <td>10:45 - 11:30</td>
                <td>10:45 - 11:30</td>
                <td>10:45 - 11:30</td>
                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                        10:45 - 11:30
                    </button></td>
                <td>10:45 - 11:30</td>
            </tr>
            <tr>
                <td>11:30 - 12:15</td>
                <td>11:30 - 12:15</td>
                <td>11:30 - 12:15</td>
                <td>11:30 - 12:15</td>
                <td>11:30 - 12:15</td>
            </tr>
            <tr>
                <td>12:15 - 13:00</td>
                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                        12:15 - 13:00
                    </button></td>
                <td>12:15 - 13:00</td>
                <td>12:15 - 13:00</td>
                <td>12:15 - 13:00</td>
            </tr>
            <tr>
                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                        13:00 - 13:45
                    </button>
                </td>
                <td>13:00 - 13:45</td>
                <td>13:00 - 13:45</td>
                <td>13:00 - 13:45</td>
                <td>13:00 - 13:45</td>
            </tr>
            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="exampleModalLongTitle">Agendar Hora</h5>

                        </div>
                        <div class="modal-body">
                            <h5>Nombre del Paciente: Paciente 1</h5>
                            <h5>Especialidad: Psicología</h5>
                            <h5>Fecha: 08/10/2023</h5>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary">Agendar Hora</button>
                        </div>
                    </div>
                </div>
            </div>
        </table>
    </div> --}}






    @endsection
