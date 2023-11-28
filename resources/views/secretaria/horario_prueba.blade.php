@extends('layouts.master')
@section('title','Mantenedor de horarios')
@section('contenido')
<div class="row mt-5">
    <div class="col-4">
        <select name="rut_profesional" id="rut_profesional" class="form-control">
            @foreach ($profesionales as $profesional )
            <option value="{{$profesional->rut_profesional}}">{{$profesional->nom_profesional}} {{$profesional->apep_profesional}} {{$profesional->apem_profesional}}</option>
            @endforeach

        </select>
        <button type="submit" class="btn btn-primary">Buscar Horario</button>

    </div>

    <div class="col-8">
        <div class="card" style="width: auto; height: auto;">
            <div class="card-header text-center">
                <h4>Horario Profesional</h4>
            </div>
            <div class="card-body">
                <table class = "table">
                    <tr>
                        <th>Lunes</th>
                        <th>Martes</th>
                        <th>Miércoles</th>
                        <th>Jueves</th>
                        <th>Viernes</th>
                    </tr>
                    <tr>
                    <td>
                        <form action="{{route('horario.store')}}" method='POST'>
                            <select class="custom-select custom-select-lg mb-3 form-control" id='dia' name='dia'>
                                <option value=""> --- Seleccionar Dia ---</option>

                                <option value="1">Lunes</option>
                                <option value="2">Martes</option>
                                <option value="3">Miércoles</option>
                                <option value="4">Jueves</option>
                                <option value="5">Viernes</option>
                                <option value="6">Sabado</option>

                            </select>
                            <button type="submit"class="btn btn-primary">9:00 - 9:45</button>
                        </form>
                    </td>
                        
                        
                        <td>9:00 - 9:45</td>
                        <td>9:00 - 9:45</td>
                        <td>9:00 - 9:45</td>
                        <td>9:00 - 9:45</td>
                    </tr>
                    <tr>
                        <td>10:00 - 10:45</td>
                        <td>10:00 - 10:45</td>
                        <td>10:00 - 10:45</td>
                        <td>10:00 - 10:45</td>
                        <td>10:00 - 10:45</td>
                        
                    </tr>
                    <tr>
                        <td>11:00 - 11:45</td>
                        <td>11:00 - 11:45</td>
                        <td>11:00 - 11:45</td>
                        <td>11:00 - 11:45</td>
                        <td>11:00 - 11:45</td>
                        
                    </tr>
                    <tr>
                        <td>12:00 - 12:45</td>
                        <td>12:00 - 12:45</td>
                        <td>12:00 - 12:45</td>
                        <td>12:00 - 12:45</td>
                        <td>12:00 - 12:45</td>

                    </tr>
                    



                </table>

            </div>

        </div>
    </div>

</div>



@endsection
