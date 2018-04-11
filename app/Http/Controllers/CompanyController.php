<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = DB::table('companies')->paginate(10);

        return view('companies.index', [
            'companies' => $companies
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
            'email' => 'email',
            'logo' => 'nullable|dimensions:min_width=100,min_height=100'
        ]);

        $filename = $request->file('logo')->storeAs(
            'public/logos', $request->file('logo')->getClientOriginalName()
        );

        $company = Company::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'logo' => $request->file('logo')->getClientOriginalName(),
            'website' => $request->input('website'),
        ]);

        if ($company) {
            return redirect()->route('companies.show', [
                'company' => $company->id
            ])->with('success', 'Company created successfully!');
        }

        return back()->withInput()->with('error', 'Error in creating new company');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $company = Company::find($company->id);

        return view('companies.show', [
            'company' => $company
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $company = Company::find($company->id);

        return view('companies.edit', [
            'company' => $company
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email',
            'logo' => 'nullable|dimensions:min_width=100,min_height=100'
        ]);

        $companyUpdate = Company::where('id', $company->id)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'website' => $request->input('website'),
        ]);

        if ($request->file('logo') != null) {
            File::delete(storage_path('app/public/logos/' . $company->logo));

            Company::where('id', $company->id)->update([
                'logo' => $request->file('logo')->getClientOriginalName()
            ]);

            $request->file('logo')->storeAs(
                'public/logos', $request->file('logo')->getClientOriginalName()
            );

        }

        if ($companyUpdate) {
            return redirect()->route('companies.show', [
                'company' => $company->id
            ])->with('success', 'Company updated successfully!');
        }

        return back()->withInput()->with('error', 'Error in updating company');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $companyDelete = Company::find($company->id);

        if ($companyDelete->delete()) {
            File::delete(storage_path('app/public/logos/' . $company->logo));
            
            return redirect()->route('companies.index')
                ->with('success', 'Company deleted succesfully!');
        }

        return back()->withInput()->with('error', 'Company cannot be deleted.');
    }
}
