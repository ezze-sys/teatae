<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Waste extends Component
{
    public $logs, $product_id, $quantity, $reason;

    public function render()
    {
        $this->logs = \App\Models\WasteLog::with(['product', 'user'])->latest()->get();
        return view('livewire.admin.waste')->layout('layouts.admin');
    }

    public function store()
    {
        $this->validate([
            'product_id' => 'required',
            'quantity' => 'required|numeric|min:1',
            'reason' => 'required',
        ]);

        \App\Models\WasteLog::create([
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'reason' => $this->reason,
            'user_id' => auth()->id(),
        ]);

        // Deduct stock if managed
        $product = \App\Models\Product::find($this->product_id);
        if ($product->is_stock_managed) {
            $product->decrement('stock', $this->quantity);
        }

        session()->flash('message', 'Waste Logged Successfully.');

        $this->reset(['product_id', 'quantity', 'reason']);
    }
}
