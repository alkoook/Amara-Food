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
            // حذف الشعار القديم إذا موجود
            if ($this->oldLogo) {
                $oldPath = base_path('public_html/storage/' . $this->oldLogo);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            // حفظ الشعار الجديد في public_html/storage/brands
            $filename = time() . '_' . $this->logo->getClientOriginalName();
            $logoPath = 'brands/' . $filename;
            $destination = base_path('public_html/storage/' . $logoPath);

            // ضغط الصورة
            $img = Image::read($this->logo->getRealPath());
            $img->scale(width: 800);
            $img->save($destination, 80);
        }

        // تحديث بيانات البراند في الداتابيز
        $this->brand->update([
            'name' => $this->name,
            'description' => $this->description,
            'logo' => $logoPath,
        ]);

        // تحديث الكاتيجوريز المرتبطة
        $this->brand->categories()->sync($this->selectedCategories ?? []);

        session()->flash('message', __('The Brand is Updated Successfully'));
        return redirect()->route('admin.brands.index');
    }

    public function render()
    {
        return view('livewire.brands.edit')
            ->layout('components.layouts.admin', ['title' => 'Brands']);
    }
}