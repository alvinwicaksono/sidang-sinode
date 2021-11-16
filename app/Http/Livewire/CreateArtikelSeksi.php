<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

use App\Models\Sidang;
use App\Models\Seksi;
use App\Models\Repo_b;
use App\Models\Peserta_sidang;
use App\Models\artikelSeksi;

use Illuminate\Support\Facades\Auth;

class CreateArtikelSeksi extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $search;
   
    public $isOpen=0, $isOpenView=0, $isOpenEdit=0, $isOpenPleno=0, $isOpenRepoB=0;
    public $artikelseksi_id, $nomor_artikel, $nomor_artikel_seksi, $seksi_id, $repo_bId, $peserta_id, $judul, $setelah_sidang_bahas, $Mengingat, $Mempertimbangkan, $Memutuskan, $lampiran=[], $lampiranString, $verified, $isi_materi;
   

    public function render()
    {
        
        return view('livewire.create-artikel-seksi',[
            'i' => 1,
            'sidangs'=> Sidang::latest()->first(),
            'seksis'=>Auth::User()->seksi_id,
            'repobs'=>Repo_b::where('status','Belum Terbahas')->where('seksi_id',Auth::user()->seksi_id)->get(),
            'pesertas'=>Peserta_sidang::all(),
            'artikel_seksis' => ArtikelSeksi::join('sidangs','artikel_seksis.sidang_id','=','sidangs.id')
            ->join('seksis','artikel_seksis.seksi_id','=','seksis.id')
            ->join('repo_bs','artikel_seksis.repob_id','=','repo_bs.id')
            ->join('peserta_sidangs','artikel_seksis.peserta_id','=','peserta_sidangs.id')
            ->where('artikel_seksis.seksi_id',Auth::User()->seksi_id)
           

            
        ]);

    }
    public function chooseRepoB($id){
       
        if($id != null) {
            $repo_b = Repo_b::find($id);
            $this->repo_bId = $repo_b->id;
            $this->judul = $repo_b->judul_materi;
            
            $this->isi_materi = $repo_b->isi_materi;
            $this->sidang_id = $repo_b->sidang_id;
            $this->seksi_id ='';
            $this->attachment=[]; 
            $this->lampiranString = $repo_b->attachment;
            $this->showRepoB();
        }
    }

    public function showRepoB() {
        $this->isOpenRepoB = true;
    }
    public function hideRepoB() {
        $this->clearCache();
        $this->isOpenRepoB = false;
    }

    public function store()
    {
        dd($setelah_sidang_bahas);
    }

}
