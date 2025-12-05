<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Laravel\Facades\Image;

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
            // حذف الصورة القديمة إذا موجودة
            if ($this->oldImage) {
                $oldPath = base_path('public_html/storage/' . $this->oldImage);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            // حفظ الصورة الجديدة في public_html/storage/categories
            $filename = time() . '_' . $this->image->getClientOriginalName();
            $imagePath = 'categories/' . $filename;
            $destination = base_path('public_html/storage/' . $imagePath);

            // ضغط الصورة
            $img = Image::read($this->image->getRealPath());
            $img->scale(width: 800);
            $img->save($destination, 80);
        }

        // تحديث بيانات الكاتيجوري في الداتابيز
        $this->category->update([
            'name' => $this->name,
            'description' => $this->description,
            'image' => $imagePath,
        ]);

        // تحديث البراندات المرتبطة
        $this->category->brands()->sync($this->selectedBrands ?? []);

        session()->flash('message', __('The Category is Updated Successfully'));
        return redirect()->route('admin.categories.index');
    }

    public function render()
    {
        return view('livewire.categories.edit')
            ->layout('components.layouts.admin', ['title' => 'Categories']);
    }
}