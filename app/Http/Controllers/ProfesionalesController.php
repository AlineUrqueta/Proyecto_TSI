<?php

namespace App\Http\Controllers;

use App\Models\Profesional;
use Illuminate\Http\Request;

class ProfesionalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return view('admin.admi_profesional');
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Profesional $profesional)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profesional $profesional)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profesional $profesional)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profesional $profesional)
    {
        //
    }
}