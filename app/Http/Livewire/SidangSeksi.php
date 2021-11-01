<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Repo_b;
use App\Models\artikelSeksi;
use App\Models\Sidang;
use App\Models\Peserta_sidang;

use Illuminate\Support\Facades\Auth;


class SidangSeksi extends Component
{
    public function render()
    {
        $user_seksi = Auth::User()->seksi_id;
        $artikel_seksi = ArtikelSeksi::where('seksi_id',$user_seksi)
                            ->count();
        $repo_b = Repo_b::count();
        $peserta_sidang = Peserta_sidang::count();
        $sidang_current = Sidang::latest()->first();

        
        return view('livewire.sidang-seksi',compact('repo_b','artikel_seksi','sidang_current','peserta_sidang'));
    }

    public function repo_b(){
        $this->redirect('/repo_b');
    }

    public function sidangseksi(){
        $this->redirect('/artikel_seksi');
    }
    
    public function peserta_sidang(){
        $this->redirect('/peserta_sidang');
    }
}
