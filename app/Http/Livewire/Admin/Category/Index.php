<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $category_id;

    public function deleteCategory($category_id)
    {
        dd($category_id);
        $this->category_id = $category_id;
    }

    public function render()
    {
        $categories = Category::orderBy('id', 'ASC')->paginate(10);
        // $categories = Category::orderBy('id', 'DESC')->paginate(2);

        // return view('livewire.admin.category.index', ['categories' => $categories]);
        return view('livewire.admin.category.index', compact('categories'));
    }
}
