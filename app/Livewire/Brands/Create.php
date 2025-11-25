<?php

namespace App\Livewire\Brands;

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
    public $logo;
    public $categories = [];
    public $selectedCategories = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'logo' => 'nullable|image|max:20000',
    ];

    public function mount()
    {
        $this->categories = \App\Models\Category::all();
    }

    public function save()
    {
        $this->validate();

        $logoPath = null;
        if ($this->logo) {
            $logoPath = $this->logo->store('brands', 'public');

            // Compress image
            $img = Image::read(storage_path('app/public/' . $logoPath));
            $img->scale(width: 800);
            $img->save(storage_path('app/public/' . $logoPath), 80);
        }

        $brand = Brand::create([
            'name' => $this->name,
            'description' => $this->description,
            'logo' => $logoPath,
        ]);

        if (!empty($this->selectedCategories)) {
            $brand->categories()->attach($this->selectedCategories);
        }

        session()->flash('message', 'تم إضافة الشركة بنجاح');
        return redirect()->route('admin.brands.index');
    }

    public function render()
    {
        return view('livewire.brands.create')->layout('components.layouts.admin', ['title' => 'الشركات']);
    }
}
