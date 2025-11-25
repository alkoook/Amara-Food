<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;
// في ملف Admin\Dashboard\Index.php
class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard.index')
            // استخدم التخطيط الصحيح
            ->layout('components.layouts.admin', ['title' => 'الرئيسية']);
    }
}