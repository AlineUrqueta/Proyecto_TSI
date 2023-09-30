@extends('layouts.master')
@section('title','Registro')
@section('contenido')
    <div class="row  mt-5">
    <div class="col-sm-12 col-md-5 order-md-first order-sm-last">
        <img src="{{asset('images/logo.jpeg')}}" alt="Logo Centro"  class="img-fluid">
    </div>
    <div class="col-sm-12 col-md-7  mb-sm-5  order-md-last order-sm-first">
        <div class="d-flex justify-content-center align-items-center">
            <div class="card" style="width: 45rem; height: auto;">
                <div class="card-header text-center">
                    <h4>Registro de Usuarios</h4>
                </div>
                <div class="card-body">
                
                        
                    <form action="" class = 'mt-4' method = 'POST' >
                    @csrf
                    <div class =  'm-3'>
                        <input type="text" placeholder = 'Nombre' id = 'nom_usuario' name ='nom_usuario' class="form-control">
                    </div>

                    <div class =  'm-3'>
                        <input type="text" placeholder = 'Apellido Paterno' id = 'apep_usuario' name ='apep_usuario' class="form-control">
                    </div>

                    <div class =  'm-3'>
                        <input type="text" placeholder = 'Apellido Materno' id = 'apem_usuario' name ='apem_usuario' class="form-control">
                    </div>

                    <div class =  'm-3'>
                        <input type="text" placeholder = 'Celular' id = 'fono' name ='fono' class="form-control">
                    </div>

                    <div class =  'm-3'>
                        <input type="email" placeholder = 'Email' id = 'email' name ='email' class="form-control">
                    </div>

                    <div class =  'm-3'>
                        <input type="password" placeholder = 'Contraseña' id = 'password' name ='password' class="form-control">
                    </div>

                    <div class =  'm-3'>
                        <input type="password" placeholder = 'Confirmar Contraseña' id = 'password_confirmation' name ='password_confirmation' class="form-control">
                    </div>

                    
                    <div class =  'me-3 mt-4 text-end'>
                        <button type = 'submit' class = 'btn btn-success '>Crear Usuario</button>
                    </div>
                    
                    
                    
                    
                    
                    
                    </form>
                
                
                    
                    <div class = 'm-3'>
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
    </div>
</div>
@endsection