@extends('layouts.master')
@section('title','Inicio Secretaria - Centro Médico Epojé')
@section('contenido')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet" />
<script src=" https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js "></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

<div class="container m-5">
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

</script>

@endsection
