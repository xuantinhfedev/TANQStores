<?php

namespace App\Http\Livewire\Admin\Brands;

use App\Models\Brand;
use Livewire\Component;

class Create extends Component
{

    public $name, $slug;

    protected $rules = [
        'name' => 'required',
        'slug' => 'required',
    ];

    public function store()
    {
        Brand::create($this->validate());

        session()->flash('message', 'Brand successfully created.');

        return redirect()->route('admin.brands.index');
    }
    public function render()
    {
        return view('livewire.admin.brands.create')
            ->extends('layouts.admin')
            ->section('content');
    }
}
