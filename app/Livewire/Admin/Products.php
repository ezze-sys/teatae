<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Products extends Component
{
    public $products, $name, $sku, $price, $stock, $category_id, $productId;
    public $is_stock_managed = true;
    public $isOpen = false;

    public function render()
    {
        $this->products = \App\Models\Product::with('category')->get();
        return view('livewire.admin.products')->layout('layouts.admin');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isOpen = true;
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->sku = '';
        $this->price = '';
        $this->stock = '';
        $this->category_id = '';
        $this->is_stock_managed = true;
        $this->productId = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'sku' => 'required|unique:products,sku,' . $this->productId,
            'price' => 'required|numeric',
            'category_id' => 'required',
        ]);

        \App\Models\Product::updateOrCreate(['id' => $this->productId], [
            'name' => $this->name,
            'sku' => $this->sku,
            'price' => $this->price,
            'stock' => $this->stock ?? 0,
            'is_stock_managed' => $this->is_stock_managed,
            'category_id' => $this->category_id,
        ]);

        session()->flash('message', $this->productId ? 'Product Updated Successfully.' : 'Product Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $this->productId = $id;
        $this->name = $product->name;
        $this->sku = $product->sku;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->is_stock_managed = $product->is_stock_managed;
        $this->category_id = $product->category_id;

        $this->openModal();
    }

    public function delete($id)
    {
        \App\Models\Product::find($id)->delete();
        session()->flash('message', 'Product Deleted Successfully.');
    }
}
