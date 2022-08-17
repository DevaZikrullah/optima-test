@extends('companies.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>companies</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('companies.create') }}"> Create New Companies</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif   

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Logo</th>
            <th>Email</th>
            <th>website</th>
            <th width="280px">Action</th>
        </tr>

        @foreach ($companies as $companie)

        <tr>

            <td>{{ ++$i }}</td>

            <td>{{ $companie->name }}</td>

            <td>{{ $companie->logo }}</td>

            <td>{{ $companie->email }}</td>

            <td>{{ $companie->website }}</td>


            <td>
                <form action="{ route('companies.destroy',$companie->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('companies.show',$companie->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('companies.edit',$companie->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
   {!! $companies->links() !!}
@endsection