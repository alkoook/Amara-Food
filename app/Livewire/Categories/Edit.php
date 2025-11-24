<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class Edit extends Component
{
    use WithFileUploads;

    protected $layout = 'components.layouts.admin';

    public $category;
    public $name = '';
    public $description = '';
    public $image;
    public $oldImage;
    public $brands = [];
    public $selectedBrands = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:2048',
    ];

    public function mount($id)
    {
        $this->category = Category::findOrFail($id);
        $this->name = $this->category->name;
        $this->description = $this->category->description;
        $this->oldImage = $this->category->image;
        $this->brands = \App\Models\Brand::all();
        $this->selectedBrands = $this->category->brands->pluck('id')->toArray();
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
            
            $imagePath = $this->image->store('categories', 'public');
            
            // Compress image
            $img = Image::make(storage_path('app/public/' . $imagePath));
            $img->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->save(storage_path('app/public/' . $imagePath), 80);
        }

        $this->category->update([
            'name' => $this->name,
            'description' => $this->description,
            'image' => $imagePath,
        ]);

        $this->category->brands()->sync($this->selectedBrands ?? []);

        session()->flash('message', 'تم تحديث الصنف بنجاح');
        return redirect()->route('admin.categories.index');
    }

    public function render()
    {
        return view('livewire.categories.edit');
    }
}

