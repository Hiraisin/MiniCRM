@extends('adminlte::page')

@section('title', 'Company')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Companies</h1>
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
                    <h5>Edit Company</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('company.update', [$company->id])}}" method="POST" role="form" enctype="multipart/form-data">
                        <input type="hidden" value="PUT" name="_method">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label>Name</label>
                                <input type="text" value="{{$company->name}}" name="name" class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label>Email</label>
                                <input type="email" value="{{$company->email}}" name="email" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label>Website</label>
                                <input type="text" value="{{$company->website}}" name="website" class="form-control" placeholder="Website">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label for="exampleInputFile">File input</label><br>
                                <input type="file" name="logo" accept="image/png, image/jpeg">
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