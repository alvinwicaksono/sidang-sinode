<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

use App\Models\Sidang;
use App\Models\Seksi;
use App\Models\Repo_b;
use App\Models\Peserta_sidang;
use App\Models\ArtikelSeksi;
use App\Models\ArtikelPleno;


use Illuminate\Support\Facades\Auth;

class ArtikelPlenos extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $search;

    public $isOpen=0, $isOpenView=0, $isOpenEdit=0, $isOpenPleno=0, $isOpenRepoB=0;
    public $artikelseksi_id, $nomor_artikel, $nomor_artikel_seksi, $seksi_id, $repo_bId, $peserta_id, $judul, $setelah_sidang_bahas, $Mengingat, $Mempertimbangkan, $Memutuskan, $lampiran=[], $lampiranString, $verified;

    public function render()
    {
        $search = '%'.$this->search.'%';
        return view('livewire.sidang_pleno.artikel_pleno.artikel-plenos',[
            'i' => 1,
            'sidangs'=> Sidang::latest()->first(),
            'seksis'=>Auth::User()->seksi_id,
            'repobs'=>Repo_b::where('status','Belum Terbahas')->where('seksi_id',Auth::user()->seksi_id)->get(),
            'pesertas'=>Peserta_sidang::all(),
            'artikel_seksis' => ArtikelPleno::join('sidangs','artikel_plenos.sidang_id','=','sidangs.id')
                                            ->join('seksis','artikel_plenos.seksi_id','=','seksis.id')
                                            ->join('repo_bs','artikel_plenos.repob_id','=','repo_bs.id')
                                            ->join('peserta_sidangs','artikel_plenos.peserta_id','=','peserta_sidangs.id')
                                            ->where('artikel_plenos.seksi_id',Auth::User()->seksi_id)
                                            ->where('artikel_plenos.judul','LIKE',$search)
                                            ->select('*','artikel_plenos.id as as_id', 'artikel_plenos.verified as verif', 'artikel_plenos.judul as judulartikel', 'artikel_plenos.seksi_id as s_id')
                                            ->orderBy('artikel_plenos.id','asc')
                                            ->paginate(5)
        ]);
    }

    private function clearCache() {
        $this->repo_bId='';
        $this->sidang_id='';
        $this->judul='';
        $this->setelah_sidang_bahas='';
        $this->Mengingat='';
        $this->Mempertimbangkan='';
        $this->Memutuskan='';
        $this->lampiran=[];
        $this->lampiran_final=[]; 
    }

    public function showModal() {
        $this->isOpen = true;
        

    }
    public function hideModal() {
        $this->clearCache();
        $this->isOpen = false;
        $this->isOpenRepoB = false;
    }

    public function showRepoB() {
        $this->isOpenRepoB = true;
    }
    public function hideRepo() {
        $this->clearCache();
        $this->isOpenRepoB = false;
    }

    public function showModalEdit() {
        $this->isOpenEdit = true;
    }
    public function hideModalEdit() {
        $this->clearCache();
        $this->isOpenEdit = false;
    }

    public function showModalView() {
        $this->isOpenView = true;
    }
    public function hideModalView() {
        $this->clearCache();
        $this->isOpenView = false;
    }

    public function chooseRepoB($id){
        if($id != null) {
            $repo_b = Repo_b::find($id);
            $this->repo_bId = $repo_b->id;
            $this->judul = $repo_b->judul_materi;
            $this->setelah_sidang_bahas = $repo_b->isi_materi;
            $this->sidang_id = $repo_b->sidang_id;
            $this->seksi_id ='';
            $this->attachment=[]; 
            $this->lampiranString = $repo_b->attachment;
            $this->showRepoB();
        }
    }

    
    
    public function verified($id)
    {
        $as = ArtikelPleno::find($id);
        $sidang_current = Sidang::latest()->first();
        $user = Auth::User();

        
        $max= ArtikelPleno::where('sidang_id', $sidang_current->id)
                ->where('seksi_id', $user->seksi_id)
                ->max('nomor_artikel_seksi')+1;
               

        ArtikelPleno::where('id',$id)
        ->update([
            'nomor_artikel_seksi'=>$max++,
            'verified'=>'1'
        ]);
        $this->emit('alert',['type'=>'success','message'=>'Artikel Berhasil di Verifikasi','title'=>'Berhasil']);
        $this->hideModalView();


    }




}
