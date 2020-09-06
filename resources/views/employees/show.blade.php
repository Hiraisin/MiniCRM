@extends('adminlte::page')

@section('title', 'Employee')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Employees</h1>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Detail Employee</h5>
                </div>
                <div class="card-body">
                    @if(isset($employee))
                    <div class="row">
                        <div class="col-md-2">
                            Name
                        </div>
                        <div class="col-md-8">
                            : {{$employee->first_name.' '.$employee->last_name}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            Email
                        </div>
                        <div class="col-md-8">
                            : {{$employee->email}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            Website
                        </div>
                        <div class="col-md-8">
                            : {{$employee->phone}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            Company
                        </div>
                        <div class="col-md-8">
                            : {{$employee->company->name}}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@stop