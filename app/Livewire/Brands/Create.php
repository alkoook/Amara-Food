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
            // اسم الملف لتجنب التكرار
            $filename = time() . '_' . $this->logo->getClientOriginalName();
            $logoPath = 'brands/' . $filename;

            // المسار النهائي داخل public_html/storage
            $destination = base_path('public_html/storage/' . $logoPath);

            // ضغط الصورة
            $img = Image::read($this->logo->getRealPath());
            $img->scale(width: 800);
            $img->save($destination, 80);
        }

        // إنشاء البراند في قاعدة البيانات
        $brand = Brand::create([
            'name' => $this->name,
            'description' => $this->description,
            'logo' => $logoPath,
        ]);

        // ربط البراند بالكاتيجوريز المختارة
        if (!empty($this->selectedCategories)) {
            $brand->categories()->attach($this->selectedCategories);
        }

        session()->flash('message', 'The Brand Has been Created Successfully');
        return redirect()->route('admin.brands.index');
    }

    public function render()
    {
        return view('livewire.brands.create')
            ->layout('components.layouts.admin', ['title' => 'Brands']);
    }
}