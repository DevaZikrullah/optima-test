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
        $companies = Companies::paginate(10);

        return view('companies.index',compact('companies'))
        ->with('i', (request()->input('page', 1) - 1) * 10);
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
        Companies::create($data);
        return redirect()->route('companies.index')
        ->with('success','Companies created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function show(Companies $companie)
    {
        return view('companies.show',compact('companie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $companies
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
     * @param    $companie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $companie)
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

        $companie->update($data);

        return redirect()->route('companies.index')
        ->with('success','Companies updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $companie
     * @return \Illuminate\Http\Response
     */
    public function destroy($companie)
    {
        $companie->delete();
        
        return redirect()->route('companies.index')
        ->with('success','Companie deleted successfully');
    }
}
