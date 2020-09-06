<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tmp = Employee::all();
        $tmp->load('company');
        $data['employee'] = $tmp;
        $data['n'] = 1;
        // return $data;
        return view('employees.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['company'] = Company::all();
        return view("employees.add", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'first_name' => 'required',
                'last_name' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->route('employee.create')->withErrors($validator->errors());
            }
            $employee = new Employee();
            $employee->first_name = $request->input('first_name');
            $employee->last_name = $request->input('last_name');
            $employee->email = $request->input('email');
            $employee->phone = $request->input('phone');
            $employee->company_id = $request->input('company_id');
            $employee->save();

            return redirect()->route('employee.index')->withSuccess('Tambah Employee Berhasil');
        } catch (Exception $ex) {
            return redirect()->route('employee.index')->withErrors($ex->getMessage());
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
        $tmp = Employee::find($id);
        if ($tmp) {
            $tmp->load('company');
            $data['employee'] = $tmp;
            return view('employees.show', $data);
        } else {
            return redirect()->route('employee.index')->withErrors('Data tidak ditemukan');
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
        $tmp = Employee::find($id);
        if ($tmp) {
            $tmp->load('company');
            $data['data'] = $tmp;
            $data['company'] = Company::all();
            // return $tmp;
            return view('employees.edit', $data);
        } else {
            return redirect()->route('employee.index')->withErrors('Data tidak ditemukan');
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
            $data = Employee::find($id);
            $rules = [
                'first_name' => 'required',
                'last_name' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->route('employee.create')->withErrors($validator->errors());
            }
            $data->first_name = ($request->input('first_name') ? $request->input('first_name') : $data->first_name);
            $data->last_name = ($request->input('last_name') ? $request->input('last_name') : $data->last_name);
            $data->email = ($request->input('email') ? $request->input('email') : $data->email);
            $data->phone = ($request->input('phone') ? $request->input('phone') : $data->phone);
            $data->company_id = ($request->input('company_id') ? $request->input('company_id') : $data->company_id);
            $data->save();

            return redirect()->route('employee.index')->withSuccess('Update Berhasil');
        } catch (Exception $ex) {
            return redirect()->route('employee.edit', [$data->id])->withErrors($ex->getMessage());
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
            $employee = Employee::find($id);
            if ($employee) {
                $employee->delete();
                return redirect()->route('employee.index')->withSuccess('Delete Berhasil');
            } else {
                return redirect()->route('employee.index')->withErrors('Data tidak ditemukan');
            }
        } catch (Exception $ex) {
            return redirect()->route('employee.index')->withErrors($ex->getMessage());
        }
    }
}
