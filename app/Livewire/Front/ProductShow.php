<?php

namespace App\Livewire\Front;

use App\Models\Product;
use Livewire\Component;

class ProductShow extends Component
{
    protected $layout = 'components.layouts.app';

    public $product;

    public function mount($id)
    {
        $this->product = Product::with(['category', 'brand'])->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.front.product-show');
    }
}
