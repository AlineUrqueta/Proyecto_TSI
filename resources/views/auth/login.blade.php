@extends('layouts.master')
@section('title','Login')
@section('contenido')


<div class="row mt-5">
    <div class="col-sm-12 col-md-5  order-md-first order-sm-last">
        <img src="{{asset('images/logo.jpeg')}}" alt="Logo Centro" class="img-fluid">
        <h1></h1>
    </div>
    <div class="col-md-7  mb-sm-5 order-md-last order-sm-first">
        <div class="d-flex justify-content-center align-items-center">
            <div class="card" style="width: 45rem; height: auto;">
                <div class="card-header text-center">
                    <h4>Iniciar Sesión</h4>
                </div>
                <div class="card-body">
                    <form action="" class = 'mt-4' method = 'POST' action = ''>
                        @csrf
                        <div class="m-3">
                        <input type="email" placeholder = 'Correo' id = 'email' name ='email' class="form-control">

                        </div>
                        <div class="m-3">
                            <input type="password" placeholder = 'Contraseña' id = 'password' name ='password' class="form-control">
                        </div>

                        <div class="me-3 mt-4 text-end">   
                            <button class = 'btn btn-success'type = 'submit'>Iniciar Sesión</button>
                        </div>
                    
                        <div class="m-3">
                            @error('message')
                                <p class = 'alert alert-danger'>{{$message}}</p>
                            @enderror
                        </div>

                        
                        
                        
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
