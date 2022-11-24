<?php

namespace App\Http\Livewire\Admin\Brands;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    // use WithPagination;

    // protected $paginationTheme = 'bootstrap';

    protected $listeners = ['deleteBrand'];

    public function deleteBrand($id)
    {

        Brand::find($id)->delete();

        session()->flash('message', 'Brand successfully deleted.');
        
        return redirect()->route('admin.brands.index');
    }

    public function render()
    {
        $brands = Brand::paginate(5);

        return view('livewire.admin.brands.index', ['brands' => $brands])
            ->extends('layouts.admin')
            ->section('content');
    }
}
