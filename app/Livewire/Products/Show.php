<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;

class Show extends Component
{
    protected $layout = 'components.layouts.admin';

    public $product;

    public function mount($id)
    {
        $this->product = Product::with(['category', 'brand'])->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.products.show');
    }
}

