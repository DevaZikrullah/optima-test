<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Companies::with('employees')->paginate(10);

        return response()->json(["success" => true,
        "message" => "companie retrieved successfully.",
        "data" => $companies
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
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
            'name' => 'required',
            'logo'=> 'nullable',
            'email',
            'website'
        ]);
        $data = $request->only(
            'name',
            'logo',
            'email',
            'website'
        );
        if($files = $data['logo']){
            $filename = $files->getClientOriginalName();
            $data['logo'] = $filename;
            $files->store('public');
        }
        // dd($request->all());
        $companie = Companies::create($data);
        return response()->json(["success" => true,
        "message" => "companie create successfully.",
        "data" => $companie
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param   $companies
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $companie = Companies::find($id);
        if (is_null($companie)) {
            return $this->sendError('companie not found.');
        }
        return response()->json(["success" => true,
        "message" => "companie retrieved successfully.",
        "data" => $companie
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param    $companies
     * @return \Illuminate\Http\Response
     */
    public function edit($companie)
    {
        return view('companies.edit',compact('companie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param    $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Companies $companie)
    {
        $request->validate([
            'name' => 'required',
            'logo'=> 'nullable',
            'email',
            'website'
        ]);
        
        $companie->name = $request->name;
        $companie->logo = $request->logo;
        $companie->email = $request->email;
        $companie->website = $request->website;
        if($files = $companie->logo){
            $filename = $files->getClientOriginalName();
            $data['logo'] = $filename;
            $files->store('public');
        }

        $companie->save();

        return response()->json(['companies updated successfully.',$companie]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $companie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Companies $companie)
    {
        $companie->delete();
        
        return response()->json('Companies deleted successfully');
    }
}
