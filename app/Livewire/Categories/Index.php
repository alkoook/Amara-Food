<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $layout = 'components.layouts.admin';

    public $search = '';
    public $perPage = 10;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        if ($category->image) {
            \Storage::disk('public')->delete($category->image);
        }
        $category->delete();
        session()->flash('message', 'تم حذف الصنف بنجاح');
    }

    public function render()
    {
        $categories = Category::when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })
        ->withCount('products')
        ->latest()
        ->paginate($this->perPage);

        return view('livewire.categories.index', compact('categories'))->layout('components.layouts.admin', ['title' => 'الأصناف']);
;
    }
}
