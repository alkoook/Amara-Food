<?php

namespace App\Livewire\Front;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;

class BrandsIndex extends Component
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
        $brands = Brand::when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })
        ->withCount('products')
        ->latest()
        ->paginate($this->perPage);

        return view('livewire.front.brands-index', compact('brands'))->layout('components.front-layout');
    }
}