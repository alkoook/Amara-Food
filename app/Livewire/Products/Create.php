<?php

namespace App\Livewire\Products;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Laravel\Facades\Image;

class Create extends Component
{
    use WithFileUploads;

    protected $layout = 'components.layouts.admin';

    public $name = '';
    public $description = '';
    public $image;
    public $weight = '';
    public $quantity = '';
    public $added_date;
    public $category_id = '';
    public $brand_id = '';

    public $categories = [];
    public $brands = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'required|image|max:20000',
        'weight' => 'nullable|numeric|min:0',
        'quantity' => 'nullable|integer|min:0',
        'added_date' => 'required|date',
        'category_id' => 'required|exists:categories,id',
        'brand_id' => 'required|exists:brands,id',
    ];

    public function mount()
    {
        $this->categories = Category::all();
        $this->brands     = Brand::all();
        $this->added_date = now()->format('Y-m-d');
    }

    public function save()
    {
        $this->validate();

        // Save original image
        $imagePath = $this->image->store('products', 'public');

        // Compress using Intervention Image v3
        $img = Image::read(storage_path('app/public/' . $imagePath));

        $img->scale(width: 800);

        $img->save(storage_path('app/public/' . $imagePath), 80);

        Product::create([
            'name'        => $this->name,
            'description' => $this->description,
            'image'       => $imagePath,
            'weight'      => $this->weight ?: null,
            'quantity'    => $this->quantity ?: null,
            'added_date'  => $this->added_date,
            'category_id' => $this->category_id,
            'brand_id'    => $this->brand_id,
        ]);

        session()->flash('message', 'تم إضافة المنتج بنجاح');
        return redirect()->route('admin.products.index');
    }

    public function render()
    {
        return view('livewire.products.create')->layout('components.layouts.admin', ['title' => 'Products']);
    }
}
