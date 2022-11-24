<?php

namespace App\Http\Livewire\Admin\Brands;

use App\Models\Brand;
use Livewire\Component;

class Edit extends Component
{

    public Brand $brand;

    public $name;
    public $slug;
    public $status;

    public function mount()
    {
        $this->name = $this->brand->name;
        $this->slug = $this->brand->slug;
        $this->status = $this->brand->status==true?'1':'0';
    }

    protected $rules = [
        'name' => [
            'required'
        ],
        'slug' => [
            'required'
        ]
    ];

    public function update()
    {

        $this->brand->update($this->validate());

        session()->flash('message', 'Brand successfully updated.');

        return redirect()->route('admin.brands.index');
    }


    public function render()
    {
        $brand = $this->brand;
        return view('livewire.admin.brands.edit', compact('brand'))
        ->extends('layouts.admin')
        ->section('content');
    }
}
