<?php

namespace App\Livewire\Pos;

use Livewire\Component;

class Pos extends Component
{
    public $categories;
    public $selectedCategory = null;
    public $cart = [];
    public $payment_method = 'cash';
    public $search = '';
    public $customers;
    public $selectedCustomerId = null;
    public $selectedCustomerName = null;

    public function mount()
    {
        $this->categories = \App\Models\Category::all();
        $this->customers = \App\Models\Customer::all();
    }

    public function render()
    {
        $query = \App\Models\Product::with('category');

        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $products = $query->get();

        return view('livewire.pos.pos', [
            'products' => $products,
            'total' => $this->calculateTotal(),
        ])->layout('layouts.pos');
    }

    public function selectCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
    }

    public function selectCustomer($id, $name = null)
    {
        $this->selectedCustomerId = $id;
        $this->selectedCustomerName = $name;
    }

    public function addToCart($productId)
    {
        $product = \App\Models\Product::find($productId);

        if (!$product) {
            $this->dispatch('notify', message: 'Product not found.', type: 'error');
            return;
        }

        if ($product->is_stock_managed && $product->stock <= 0) {
            $this->dispatch('notify', message: 'Product is out of stock.', type: 'error');
            return;
        }

        if (isset($this->cart[$productId])) {
            if ($product->is_stock_managed && $this->cart[$productId]['quantity'] >= $product->stock) {
                $this->dispatch('notify', message: 'Not enough stock available.', type: 'error');
                return;
            }
            $this->cart[$productId]['quantity']++;
        } else {
            $this->cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }
        
        $this->dispatch('notify', message: 'Added to cart.', type: 'success');
    }

    public function removeFromCart($productId)
    {
        unset($this->cart[$productId]);
    }

    public function updateQuantity($productId, $quantity)
    {
        if ($quantity > 0) {
            $product = \App\Models\Product::find($productId);
            if ($product->is_stock_managed && $quantity > $product->stock) {
                $this->dispatch('notify', message: 'Not enough stock available.', type: 'error');
                return;
            }
            $this->cart[$productId]['quantity'] = $quantity;
        } else {
            $this->removeFromCart($productId);
        }
    }

    public function calculateTotal()
    {
        $total = 0;
        foreach ($this->cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    public function checkout()
    {
        if (empty($this->cart)) {
            return;
        }

        $order = \App\Models\Order::create([
            'invoice_number' => 'INV-' . time(),
            'user_id' => auth()->id(),
            'customer_id' => $this->selectedCustomerId,
            'total' => $this->calculateTotal(),
            'payment_method' => $this->payment_method,
            'status' => 'completed',
        ]);

        foreach ($this->cart as $item) {
            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);

            // Deduct stock if managed
            $product = \App\Models\Product::find($item['id']);
            if ($product->is_stock_managed) {
                $product->decrement('stock', $item['quantity']);
            }
        }

        // Add points to customer if selected (e.g., 1 point per 10000 spent)
        if ($this->selectedCustomerId) {
            $customer = \App\Models\Customer::find($this->selectedCustomerId);
            $points = floor($order->total / 10000);
            $customer->increment('points', $points);
        }

        $this->cart = [];
        $this->selectedCustomerId = null;
        $this->selectedCustomerName = null;
        $this->dispatch('notify', message: 'Transaction Successful! Invoice: ' . $order->invoice_number, type: 'success');
    }
}
