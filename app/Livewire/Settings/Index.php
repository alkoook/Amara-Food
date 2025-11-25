<?php

namespace App\Livewire\Settings;

use App\Models\Setting;
use Livewire\Component;

class Index extends Component
{
    protected $layout = 'components.layouts.admin';

    public $companyOverview = '';
    public $facebook = '';
    public $twitter = '';
    public $instagram = '';
    public $whatsapp = '';
    public $email = '';
    public $phone = '';

    public function mount()
    {
        $this->companyOverview = Setting::getValue('company_overview', '');
        $this->facebook = Setting::getValue('facebook', '');
        $this->twitter = Setting::getValue('twitter', '');
        $this->instagram = Setting::getValue('instagram', '');
        $this->whatsapp = Setting::getValue('whatsapp', '');
        $this->email = Setting::getValue('email', '');
        $this->phone = Setting::getValue('phone', '');
    }

    public function save()
    {
        Setting::setValue('company_overview', $this->companyOverview);
        Setting::setValue('facebook', $this->facebook);
        Setting::setValue('twitter', $this->twitter);
        Setting::setValue('instagram', $this->instagram);
        Setting::setValue('whatsapp', $this->whatsapp);
        Setting::setValue('email', $this->email);
        Setting::setValue('phone', $this->phone);

        session()->flash('message', 'تم حفظ الإعدادات بنجاح');
        return redirect()->route('admin.dashboard');
    }

    public function render()
    {
        return view('livewire.settings.index')->layout('components.layouts.admin', ['title' => 'الإعدادات']);
    }
}