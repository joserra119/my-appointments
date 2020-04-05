<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Specialty;
use App\Http\Controllers\Controller;

class SpecialtyController extends Controller
{

	public function __construct(){

		$this->middleware('auth'); // Todas las rutas que este controlador resuelva van a exigir 									que el usuario como mínimo inicie sesión
	}
    public function index(){

    	$specialties = Specialty::all();

    	return view('specialties.index', compact('specialties'));
    }

    public function create(){

    	return view('specialties.create');
    }

    private function performValidation(Request $request){
            $rules= [
            'name'=> 'required|min:3'
            
        ];

        $messages=[
            'name.required'=> 'Es necesario ingresar un nombre',
            'name.min'=> 'El nombre debe de tener al menos 3 caracteres',
        ];

        $this->validate($request, $rules, $messages); //Si hay algún error, la funcion se para aquí y devuelve validate a la vista anterior
    }
    public function store(Request $request){

    	//dd($request->all());
    
        $this->performValidation($request);

    	$specialty = new Specialty();
    	$specialty->name=$request->input('name');
    	$specialty->description=$request->input('description');
    	$specialty->save();

        $notification = 'La especialidad se ha registrado correctamente';
    	return redirect('/specialties')->with(compact('notification'));
    }

    public function edit(Specialty $specialty){
    	return view('specialties.edit',compact('specialty'));
    }

    public function update(Request $request, Specialty $specialty){

    	//dd($request->all());
    	$this->performValidation($request);
    	
    	$specialty->name=$request->input('name');
    	$specialty->description=$request->input('description');
    	$specialty->save(); //Operación de actualización

        $notification = " La especialidad se ha actualizado correctamente";
    	return redirect('/specialties')->with(compact('notification'));
    }
    public function destroy(Specialty $specialty){
         $deletedSpecialty= $speciality->name;
         $specialty->delete();

         $notification = " La especialidad " . $deletedSpecialty." se ha eliminado correctamente";
         return redirect('/specialties')->with(compact('notification'));

    }
}
