<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employees::paginate(10);

        return response()->json(["success" => true,
        "message" => "employees retrieved successfully.",
        "data" => $employees
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name'=> 'required',
            'companies_id',
            'email',
            'phone'
        ]);
        $data = $request->only(
            'first_name',
            'last_name',
            'companies_id',
            'email',
            'phone'
        );
        $count = Companies::count();
        // dd($count);

        if($data > $count){
            return 'not find id companies';
        }

       
        Employees::create($data);
        return redirect()->route('employees.index')
        ->with('success','Employees created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employees = Employees::find($id);
        if (is_null($employees)) {
            return $this->sendError('employees not found.');
        }
        return response()->json(["success" => true,
        "message" => "employees retrieved successfully.",
        "data" => $employees
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('employees.edit',compact('employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employees $employees)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'companies_id',
            'email',
            'phone'
        ]);
        
        $employees->first_name = $request->first_name;
        $employees->last_name = $request->last_name;
        $employees->companies_id = $request->companies_id;
        $employees->email = $request->email;
        $employees->phone = $request->phone;

        $count = Companies::count();
        if($employees->companies_id > $count){
            return 'not find id companies';
        }

        $employees->save();

        return response()->json(['emplooyees updated successfully.',$employees]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employees::find($id)->delete();
        
        return response()->json('employees deleted successfully');
    }
}
