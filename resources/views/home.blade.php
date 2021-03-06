@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">List</div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Code</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Cost</th>
                                <th scope="col">Discount</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($goods as $good)
                            <tr>
                                <th scope="row">{{ $good->id }}</th>
                                <td>{{ $good->product->code }}</td>
                                <td>{{ $good->product->name }}</td>
                                <td>{{ $good->product->description }}</td>
                                <td>{{ $good->stock }}</td>
                                <td>{{ $good->cost }}</td>
                                <td>{{ $good->discount }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $goods->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header">
                    Import
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="insert" value="insert" name="radios" checked>
                            <label class="form-check-label" for="insert">Insert</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="replace" value="replace" name="radios">
                            <label class="form-check-label" for="replace">Replace</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="delete" value="delete" name="radios">
                            <label class="form-check-label" for="delete">Delete</label>
                        </div>
                        <br>
                        <input type="file" name="file">
                        <br>
                        <br>
                        <button class="btn btn-success">Process</button>
                    </form>
                    <br>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    </div><br />
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
