<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compania;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CompaniaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:companias-read', ['only' => ['index']]);
        $this->middleware('permission:companias-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:companias-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:companias-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageTitle'] = 'Companias';
        $data['companias'] = Compania::all();

        return view('companias.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pageTitle'] = 'Agregar datos de Companía';
        // $data['roles'] = Role::all();

        return view('companias.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'rut' => ['required', 'unique:companias'],
            'dv' => ['required', 'string'],
            'nemo' => ['required', 'string','unique:companias'],
            'image' => ['nullable','image','max:2048'],
        ];

        $customMessages = [
            'name.required' => 'Nombre es requerido!',
            'rut.required' => 'Rut es requerido!',
            'rut.numeric' => 'Ingreso solo números!',
            'rut.max' => 'El campo rut debe contener máximo :max caracteres',
            'rut.min' => 'El campo rut debe contener máximo :min caracteres',
            'rut.unique' => 'Rut ya existe, indique otro!',
            'dv.required' => 'dv es requerido!',
            'dv.string' => 'solo letras o números!',
            'dv.string' => 'solo letras o números!',
            'nemo.required' => 'Campo nemo es requerido',
            'nemo.unique' => 'Nemo ya existe, indique otro!',
            // 'image.image' => 'El campo Imagen solo acepta formatos: jpeg,jpg,bmp,png,svg, escoja otra',
            'image.max' => 'El campo Imagen solo acepta hasta 2048 mb',
        ];

        $this->validate($request, $rules, $customMessages);


        $compania = $request->only('name', 'rut', 'dv', 'nemo','image');

        if($imagen= $request->file('image')){
            $nombreimagen = Str::slug($request->nemo).".".$imagen->guessExtension();
            $ruta = public_path('img/companias/');
            $imagen->move($ruta, $nombreimagen);
            $compania['image'] = $nombreimagen;
        }

        $compania = Compania::create($compania);
        return redirect('/companias')->with('message', 'Se ha creado la Compañía.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Compania $compania)
    {

        $data['pageTitle'] = 'Actualizar datos de la Compañía';
        $data['compania'] = $compania;

        return view('companias.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compania $compania)
    {
        $rules = [
             'name' => 'required',
            'rut' => ['required', 'unique:companias,rut,' .$compania->id],
            'dv' => ['required', 'string'],
            'nemo' => ['required', 'string','unique:companias,nemo,' .$compania->id],
            'image' => ['nullable','image','max:2048'],

        ];

        $customMessages = [
            'name.required' => 'Nombre es requerido!',
            'rut.required' => 'Rut es requerido!',
            'rut.numeric' => 'Ingreso solo números!',
            'rut.max' => 'El campo rut debe contener máximo :max caracteres',
            'rut.min' => 'El campo rut debe contener máximo :min caracteres',
            'rut.unique' => 'Rut ya existe, indique otro!',
            'dv.required' => 'dv es requerido!',
            'dv.string' => 'solo letras o números!',
            'dv.string' => 'solo letras o números!',
            'nemo.required' => 'Campo nemo es requerido',
            'nemo.unique' => 'Nemo ya existe, indique otro!',
            // 'image.image' => 'El campo Imagen solo acepta formatos: jpeg,jpg,bmp,png,svg, escoja otra',
            'image.max' => 'El campo Imagen solo acepta hasta 2048 mb',
        ];

        $this->validate($request, $rules, $customMessages);


        $data = $request->only('name', 'rut', 'dv', 'nemo','image');


        if($imagen= $request->file('image')){
            $nombreimagen = Str::slug($request->name).".".$imagen->guessExtension();
            $ruta = public_path('img/companias/');
            $imagen->move($ruta, $nombreimagen);
            $data['image'] = $nombreimagen;
        }else{
            unset($data['image']);
        }
        $compania->update($data);

        return redirect()->route('companias.index')->with('success', 'Compañía actualizada correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compania $compania)
    {
        Compania::destroy($compania->id);

        return redirect('/companias')->with('message', 'Los datos han sido eliminados');
    }
}
