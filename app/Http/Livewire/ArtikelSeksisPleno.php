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


class ArtikelSeksisPleno extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $search;
   
    public $isOpen=0, $isOpenView=0, $isOpenEdit=0, $isOpenPleno=0, $isOpenRepoB=0;
    public $artikelseksi_id, $nomor_artikel, $nomor_artikel_seksi, $seksi_id, $repo_bId, $peserta_id, $judul, $setelah_sidang_bahas, $Mengingat, $Mempertimbangkan, $Memutuskan, $lampiran=[], $lampiranString, $verified;
   
    public function render()
    {
        $search = '%'.$this->search.'%';
        return view('livewire.sidang_pleno.artikel_seksi.artikel-seksis-pleno',[
            'i' => 1,
            'sidangs'=> Sidang::latest()->first(),
            'seksis'=>Auth::User()->seksi_id,
            'repobs'=>Repo_b::where('status','Belum Terbahas')->where('seksi_id',Auth::user()->seksi_id)->get(),
            'pesertas'=>Peserta_sidang::all(),
            'artikel_seksis' => ArtikelSeksi::join('sidangs','artikel_seksis.sidang_id','=','sidangs.id')
                                            ->join('seksis','artikel_seksis.seksi_id','=','seksis.id')
                                            ->join('repo_bs','artikel_seksis.repob_id','=','repo_bs.id')
                                            ->join('peserta_sidangs','artikel_seksis.peserta_id','=','peserta_sidangs.id')
                                            ->where('artikel_seksis.verified','=','1')
                                            ->where('artikel_seksis.judul','LIKE',$search)
                                            ->select('*','artikel_seksis.id as as_id', 'artikel_seksis.verified as verif', 'artikel_seksis.judul as judulartikel', 'artikel_seksis.seksi_id as s_id')
                                            ->orderBy('artikel_seksis.id','asc')
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

        public function createPleno($id){
            $as = ArtikelSeksi::find($id);
            $this->ar_sek = $as->id;
            $this->repo_bId= $as->repob_id;
            $this->sidang_id= $as->sidang_id;
            $this->seksi_id = $as->seksi_id;
            $this->judul= $as->judul;
            $this->setelah_sidang_bahas= $as->setelah_sidang_bahas;
            $this->Mengingat= $as->Mengingat;
            $this->Mempertimbangkan= $as->Mempertimbangkan;
            $this->Memutuskan= $as->Memutuskan;
            $this->lampiran=[];
            $this->lampiran_final=[]; 
            $this->showModal();
        }

        public function store() {
       
        
            $peserta = Peserta_sidang::where('sidang_id',$this->sidang_id)
                    ->where('user_id',Auth::user()->id)->first();
            ArtikelPleno::create(
            [
                'sidang_id' => $this->sidang_id,
                'seksi_id' => $this->seksi_id,
                'repob_id' => $this->repo_bId,
                'peserta_id' => $peserta->id,
                'judul' => $this->judul,
                'setelah_sidang_bahas' => $this->setelah_sidang_bahas,
                'Mengingat' => $this->Mengingat,
                'Mempertimbangkan' => $this->Mempertimbangkan,
                'Memutuskan' => $this->Memutuskan,
                // 'attachment' => $attachment_final,
            ]);
            
    
            $this->hideModal();
            $this->emit('alert',['type'=>'success','message'=>'Artikel Seksi Berhasil Ditambahkan','title'=>'Berhasil']);     
        }
    



        

        
        
    


}
