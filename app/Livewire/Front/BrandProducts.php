<?php

namespace App\Livewire\Front;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class BrandProducts extends Component
{
    use WithPagination;

    protected $layout = 'components.layouts.app';

    public $brand;
    public $search = '';
    public $categoryFilter = '';
    public $sortBy = 'added_date';
    public $sortDirection = 'desc';
    public $perPage = 12;

    public function mount($id)
    {
        $this->brand = Brand::findOrFail($id);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter()
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
        $products = Product::where('brand_id', $this->brand->id)
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->when($this->categoryFilter, function ($query) {
                $query->where('category_id', $this->categoryFilter);
            })
            ->with(['category', 'brand'])
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        $categories = $this->brand->categories;

        return view('livewire.front.brand-products', compact('products', 'categories'));
    }
}

