<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = \Auth::user()->profile()->company();
        $users = $company->profiles()->users()->exceptMe();

        if($company){
            return view ('company.index',[
            'company' => $company,
            'users' => $users,
            ]);
        }
        return redirect (route('users.top'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = \Auth::user();
        return view ('company.create',[
            'user' => $user,
        ]);
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
            'companyName'=>'required',
            'companyPass'=>'required|min:8',
            'personnelPass'=>'required|min:8'
        ]);

        $company = new Company;

        $company->companyName = $request->companyName;
        $company->companyPass = $request->companyPass;
        $company->personnelPass = $request->personnelPass;
        $company->owner = \Auth::id();
        $company->save();

        $user = \Auth::user();
        $profile = $user->profile();
        $profile->post = 5;
        $profile->companyId = $company->id;
        $profile->save();

        return redirect (route('users.edit',[
            'company' => $company,
            'user' => $user,
            'profile' => $profile,
        ]));

    }

    public function belong(Request $request)
    {
        $id = $request->companyName;
        $pass = $request->companyPass;
        $user = \Auth::user();

        if(Company::where('companyName',$id)->where('companyPass',$pass)->first()){
            $company = Company::where('companyPass',$pass)->first();
            $profile = $user->profile();
            $profile->companyId = $company->id;
            $profile->post = 1;
            $profile->save();

            return redirect (route('users.top'));
        }
        
        return view ('company.rechoice');
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
    public function edit($companyId)
    {
        $company = Company::find($companyId);

        return view ('company.edit',[
            'company' => $company,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $companyId)
    {
        $request->validate([
            'companyName'=>'required',
            'companyPass'=>'required|min:8',
            'personnelPass'=>'required|min:8',
        ]);

        $company = Company::find($companyId);

        $company->companyName = $request->companyName;
        $company->companyPass = $request->companyPass;
        $company->personnelPass = $request->personnelPass;
        $company->save();
        
        return redirect ('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function choice()
    {
        return view('company.choice');
    }
}
