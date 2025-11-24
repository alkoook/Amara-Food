<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

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
            $imagePath = $this->image->store('categories', 'public');
            
            // Compress image
            $img = Image::make(storage_path('app/public/' . $imagePath));
            $img->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->save(storage_path('app/public/' . $imagePath), 80);
        }

        $category = Category::create([
            'name' => $this->name,
            'description' => $this->description,
            'image' => $imagePath,
        ]);

        if (!empty($this->selectedBrands)) {
            $category->brands()->attach($this->selectedBrands);
        }

        session()->flash('message', 'تم إضافة الصنف بنجاح');
        return redirect()->route('admin.categories.index');
    }

    public function render()
    {
        return view('livewire.categories.create');
    }
}

