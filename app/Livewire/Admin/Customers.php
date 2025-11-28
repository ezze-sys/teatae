<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Customers extends Component
{
    public $customers, $name, $phone, $points, $customerId;
    public $isOpen = false;

    public function render()
    {
        $this->customers = \App\Models\Customer::all();
        return view('livewire.admin.customers')->layout('layouts.admin');
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
        $this->phone = '';
        $this->points = 0;
        $this->customerId = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'phone' => 'nullable|unique:customers,phone,' . $this->customerId,
        ]);

        \App\Models\Customer::updateOrCreate(['id' => $this->customerId], [
            'name' => $this->name,
            'phone' => $this->phone,
            'points' => $this->points ?? 0,
        ]);

        session()->flash('message', $this->customerId ? 'Customer Updated Successfully.' : 'Customer Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $customer = \App\Models\Customer::findOrFail($id);
        $this->customerId = $id;
        $this->name = $customer->name;
        $this->phone = $customer->phone;
        $this->points = $customer->points;

        $this->openModal();
    }

    public function delete($id)
    {
        \App\Models\Customer::find($id)->delete();
        session()->flash('message', 'Customer Deleted Successfully.');
    }
}
