<?php

namespace App\Http\Controllers;

use App\Option;
use App\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateEditProduct;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('products.index', ['products' => Product::latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('products.new_edit',
            [
                'product' => new Product(),
                'options' => Option::all(),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateEditProduct $request
     * @return Response
     */
    public function store(CreateEditProduct $request)
    {
        try {
            DB::transaction(
                function () use ($request) {
                    $options = $this->getOptionsFromRequest();
                    $product = new Product(
                        $request->all(['name', 'price'])
                    );
                    $product->save();
                    $product->options()->sync($options);
                }
            );
        } catch (\Exception $e) {
            return redirect()->back();
        }

        return redirect()->route('products.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function edit(Product $product)
    {
        $product->load('options');
        $options = Option::whereNotIn('id', $product->options->pluck('id'))->get();

        return view('products.new_edit',
            [
                'product' => $product,
                'options' => $options,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreateEditProduct $request
     * @param Product $product
     * @return Response
     */
    public function update(CreateEditProduct $request, Product $product)
    {
        try {
            DB::transaction(
                function () use ($request, $product) {
                    $options = $this->getOptionsFromRequest();
                    $product->fill(
                        $request->all(['name', 'price'])
                    );
                    $product->save();
                    $product->options()->sync($options);
                }
            );
        } catch (\Exception $e) {
            return redirect()->back();
        }

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Response
     */
    public function destroy(Product $product)
    {
        //
    }

    /**
     * Get product valid options from request.
     *
     * @return array
     */
    protected function getOptionsFromRequest()
    {
        return collect(
            request()->get('options', [])
        )->filter(
            function ($value, $key) {
                return ((int) $key > 0) ? Option::whereId((int) $key)->exists() : false;
            }
        )->map(
            function ($value) {
                return ['value' => $value];
            }
        )->toArray();
    }
}
