@extends('layouts.master')
@section('title','Mantenedor de horarios')
@section('contenido')

<div class="container-fluid mt-4 d-flex justify-content-center">
    <div class="row">
        <div class="col-12">
            <div class="card" style="width: 45rem; height: auto;">
                <div class="card-header text-center">
                    <h4>Editar Horario Albert Wily</h4>
                </div>
                <div class="card-body">


                    <form action="" class='mt-4'>

                        <div class='m-3'>
                            <input type="text" placeholder='10456789-k' class="form-control">
                        </div>

                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-4 d-flex  align-items-center">
                                @php
                                    $lunesCheck = 0;
                                @endphp
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" @checked($lunesCheck = 1) role="switch" id="lunes" checked>
                                    <label class="form-check-label" for="lunes">Lunes</label>
                                </div>

                            </div>

                            <div class="col-6">
                                <div class="row m-2">
                                    <select class="form-select" aria-label="hora_inicio_lunes" @if ($lunesCheck == 0) disabled @endif>
                                        <option selected>Hora de inicio</option>
                                        <option value="1">9:00</option>
                                        <option value="2">9:45</option>
                                        <option value="3">10:30</option>
                                        <option value="4">11:15</option>
                                        <option value="5">12:00</option>
                                        <option value="6">12:45</option>
                                        <option value="7">13:30</option>
                                        <option value="8">14:15</option>
                                        <option value="9">15:00</option>
                                        <option value="10">15:45</option>
                                        <option value="11">16:30</option>
                                        <option value="12">17:15</option>
                                        <option value="13">18:00</option>
                                        <option value="14">18:45</option>
                                        <option value="15">19:30</option>
                                        <option value="16">20:15</option>
                                    </select>
                                </div>
                                <div class="row m-2">
                                    <select class="form-select" aria-label="hora_fin_lunes" @if ($lunesCheck == 0) disabled @endif>
                                        <option selected>Hora de termino</option>
                                        <option value="1">9:45</option>
                                        <option value="2">10:30</option>
                                        <option value="3">11:15</option>
                                        <option value="4">12:00</option>
                                        <option value="5">12:45</option>
                                        <option value="6">13:30</option>
                                        <option value="7">14:15</option>
                                        <option value="8">15:00</option>
                                        <option value="9">15:45</option>
                                        <option value="10">16:30</option>
                                        <option value="11">17:15</option>
                                        <option value="12">18:00</option>
                                        <option value="13">18:45</option>
                                        <option value="14">19:30</option>
                                        <option value="15">20:15</option>
                                        <option value="16">21:00</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-4 d-flex  align-items-center">
                                @php
                                    $martesCheck = 0;
                                @endphp
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" @checked($martesCheck = 1) role="switch" id="martes">
                                    <label class="form-check-label" for="martes">Martes</label>
                                </div>

                            </div>

                            <div class="col-6">
                                <div class="row m-2">
                                    <select class="form-select" aria-label="hora_inicio_martes" @if ($martesCheck == 0) disabled @endif>
                                        <option selected>Hora de inicio</option>
                                    </select>
                                </div>
                                <div class="row m-2">
                                    <select class="form-select" aria-label="hora_fin_martes" @if ($martesCheck == 0) disabled @endif>
                                        <option selected>Hora de termino</option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-4 d-flex  align-items-center">
                                @php
                                    $miercolesCheck = 0;
                                @endphp
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" @checked($miercolesCheck = 1) role="switch" id="miercoles" checked>
                                    <label class="form-check-label" for="miercoles">Miercoles</label>
                                </div>

                            </div>

                            <div class="col-6">
                                <div class="row m-2">
                                    <select class="form-select" aria-label="hora_inicio_miercoles" @if ($miercolesCheck == 0) disabled @endif>
                                        <option selected>Hora de inicio</option>
                                    </select>
                                </div>
                                <div class="row m-2">
                                    <select class="form-select" aria-label="hora_fin_miercoles" @if ($miercolesCheck == 0) disabled @endif>
                                        <option selected>Hora de termino</option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-4 d-flex  align-items-center">
                                @php
                                    $juevesCheck = 0;
                                @endphp
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" @checked($juevesCheck = 1) role="switch" id="jueves" checked>
                                    <label class="form-check-label" for="jueves">Jueves</label>
                                </div>

                            </div>

                            <div class="col-6">
                                <div class="row m-2">
                                    <select class="form-select" aria-label="hora_inicio_jueves" @if ($juevesCheck == 0) disabled @endif>
                                        <option selected>Hora de inicio</option>
                                    </select>
                                </div>
                                <div class="row m-2">
                                    <select class="form-select" aria-label="hora_fin_jueves" @if ($juevesCheck == 0) disabled @endif>
                                        <option selected>Hora de termino</option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-4 d-flex  align-items-center">
                                @php
                                    $viernesCheck = 0;
                                @endphp
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" @checked($viernesCheck = 1) role="switch" id="viernes">
                                    <label class="form-check-label" for="viernes">Viernes</label>
                                </div>

                            </div>

                            <div class="col-6">
                                <div class="row m-2">
                                    <select class="form-select" aria-label="hora_inicio_viernes" @if ($viernesCheck == 0) disabled @endif>
                                        <option selected>Hora de inicio</option>
                                    </select>
                                </div>
                                <div class="row m-2">
                                    <select class="form-select" aria-label="hora_fin_viernes" @if ($viernesCheck == 0) disabled @endif>
                                        <option selected>Hora de termino</option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-4 d-flex  align-items-center">
                                @php
                                    $sabadoCheck = 0;
                                @endphp
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" @checked($sabadoCheck = 1) role="switch" id="sabado">
                                    <label class="form-check-label" for="sabado">Sábado</label>
                                </div>

                            </div>

                            <div class="col-6">
                                <div class="row m-2">
                                    <select class="form-select" aria-label="hora_inicio_sabado" @if ($sabadoCheck == 0) disabled @endif>
                                        <option selected>Hora de inicio</option>
                                    </select>
                                </div>
                                <div class="row m-2">
                                    <select class="form-select" aria-label="hora_fin_sabado" @if ($sabadoCheck == 0) disabled @endif>
                                        <option selected>Hora de termino</option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        
        
                        <div class='me-3 mt-4 text-end'>
                            <a href="{{route('secretaria.index')}}" class="btn btn-outline-dark">Menu Principal</a>
                            <button type='submit' class='btn btn-success '>Confirmar Cambios</button>
                        </div>



                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection