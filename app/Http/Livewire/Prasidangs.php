<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Peserta_sidang;

class Prasidangs extends Component
{
    public function render()
    {
        $peserta_sidang = Peserta_sidang::count();
        return view('livewire.prasidangs', compact('peserta_sidang'));
    }

    public function repoa(){
        $this->redirect('/repoa');
    }

    public function repob(){
        $this->redirect('/repob');
    }

    public function peserta_sidang(){
        $this->redirect('/peserta_sidang');
    }
   
}
