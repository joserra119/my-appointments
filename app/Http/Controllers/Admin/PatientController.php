<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PatientController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients =User::patients()->paginate(10);
        return view('patients.index',compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $rules=[
            'name'=>'required | min:3',
            'email'=> 'required | email',
            'dni'=>'nullable|digits:8',
            'address'=>'nullable|min:5',
            'phone'=>'nullable|digits:9'

        ];
        $this->validate($request,$rules);

        //mass asignment
        User::create(
            $request->only('name','email','address','phone','dni') 
            + ['role'=> 'patient',
                'password' =>bcrypt($request->input('password'))
              ]
        );
        $notification = 'El médico se ha registrado correctamente';
        return redirect('/patients')->with(compact('notification'));
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

  
    public function edit(User $patient)
    {
        return view('patients.edit',compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules=[
            'name'=>'required | min:3',
            'email'=> 'required | email',
            'dni'=>'nullable|digits:8',
            'address'=>'nullable|min:5',
            'phone'=>'nullable|digits:9'

        ];
        $this->validate($request,$rules);

        $user = User::patients()->findOrFail($id);

        $data=$request->only('name','email','address','phone','dni') ;

        $password=$request->input('password');

        if($password){
           $data[ 'password' ] = bcrypt($password) ;
        }

        $user->fill($data);
        $user->save(); //Update del registro
        $notification = 'El paciente se ha modificado correctamente';
        return redirect('/patients')->with(compact('notification'));

    }

  
    public function destroy(User $patient)
    {
    	$patientName=$patient->name;
        $patient->delete();

        $notification="El paciente $patientName se ha eliminado correctamente";
        return redirect('/patients')->with(compact('notification'));
    }
}