<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;

class Profile extends Component
{
    
    protected $layout = 'components.front-layout';
    public function render()
    {
        $user=auth()->user();
        return view('livewire.profile',compact('user'))->layout('components.layouts.admin', ['title' => 'Profile']);
    }
}
