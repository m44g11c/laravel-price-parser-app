@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
            <div class="content shadow">
                <table class="table table-hover table-dark">
                    <thead>
                        <tr>
                            <th scope="col">@sortablelink('id')</i></th>
                            <th scope="col">@sortablelink('user.name', 'supplier')</th>
                            <th scope="col">@sortablelink('product.code', 'code')</th>
                            <th scope="col">@sortablelink('product.name', 'name')</th>
                            <th scope="col">@sortablelink('product.description', 'description')</th>
                            <th scope="col">@sortablelink('stock')</th>
                            <th scope="col">@sortablelink('cost')</th>
                            <th scope="col">@sortablelink('discontinued')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($goods as $good)
                        <tr>
                            <th scope="row">{{ $good->id }}</th>
                            <td>{{ $good->user->name }}</td>
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
                <div class="d-flex justify-content-center">
                    {{ $goods->links() }}
                </div>
            </div>
        
    </div>
</div>
@endsection