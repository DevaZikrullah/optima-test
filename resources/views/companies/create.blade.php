@extends('companies.layout')

  

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Companies</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('companies.index') }}"> Back</a>
        </div>
    </div>
</div>

   

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('companies.store') }}" method="POST">
    @csrf
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
        <strong>Logo:</strong>
        <input 
                type="file" 
                name="logo" 
                id="inputImage"
                class="form-control @error('image') is-invalid @enderror">
                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <textarea class="form-control" style="height:150px" name="email" placeholder="Email"></textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>website:</strong>
                <textarea class="form-control" style="height:150px" name="website" placeholder="Website"></textarea>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </div>

</form>

@endsection