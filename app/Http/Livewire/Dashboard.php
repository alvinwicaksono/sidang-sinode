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
        try{
            //~~~~~~~~~~~~ DETAIL SIDANG ~~~~~~~~~~~~~~~~~//
            $user_seksi = Auth::User()->seksi_id;
            $artikel_seksi = ArtikelSeksi::where('seksi_id',$user_seksi)
                                ->count();
            $sidang_current = Sidang::latest()->first();
            $repo_b = Repo_b::count();
            $peserta_sidang = Peserta_sidang::count();

            //~~~~~~~~~~~~ MODERAMEN SIDANG ~~~~~~~~~~~~~~//
            $moderamen_ketua = Peserta_sidang::join('users','peserta_sidangs.user_id','=','users.id')
                                ->where('peserta_sidangs.sidang_id',$sidang_current->id)
                                ->where('users.role','Ketua')->orderBy('peserta_sidangs.id','asc')->get();
            $moderamen_sekretaris = Peserta_sidang::join('users','peserta_sidangs.user_id','=','users.id')
                                ->where('peserta_sidangs.sidang_id',$sidang_current->id)
                                ->where('role','Sekretaris Moderamen')->orderBy('peserta_sidangs.id','asc')->get();

            return view('dashboard',compact('repo_b','artikel_seksi','sidang_current','peserta_sidang', 'moderamen_ketua', 'moderamen_sekretaris'));
        } catch (\Exception $e) {
            $user_seksi = null;
            $artikel_seksi = null;
            $sidang_current = null;
            $repo_b = null;
            $peserta_sidang = null;

            //~~~~~~~~~~~~ MODERAMEN SIDANG ~~~~~~~~~~~~~~//
            $moderamen_ketua = null;
            $moderamen_sekretaris = null;
            return view('dashboard',compact('repo_b','artikel_seksi','sidang_current','peserta_sidang', 'moderamen_ketua', 'moderamen_sekretaris'));
        }
    }
}
