<?php

namespace App\Livewire\Front;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoriesIndex extends Component
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
        $categories = Category::when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })
        ->withCount('products')
        ->latest()
        ->paginate($this->perPage);

        return view('livewire.front.categories-index', compact('categories'));
    }
}

