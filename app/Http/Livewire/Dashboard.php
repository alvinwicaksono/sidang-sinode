<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Repo_b;
use App\Models\artikelSeksi;
use App\Models\Sidang;
use App\Models\Peserta_sidang;
use App\Models\User;

use Illuminate\Support\Facades\Auth;


class Dashboard extends Component
{

    public function render()
    {
            //~~~~~~~~~~~~ DETAIL SIDANG ~~~~~~~~~~~~~~~~~//
            $user_seksi = Auth::User()->seksi_id;
            $artikel_seksi = ArtikelSeksi::where('seksi_id',$user_seksi)
                                ->count();
            $sidang_current = Sidang::latest()->first();
            $repo_b = Repo_b::count();
            $peserta_sidang = Peserta_sidang::count();

            //~~~~~~~~~~~~ MODERAMEN SIDANG ~~~~~~~~~~~~~~//
            $moderamen_ketua = User::where('role','Ketua')->orderBy('id','asc')->get();
            $moderamen_sekretaris = User::where('role','Sekretaris Moderamen')->orderBy('id','asc')->get();

            return view('dashboard',compact('repo_b','artikel_seksi','sidang_current','peserta_sidang', 'moderamen_ketua', 'moderamen_sekretaris'));
    }
}
