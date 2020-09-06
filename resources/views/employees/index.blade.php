@extends('adminlte::page')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

@section('title', 'Employee')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>List Employee</h1>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
@if(session('success'))
<div class="alert alert-success">
    {{session('success')}}
</div>
@elseif ($errors->any())
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
                    <div class="col-md-3">
                        <a href="{{route('employee.create')}}" class="btn btn-primary"><i class="fas fa-edit"> Tambah</i></a>
                    </div>
                    <div class="col-md-9">

                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="users-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Company</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employee as $emp)
                            <tr>
                                <td>{{$n++}}</td>
                                <td>{{$emp->first_name.' '.$emp->last_name}}</td>
                                <td>{{$emp->email}}</td>
                                <td>{{$emp->phone}}</td>
                                <td>{{$emp->company->name}}</td>
                                <td>
                                    <a href="{{route('employee.show', [$emp->id])}}" class="btn btn-primary"><i class="fas fa-list-alt"></i>Show</a><br>
                                    <a href="{{route('employee.edit', [$emp->id])}}" class="btn btn-warning"><i class="fas fa-edit"></i>Edit</a>
                                    <form action="{{route('employee.destroy', [$emp->id])}}" method="post" onsubmit="return confirm('Apakah anda yakin?')">
                                        @csrf
                                        <input type="hidden" value="DELETE" name="_method">
                                        <button type="submit" class=" btn btn-danger"><i class="fas fa-trash"></i>Delete</button>

                                        <!-- <a class="btn btn-danger" type="submit"><i class="fas fa-trash"></i>Delete</a> -->
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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