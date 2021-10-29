<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Repo_b;
use App\Models\ArtikelSeksi;
use App\Models\Sidang;

use Illuminate\Support\Facades\Auth;


class SidangPlenos extends Component
{
    public $isOpen;
    public function render()
    {
        $user_seksi = Auth::User()->seksi_id;
        $sidang_current = Sidang::latest()->first();
        $artikel_seksi = ArtikelSeksi::where('sidang_id',$sidang_current->id)
                            ->where('verified',1)
                            ->count();
        $repo_b = Repo_b::count();
        
        return view('livewire.sidang_pleno.sidang-plenos',compact('repo_b','artikel_seksi','sidang_current'));
    }

    public function repo_b(){
        $this->redirect('/repo_b');
    }

    public function sidangseksi(){
        $this->redirect('/artikel_seksi');
    }

    public function showModal() {
        $this->isOpen = true;
    }
    public function hideModal() {
     
        $this->isOpen = false;
    }

}
