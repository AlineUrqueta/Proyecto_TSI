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
        <div class="card" style="width: 45rem; height: auto;">
            <div class="card-header text-center">
                <h4>Agendar hora médica</h4>
            </div>
            <div class="card-body">


                <form action="" class='mt-4'>
                    {{-- @csrf --}}


                    <div class='m-3'>
                        <select class="custom-select custom-select-lg mb-3 form-control" id='' name=''>
                            <option value="">-- Seleccionar Paciente --</option>
                            <option value="0">Paciente 1</option>
                            <option value="1">Paciente 2</option>
                            <option value="2">Paciente 3</option>
                            <option value="3">Paciente 4</option>
                        </select>
                    </div>
                    

                    <div class='m-3'>
                        <select class="custom-select custom-select-lg mb-3 form-control" id='' name=''>
                            <option value="">-- Seleccionar Especialidad --</option>
                            <option value="0">Fonoaudiología</option>
                            <option value="1">Psicología</option>
                            <option value="2">Terapia Ocupacional</option>
                            <option value="3">Psiquiatría</option>
                        </select>
                    </div>

                    <div class='m-3'>
                        <select class="custom-select custom-select-lg mb-3 form-control" id='' name=''>
                            <option value="">-- Seleccionar Profesional --</option>
                            <option value="0">Profesional 1</option>
                            <option value="1">Profesional 2</option>
                            <option value="2">Profesional 3</option>
                            <option value="3">Profesional 4</option>
                        </select>
                    </div>

                    <div class='m-3'>
                        <select class="custom-select custom-select-lg mb-3 form-control" id='' name=''>
                            <option value="">-- Seleccionar Semana --</option>
                            <option value="0">02/10/2023 - 08/10/2023</option>
                            <option value="1">09/10/2023 - 15/10/2023</option>
                            <option value="2">16/10/2023 - 22/10/2023</option>
                            <option value="3">23/10/2023 - 29/10/2023</option>
                        </select>
                    </div>





                    <div class='me-3 mt-4 text-end'>
                        <a href="{{route('secretaria.index')}}" class="btn btn-outline-dark me-2 ">Menu Principal</a>
                        
                        <button type='submit' class='btn btn-success '>Buscar Hora</button>
                    </div>



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
                    @endif

                </div>
            </div>

        </div>

    </div>
    <div class="col-sm-12 col-md-6">
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






    @endsection
