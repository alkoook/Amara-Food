<?php

namespace App\Livewire\Brands;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Laravel\Facades\Image;

class Edit extends Component
{
    use WithFileUploads;

    protected $layout = 'components.layouts.admin';

    public $brand;
    public $name = '';
    public $description = '';
    public $logo;
    public $oldLogo;
    public $categories = [];
    public $selectedCategories = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'logo' => 'nullable|image|max:2048',
    ];

    public function mount($id)
    {
        $this->brand = Brand::findOrFail($id);
        $this->name = $this->brand->name;
        $this->description = $this->brand->description;
        $this->oldLogo = $this->brand->logo;
        $this->categories = \App\Models\Category::all();
        $this->selectedCategories = $this->brand->categories->pluck('id')->toArray();
    }

    public function update()
    {
        $this->validate();

        $logoPath = $this->oldLogo;
        
        if ($this->logo) {
            // Delete old logo
            if ($this->oldLogo) {
                \Storage::disk('public')->delete($this->oldLogo);
            }
            
            $logoPath = $this->logo->store('brands', 'public');
            
            // Compress image
            $img = Image::make(storage_path('app/public/' . $logoPath));
            $img->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->save(storage_path('app/public/' . $logoPath), 80);
        }

        $this->brand->update([
            'name' => $this->name,
            'description' => $this->description,
            'logo' => $logoPath,
        ]);

        $this->brand->categories()->sync($this->selectedCategories ?? []);

        session()->flash('message', 'تم تحديث الشركة بنجاح');
        return redirect()->route('admin.brands.index');
    }

    public function render()
    {
        return view('livewire.brands.edit');
    }
}

