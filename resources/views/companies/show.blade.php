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
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Detail Company</h5>
                </div>
                <div class="card-body">
                    @if(isset($company))
                    <div class="row">
                        <div class="col-md-2">
                            Name
                        </div>
                        <div class="col-md-8">
                            : {{$company->name}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            Email
                        </div>
                        <div class="col-md-8">
                            : {{$company->email}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            Website
                        </div>
                        <div class="col-md-8">
                            : {{$company->website}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            Logo
                        </div>
                        <div class="col-md-8">
                            : <img width="100px" src="{{ url($path.$company->logo) }}" alt="" srcset="">
                        </div>
                    </div>
                    @endif
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