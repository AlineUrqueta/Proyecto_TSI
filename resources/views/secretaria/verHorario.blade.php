@extends('layouts.master')
@section('title','Ver Horario')
@section('contenido')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet" />
<script src=" https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js "></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

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

<div class="container m-5">
    <div class="row text-center">
        <div class="col-9 mx-auto">
            <div class="card">
                <div class="card-header text-center">
                    <h4><a href="{{route('secretaria.showHorarios')}}" ><span class="material-symbols-outlined">arrow_back</span></a>Albert Wily</h4>
                </div>
                <div class="card-body">
                    <div class="col-12">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="container m-5">
    <div class="row text-center">
        <div class="col-9 mx-auto">
            <div class="card">
                <div class="card-header text-center">
                    <h4><a href="{{route('secretaria.showHorarios')}}" ><span class="material-symbols-outlined">arrow_back</span></a>Albert Wily</h4>
                </div>
                <div class="card-body">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {

            initialView: 'timeGridWeek'
            , slotMinTime: '09:00'
            , slotMaxTime: '22:00'
            , hiddenDays: [0]
            , events: [{
                    title: ''
                    , start: '2023-10-02 09:45'
                    , end: '2023-10-02 13:30'
                }
                , {
                    title: ''
                    , start: '2023-10-04 10:30'
                    , end: '2023-10-04 15:00'
                }
                , {
                    title: ''
                    , start: '2023-10-05 10:30'
                    , end: '2023-10-05 16:30'
                }
            ]
        });
        calendar.render();
    });

</script> --}}

@endsection
