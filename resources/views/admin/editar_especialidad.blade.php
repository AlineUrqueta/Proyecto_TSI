@extends('layouts.master')
@section('title','Editar de especialidades')
@section('contenido')

<div class="row h-100 justify-content-center align-items-center mt-5">
    <div class="col-md-4">
        <div class="card" style="width: auto; height: auto;">
            <div class="card-header text-center">
                <h4>Editar de Especialidad {{$especialidad->nom_especialidad}}</h4>
            </div>
            <div class="card-body">


                <form action="{{route('especialidad.update',$especialidad->id_especialidad)}}" class='mt-4' method="POST">
                    @csrf
                    @method('put')
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
                        <a href="{{route('especialidad.index')}}" class="btn btn-outline-dark me-2">Menu Principal</a>
                        <button type='submit' class='btn btn-success '>Editar </button>
                    </div>



                </form>
            </div>







        </div>
    </div>

</div>
@endsection
