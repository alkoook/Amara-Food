<?php

namespace App\Livewire\Brands;

use App\Models\Brand;
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
        $brand = Brand::findOrFail($id);
        if ($brand->logo) {
            \Storage::disk('public')->delete($brand->logo);
        }
        $brand->delete();
        session()->flash('message', 'تم حذف الشركة بنجاح');
    }

    public function render()
    {
        $brands = Brand::when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })
        ->withCount('products')
        ->latest()
        ->paginate($this->perPage);

        return view('livewire.brands.index', compact('brands'))->layout('components.layouts.admin', ['title' => 'Brands']);
    }
}