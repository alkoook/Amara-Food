<?php

namespace App\Livewire\Front;


use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsIndex extends Component
{
    use WithPagination;

    protected $layout = 'components.layouts.app';

    public $search = '';
    public $perPage = 12;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })
        ->latest()
        ->paginate($this->perPage);

        return view('livewire.front.products-index', compact('products'))->layout('components.front-layout');
    }
}