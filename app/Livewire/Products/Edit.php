<?php

namespace App\Livewire\Products;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class Edit extends Component
{
    use WithFileUploads;

    protected $layout = 'components.layouts.admin';

    public $product;
    public $name = '';
    public $description = '';
    public $image;
    public $oldImage;
    public $weight = '';
    public $quantity = '';
    public $expiry_date = '';
    public $added_date;
    public $category_id = '';
    public $brand_id = '';

    public $categories = [];
    public $brands = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|max:2048',
        'weight' => 'nullable|numeric|min:0',
        'quantity' => 'nullable|integer|min:0',
        'expiry_date' => 'nullable|date',
        'added_date' => 'required|date',
        'category_id' => 'required|exists:categories,id',
        'brand_id' => 'required|exists:brands,id',
    ];

    public function mount($id)
    {
        $this->product = Product::findOrFail($id);
        $this->name = $this->product->name;
        $this->description = $this->product->description;
        $this->oldImage = $this->product->image;
        $this->weight = $this->product->weight;
        $this->quantity = $this->product->quantity;
        $this->expiry_date = $this->product->expiry_date?->format('Y-m-d');
        $this->added_date = $this->product->added_date->format('Y-m-d');
        $this->category_id = $this->product->category_id;
        $this->brand_id = $this->product->brand_id;
        $this->categories = Category::all();
        $this->brands = Brand::all();
    }

    public function update()
    {
        $this->validate();

        $imagePath = $this->oldImage;
        
        if ($this->image) {
            // Delete old image
            if ($this->oldImage) {
                \Storage::disk('public')->delete($this->oldImage);
            }
            
            $imagePath = $this->image->store('products', 'public');
            
            // Compress image
            $img = Image::make(storage_path('app/public/' . $imagePath));
            $img->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->save(storage_path('app/public/' . $imagePath), 80);
        }

        $this->product->update([
            'name' => $this->name,
            'description' => $this->description,
            'image' => $imagePath,
            'weight' => $this->weight ?: null,
            'quantity' => $this->quantity ?: null,
            'expiry_date' => $this->expiry_date ?: null,
            'added_date' => $this->added_date,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
        ]);

        session()->flash('message', 'تم تحديث المنتج بنجاح');
        return redirect()->route('admin.products.index');
    }

    public function render()
    {
        return view('livewire.products.edit');
    }
}

