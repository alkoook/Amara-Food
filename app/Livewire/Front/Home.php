<?php

namespace App\Livewire\Front;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;

    protected $layout = 'components.front-layout';

    public $search = '';
    public $categoryFilter = '';
    public $brandFilter = '';
    public $sortBy = 'added_date';
    public $sortDirection = 'desc';
    public $perPage = 12;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter()
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
        $products = Product::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->when($this->categoryFilter, function ($query) {
                $query->where('category_id', $this->categoryFilter);
            })
            ->when($this->brandFilter, function ($query) {
                $query->where('brand_id', $this->brandFilter);
            })
            ->with(['category', 'brand'])
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        $categories = Category::all();
        $brands = Brand::all();

        return view('livewire.front.home', compact('products', 'categories', 'brands'))->layout('components.front-layout');
    }
}
