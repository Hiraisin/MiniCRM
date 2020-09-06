<?php

namespace App\Http\Controllers;

use App\Company;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tmp = Company::all();
        $data['company'] = $tmp;
        $data['n'] = 1;
        $data['path'] = Storage::url('images/');
        // return $data;
        return view('companies.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("companies.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        try {
            $rules = [
                'name' => 'required',
                'logo' => 'required|dimensions:max_width=100,max_height=100'
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->route('company.create')->withErrors($validator->errors());
            }
            $file = $request->file('logo');
            $ext = $file->extension();
            $path = Storage::putFile('public/images', $file);

            $data = new Company;
            $data->name = $request->input('name');
            $data->website = $request->input('website');
            $data->email = $request->input('email');
            $data->logo = basename($path);
            $data->save();

            return redirect()->route('company.index')->withSuccess('Tambah Company Berhasil');
        } catch (Exception $ex) {
            $message = $ex->getMessage();
            return redirect()->route('company.create')->withErrors($message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);
        if ($company) {
            $data['company'] = $company;
            $data['path'] = Storage::url('images/');
            return view('companies.show', $data);
        } else {
            return redirect()->route('company.create')->withErrors('Data tidak ditemukan');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        if ($company) {
            $data['company'] = $company;
            return view('companies.edit', $data);
        } else {
            $message = "Data tidak ditemukan";
            return redirect()->route('company.index')->withErrors($message);
        }
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
        try {
            $company = Company::find($id);
            $rules = [
                'name' => 'required',
                'logo' => 'dimensions:max_width=100,max_height=100'
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->route('company.edit', [$company->id])->withErrors($validator->errors());
            }
            $basename = null;
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $path = Storage::putFile('public/images', $file);
                $basename = basename($path);
                Storage::delete('public/images/' . $company->logo);
            }

            $company->name = $request->input('name') ? $request->input('name') : $company->name;
            $company->website = $request->input('website') ? $request->input('website') : $company->website;
            $company->email = $request->input('email') ? $request->input('email') : $company->email;
            $company->logo = $basename != null ? $basename : $company->logo;
            $company->save();

            return redirect()->route('company.index')->withSuccess('Update Berhasil');
        } catch (Exception $ex) {
            return redirect()->route('company.edit', [$company->id])->withErrors($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $company = Company::find($id);
            if ($company) {
                $company->delete();
                Storage::delete('public/images/' . $company->logo);
                return redirect()->route('company.index')->withSuccess('Delete Berhasil');
            } else {
                return redirect()->route('company.index')->withErrors('Data tidak ditemukan');
            }
        } catch (Exception $ex) {
            return redirect()->route('company.index')->withErrors($ex->getMessage());
        }
    }
}
