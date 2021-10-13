<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Users extends Component
{
    public function render()
    {
        return view('livewire.users');
    }

    public function repoa(){
        $this->redirect('/repoa');
   }

   public function repob(){
    $this->redirect('/repob');
}
   
}
