<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $layout = 'components.front-layout';

    public $search = '';
    public $categoryFilter = '';
    public $brandFilter = '';
    public $sortBy = 'added_date';
    public $sortDirection = 'desc';
    public $perPage = 12;

    public $expiringProducts = []; // مهم تكون Array أو Collection مو null

    public function updatingSearch()   { $this->resetPage(); }
    public function updatingCategoryFilter() { $this->resetPage(); }
    public function updatingBrandFilter() { $this->resetPage(); }

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
        // $products = Product::query()
        //     ->when($this->search, fn($q) => $q->where('name', 'like', '%' . $this->search . '%'))
        //     ->when($this->categoryFilter, fn($q) => $q->where('category_id', $this->categoryFilter))
        //     ->when($this->brandFilter, fn($q) => $q->where('brand_id', $this->brandFilter))
        //     ->with(['category', 'brand'])
        //     ->orderBy($this->sortBy, $this->sortDirection)
        //     ->paginate($this->perPage);


        $categories = Category::all();
        $brands = Brand::all();
        $products = Product::all();

        return view('livewire.admin.dashboard.index', [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
            'expiringProducts' => $this->expiringProducts,
        ])->layout('components.layouts.admin', ['title' => 'الرئيسية']);
    }
}
