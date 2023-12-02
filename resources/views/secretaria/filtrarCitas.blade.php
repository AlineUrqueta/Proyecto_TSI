@extends('layouts.master')
@section('title','Citas Medicas - Centro Médico Epojé')
@section('contenido')

<div class="row mt-4">
    <div class="row">
        
        <div class="col-5">
            <select id="profesionalSelector" class="form-select">
                <option value="">Todos los profesionales</option>
                @foreach($profesionales as $profesional)
                    <option value="{{$profesional->rut_profesional}}">{{$profesional->nom_profesional}} {{$profesional->apep_profesional}} {{$profesional->apem_profesional}} </option>
                @endforeach
            </select>
        </div>
        <div class="col-3">
            <input type="date" id="fechaSelector" class="form-control">
        </div>
        <div class="col-4 text-end">
            <a href="{{route('secretaria.filtrar')}}" class="btn btn-outline-dark">Limpiar</a>
            <a href="{{route('secretaria.index')}}" class="btn btn-outline-dark ms-3">Menu Principal</a>
            
        </div>
    </div>

    <div class="col-12 mt-4">
        <div class="col-12" >
            <h4>Agendadas</h4>
            
            <table class="table table-bordered border-success" id="atencionesTable">
                <tr>
                    <th>Paciente</th>
                    <th>Profesional | Especialidad</th>
                    <th>Fecha | Hora </th>
                    <th>Secretaria</th>
                    <th>Acciones</th>
                </tr>
                @foreach ($atenciones as $atencion)
                <tr>
                    <td>{{$atencion->paciente->nom_paciente}} {{$atencion->paciente->apep_paciente}} {{$atencion->paciente->apem_paciente}}</td>
                    <td>{{$atencion->profesional->nom_profesional}} {{$atencion->profesional->apep_profesional}} | {{$atencion->profesional->especialidad->nom_especialidad}}</td>
                    <td>{{$atencion->fecha_atencion}} | {{$atencion->hora_inicio}} </td>
                    <td>{{$atencion->usuario->nom_usuario}} {{$atencion->usuario->apep_usuario}}</td>

                    <td>
                        <div class="btn-group" role="group" aria-label="Ejemplo de Button Group">
                            <button class="btn btn-warning text-white d-inline-block"><span class="material-symbols-outlined">
                                    manufacturing
                                </span></button>
                            <form method="POST" action="{{ route('secretaria.atendida', ['atencionId' => $atencion->id_atencion]) }}">
                                @csrf
                                @method('POST')
                                <button class="btn btn-success text-white d-inline-block" type="submit"><span class="material-symbols-outlined">
                                        check
                                    </span></button>
                            </form>
                            <form method="POST" action="{{ route('secretaria.cancelada', ['atencionId' => $atencion->id_atencion]) }}">
                                @csrf
                                @method('POST')
                                <button class="btn btn-danger text-white d-inline-block" type="submit"><span class="material-symbols-outlined">
                                        block
                                    </span></button>
                            </form>

                        </div>
                    </td>

                </tr>
                @endforeach


            </table>

        </div>
    </div>
</div>

<script>
    var atenciones = {!! json_encode($atenciones) !!};
    var profesionales = {!! json_encode($profesionales) !!};

    // Filtra la tabla según las selecciones
    function filtrarTabla() {
        var profesionalId = document.getElementById("profesionalSelector").value;
        var fecha = document.getElementById("fechaSelector").value;

        var atencionesFiltradas = atenciones;

        if (profesionalId !== "") {
            atencionesFiltradas = atencionesFiltradas.filter(atencion => atencion.profesional.rut_profesional == profesionalId);
        }


        if (fecha !== "") {
            atencionesFiltradas = atencionesFiltradas.filter(atencion => atencion.fecha_atencion === fecha);
        }

        actualizarTabla(atencionesFiltradas);
    }

    function actualizarTabla(atenciones) {
    var tableBody = document.getElementById("atencionesTable").getElementsByTagName('tbody')[0];
    tableBody.innerHTML = "";

    atenciones.forEach(atencion => {
        var row = tableBody.insertRow(-1);

        var cellPaciente = row.insertCell(0);
        cellPaciente.innerHTML = atencion.paciente.nom_paciente + " " + atencion.paciente.apep_paciente + " " + atencion.paciente.apem_paciente;


        var cellProfesional = row.insertCell(1);
        cellProfesional.innerHTML = atencion.profesional.nom_profesional + " " + atencion.profesional.apep_profesional + " | " + atencion.profesional.especialidad.nom_especialidad;

        // Columna Fecha | Hora
        var cellFechaHora = row.insertCell(2);
        cellFechaHora.innerHTML = atencion.fecha_atencion + " | " + atencion.hora_inicio;


        var cellSecretaria = row.insertCell(3);
        cellSecretaria.innerHTML = atencion.usuario.nom_usuario + " " + atencion.usuario.apep_usuario;

    });
}


    function llenarProfesionales() {
    var profesionalSelector = document.getElementById("profesionalSelector");

    var profesionalesUnicos = new Set(profesionales);

    profesionalSelector.innerHTML = '<option value="">Todos los profesionales</option>';

    profesionalesUnicos.forEach(profesional => {
        var option = document.createElement("option");
        option.value = profesional.rut_profesional;
        option.text = `${profesional.nom_profesional} ${profesional.apep_profesional} ${profesional.apem_profesional}`;
        profesionalSelector.add(option);
    });
}

    llenarProfesionales();


    document.getElementById("profesionalSelector").addEventListener("change", filtrarTabla);
    document.getElementById("fechaSelector").addEventListener("change", filtrarTabla);

    filtrarTabla();

</script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

@endsection

