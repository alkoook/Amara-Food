<?php

namespace App\Livewire\Categories;

use App\Models\Category;
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
    public $brands = [];
    public $selectedBrands = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:2048',
    ];

    public function mount()
    {
        $this->brands = \App\Models\Brand::all();
    }

    public function save()
    {
        $this->validate();

        $imagePath = null;

        if ($this->image) {
            // اسم الصورة لتجنب التكرار
            $filename = time() . '_' . $this->image->getClientOriginalName();
            $imagePath = 'categories/' . $filename;

            // المسار النهائي داخل public_html/storage
            $destination = base_path('public_html/storage/' . $imagePath);

            // ضغط الصورة وحفظها
            $img = Image::read($this->image->getRealPath());
            $img->scale(width: 800);
            $img->save($destination, 80);
        }

        // إنشاء الكاتيجوري في قاعدة البيانات
        $category = Category::create([
            'name' => $this->name,
            'description' => $this->description,
            'image' => $imagePath, // المسار النسبي للعرض
        ]);

        // ربط الكاتيجوري بالبراندات المختارة
        if (!empty($this->selectedBrands)) {
            $category->brands()->attach($this->selectedBrands);
        }

        session()->flash('message', 'The Category Has been Created Successfully');
        return redirect()->route('admin.categories.index');
    }

    public function render()
    {
        return view('livewire.categories.create')
            ->layout('components.layouts.admin', ['title' => 'Categories']);
    }
}