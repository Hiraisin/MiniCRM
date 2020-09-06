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
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Edit Employee</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('employee.update', [$data->id])}}" method="POST" role="form" enctype="multipart/form-data">
                        <input type="hidden" value="PUT" name="_method">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label>First Name</label>
                                <input type="text" value="{{$data->first_name}}" name="first_name" class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label>Last Name</label>
                                <input type="text" value="{{$data->last_name}}" name="last_name" class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label>Email</label>
                                <input type="email" value="{{$data->email}}" name="email" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label>Phone</label>
                                <input type="text" value="{{$data->phone}}" name="phone" class="form-control" placeholder="Website">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label>Phone</label>
                                <select name="company_id" class="form-control">
                                    <option selected disabled value="">-- Company --</option>
                                    @foreach($company as $comp)
                                    <option value="{{$comp->id}}" {{($data->company->id == $comp->id ? 'selected':'')}}>{{$comp->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        $('#users-table').DataTable();
    });
</script>
@stop