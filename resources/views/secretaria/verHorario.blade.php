@extends('layouts.master')
@section('title','Inicio Secretaria - Centro Médico Epojé')
@section('contenido')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet" />
<script src=" https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js "></script>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card" style="background-color: #88bd9e;">
                <div class="card-header text-center">
                    <h4>Albert Wily</h4>
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

        initialView: 'timeGridWeek',
        slotMinTime: '09:00',
        slotMaxTime: '22:00',
        hiddenDays: [0],
        events:[
            {
             title: '',
             start: '2023-10-02 09:45',
             end: '2023-10-02 13:30'
            },
            {
             title: '',
             start: '2023-10-04 10:30',
             end: '2023-10-04 15:00'
            },
            {
             title: '',
             start: '2023-10-05 10:30',
             end: '2023-10-05 16:30'
            }
            ]
      });
      calendar.render();
    });

</script>

@endsection