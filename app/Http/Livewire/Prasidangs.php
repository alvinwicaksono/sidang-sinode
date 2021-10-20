<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Peserta_sidang;
use App\Models\Repo_a;
use App\Models\Repo_b;
use App\Models\Sidang;

class Prasidangs extends Component
{
    public $isOpen=0;
    public function render()
    {
        $peserta_sidang = Peserta_sidang::count();
        $repo_a = Repo_a::count();
        $repo_b = Repo_b::count();
        $sidang_current = Sidang::latest()->first();
     
        return view('livewire.prasidangs', compact('peserta_sidang','repo_a','repo_b','sidang_current'));
    }

    public function repo_a(){
        $this->redirect('/repo_a');
    }

    public function repo_b(){
        $this->redirect('/repo_b');
    }

    public function peserta_sidang(){
        $this->redirect('/peserta_sidang');
    }

    public function showModal() {
        $this->isOpen = true;
    }
    public function hideModal() {
     
        $this->isOpen = false;
    }

   
}
