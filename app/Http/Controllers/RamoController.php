<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ramo;

class RamoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ramos-read', ['only' => ['index']]);
        $this->middleware('permission:ramos-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:ramos-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:ramos-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data['pageTitle'] = 'Ramos';
        $data['ramos'] = Ramo::all();

        return view('ramos.index', $data);
    }

    public function create()
    {
        $data['pageTitle'] = 'Agregar datos de Ramo';

        return view('ramos.create', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'nemo' => ['required', 'string','unique:companias'],
        ];

        $customMessages = [
            'name.required' => 'Nombre es requerido!',
            'nemo.required' => 'Campo nemo es requerido',
            'nemo.unique' => 'Nemo ya existe, indique otro!',
        ];

        $this->validate($request, $rules, $customMessages);

        $ramo = $request->only('name', 'nemo');

        $ramo = Ramo::create($ramo);
        return redirect('/ramos')->with('message', 'Se ha creado el Ramo.');
    }

    public function show($id)
    {
        //
    }

    public function edit(Ramo $ramo)
    {
        $data['pageTitle'] = 'Actualizar datos del Ramo';
        $data['ramo'] = $ramo;

        return view('ramos.edit', $data);
    }

    public function update(Request $request, Ramo $ramo)
    {
        $rules = [
            'name' => 'required',
            'nemo' => ['required', 'string','unique:ramos,nemo,' .$ramo->id],
       ];

       $customMessages = [
           'name.required' => 'Nombre es requerido!',
           'nemo.required' => 'Campo nemo es requerido',
           'nemo.unique' => 'Nemo ya existe, indique otro!',
       ];

       $this->validate($request, $rules, $customMessages);

       $data = $request->only('name', 'nemo');

        $ramo->update($data);

        return redirect()->route('ramos.index')->with('success', 'Ramo actualizado correctamente.');
    }

    public function destroy(Ramo $ramo)
    {
        Ramo::destroy($ramo->id);

        return redirect('/ramos')->with('message', 'Los datos han sido eliminados');
    }
}
