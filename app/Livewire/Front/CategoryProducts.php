<?php

namespace App\Livewire\Front;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryProducts extends Component
{
    use WithPagination;

    protected $layout = 'components.layouts.app';

    public $category;
    public $search = '';
    public $brandFilter = '';
    public $sortBy = 'added_date';
    public $sortDirection = 'desc';
    public $perPage = 12;

    public function mount($id)
    {
        $this->category = Category::findOrFail($id);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingBrandFilter()
    {
        $this->resetPage();
    }

    public function sort($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'desc';
        }
    }

    public function render()
    {
        $products = Product::where('category_id', $this->category->id)
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->when($this->brandFilter, function ($query) {
                $query->where('brand_id', $this->brandFilter);
            })
            ->with(['category', 'brand'])
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        $brands = $this->category->brands;

        return view('livewire.front.category-products', compact('products', 'brands'))->layout('components.front-layout');
    }
}