@extends('layouts.master')
@section('title','Mantenedor de especialidades')
@section('contenido')
<div class="row mt-5">
    <div class="col-sm-12 col-md-8  order-md-first order-sm-last">
        <form action="{{route('especialidad.search')}}">
            @csrf
            <div class="row mb-4">
                <div class="col-6">
                    <input type="text" name="buscar" placeholder="Buscar especialidad" class="form-control">
                </div>
                <div class="col-4">
                    <button type="submit" class='btn btn-success '>Buscar</button>
                </div>
            </div>
        </form>

        @if (count($especialidades) === 0)
        <div class="alert alert-danger">No hay especialidades registradas</div>
        @else
        <table class="table table-bordered border-success"  style="width:40rem;height:auto">
            <thead >
                <tr>
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col" class="text-center">ESPECIALIDAD</th>
                    <th scope="col" class="text-center ">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($especialidades as $especialidad )
                <tr>

                    <th>{{$especialidad->id_especialidad}}</th>
                    <td>{{$especialidad->nom_especialidad}}</td>

                    <td class ="text-center">
                        <!-- Button trigger modal -->
                        <div class="text-center">
                            @if ($especialidad->profesionales->count() === 0)
                            <button type="button" class="btn btn-danger me-3" data-toggle="modal" data-target="#exampleModalCenter{{$especialidad->id_especialidad}}">
                                <span class="material-symbols-outlined">
                                    delete
                                </span>
                            </button>
                            @endif
                            <a class='btn btn-warning text-white ' href="{{route('especialidad.edit',$especialidad->id_especialidad)}}"><span class="material-symbols-outlined">
                                    manufacturing
                                </span>
                            </a>

                        </div>




                        <!-- Modal Eliminar -->
                        <div class="modal fade" id="exampleModalCenter{{$especialidad->id_especialidad}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Especialidad</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Desea eliminar {{$especialidad->nom_especialidad}}?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <form action="{{route('especialidad.update',$especialidad->id_especialidad)}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class='btn btn-danger'>Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>





                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        @endif

    </div>

    <div class="col-md-4  mb-sm-5 order-md-last order-sm-first">
        <div class="card" style="width: auto; height: auto;">
            <div class="card-header text-center">
                <h4>Registro de Especialidad</h4>
            </div>
            <div class="card-body">


                <form action="{{route('especialidad.store')}}" class='mt-4' method="POST">
                    @csrf

                    <div class='m-3'>
                        <input type="text" placeholder='Nombre especialidad' id='nom_especialidad' name='nom_especialidad' class="form-control">
                    </div>
                    <div class='m-3'>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                    </div>


                    <div class='me-3 mt-4 text-end'>
                        <a href="{{route('admin.index')}}" class="btn btn-outline-dark me-2">Menu Principal</a>
                        <button type='submit' class='btn btn-success '>Crear especialidad</button>
                    </div>



                </form>
            </div>







        </div>
    </div>

</div>



@endsection
