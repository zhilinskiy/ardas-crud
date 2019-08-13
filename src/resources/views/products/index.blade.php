@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Products in database</div>
                    <div class="card-body">
                        <div class="row justify-content-between mb-2">
                            <div class="col-6">
                                <form action="{{route('products.index')}}" method="GET">
                                    <div class="input-group">
                                        <input value="{{request()->get('q')}}" type="text" name="q" class="form-control" placeholder="Search product by name">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-info" type="submit">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-3">
                                <a href="{{route('products.create')}}" class="btn btn-outline-primary">New product</a>
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Created at</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->created_at}}</td>
                                    <td>
                                        <a href="{{route('products.edit', $product)}}" class="btn btn-outline-primary">Edit</a>
                                        <a href="javascript:void 0"
                                           data-toggle="modal" data-target="#deleteModal"
                                           data-href="{{route('products.destroy', $product)}}" class="btn btn-outline-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete confirmation modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a type="button" class="btn btn-primary" id="deleteProductBtn">Delete product</a>
                </div>
            </div>
        </div>
    </div>
@endsection

