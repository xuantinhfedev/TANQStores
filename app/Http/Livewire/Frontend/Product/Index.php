<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Product;
use Livewire\Component;


class Index extends Component
{
    public $products,$category;
   
    public function mount($category)
    {
        $this->$category = $category;
    }
    public function render()
    {
        $this->products =Product::where('category_id', $this->category->id)->where('status','0')->get();
        return view('livewire.frontend.product.index',[
            'products'=>$this->products,
            'category' =>$this->category
        ]);
    }
}
