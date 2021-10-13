<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Prasidangs extends Component
{
    public function render()
    {
        return view('livewire.prasidangs');
    }

    public function repoa(){
        $this->redirect('/repoa');
   }

   public function repob(){
    $this->redirect('/repob');
}
   
}
