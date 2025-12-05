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

        $imagePath = null;

        if ($this->image) {
            // اسم الملف لتجنب التكرار
            $filename = time() . '_' . $this->image->getClientOriginalName();
            $imagePath = 'products/' . $filename;

            // المسار النهائي داخل public_html/storage
            $destination = base_path('public_html/storage/' . $imagePath);

            // ضغط الصورة
            $img = Image::read($this->image->getRealPath());
            $img->scale(width: 800);
            $img->save($destination, 80);
        }

        // حفظ المنتج في قاعدة البيانات
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

        session()->flash('message', 'The Product Has been Created Successfully');
        return redirect()->route('admin.products.index');
    }

    public function render()
    {
        return view('livewire.products.create')
            ->layout('components.layouts.admin', ['title' => 'Products']);
    }
}