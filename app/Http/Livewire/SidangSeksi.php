<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Repo_b;

class SidangSeksi extends Component
{
    public function render()
    {
        $repo_b = Repo_b::count();
        return view('livewire.sidang-seksi',compact('repo_b'));
    }

    public function repo_b(){
        $this->redirect('/repo_b');
    }

    public function sidangseksi(){
        $this->redirect('/artikel_seksi');
    }

}
