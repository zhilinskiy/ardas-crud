@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        @if($product->id)
                            Edit: {{$product->name}}
                        @else
                            Create new product
                        @endif
                    </div>
                    <div class="card-body">
                        @if($product->id)
                            <form action="{{route('products.update', $product)}}" method="POST">
                                @method('PUT')
                        @else
                            <form action="{{route('products.store')}}" method="POST">
                        @endif
                            @csrf
                            <div class="form-group">
                                <label for="name">Product name</label>
                                <input type="text" name="name" id="name" required
                                       value="{{ old('name', $product->name) }}"
                                       class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="price">Product price</label>
                                <input type="text" name="price" id="price" placeholder="0.00"
                                       value="{{ old('price', $product->price) }}"
                                       class="form-control @error('price') is-invalid @enderror">
                                @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            @if ($product->options->isNotEmpty())
                                @foreach ($product->options as $option)
                                    @include('products._option_field', ['option' => $option, 'new' => false])
                                @endforeach
                            @endif
                            @if ($options->isNotEmpty())
                                @foreach ($options as $option)
                                    @include('products._option_field', ['option' => $option, 'new' => true])
                                @endforeach
                            @endif
                            <button type="submit" class="success">
                                @if($product->id)
                                    Save
                                @else
                                    Create
                                @endif
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

