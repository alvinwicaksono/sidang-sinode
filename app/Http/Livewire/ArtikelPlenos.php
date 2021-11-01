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
        $sidang_current= Sidang::latest()->first();
        return view('livewire.sidang_pleno.artikel_pleno.artikel-plenos',[
            'i' => 1,
            'sidangs'=> Sidang::latest()->first(),
            'seksis'=>Auth::User()->seksi_id,
            'repobs'=>Repo_b::where('status','Belum Terbahas')->where('seksi_id',Auth::user()->seksi_id)->get(),
            'ar_seksis'=>ArtikelSeksi::where('sidang_id',$sidang_current->id)->where('verified','1')->get(),
            'pesertas'=>Peserta_sidang::all(),
            'artikel_seksis' => ArtikelPleno::join('sidangs','artikel_plenos.sidang_id','=','sidangs.id')
                                            ->join('seksis','artikel_plenos.seksi_id','=','seksis.id')
                                            ->join('repo_bs','artikel_plenos.repob_id','=','repo_bs.id')
                                            ->join('peserta_sidangs','artikel_plenos.peserta_id','=','peserta_sidangs.id')
                                            ->where('artikel_plenos.judul','LIKE',$search)
                                            ->select('*','artikel_plenos.id as ap_id', 'artikel_plenos.verified as verif', 'artikel_plenos.judul as judulartikel', 'artikel_plenos.seksi_id as s_id')
                                            ->orderBy('artikel_plenos.id','asc')
                                            ->paginate(10)
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

    public function chooseArtikelSeksi($id){
        if($id != null) {
            $as = ArtikelSeksi::find($id);
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
            $this->showRepoB();
        }
    }

    
    
    public function verified($id)
    {
        $as = ArtikelPleno::find($id);
        $sidang_current = Sidang::latest()->first();
        $user = Auth::User();

        
        $max= ArtikelPleno::where('sidang_id', $sidang_current->id)
                ->max('nomor_artikel')+1;
               

        ArtikelPleno::where('id',$id)
        ->update([
            'nomor_artikel'=>$max++,
            'verified'=>'1'
        ]);
        $this->emit('alert',['type'=>'success','message'=>'Artikel Berhasil di Verifikasi','title'=>'Berhasil']);
        $this->hideModalView();


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

    public function view($id){
     
        $artikel_pleno = ArtikelPleno::findOrFail($id);
      
        $this->artikelpleno_id = $artikel_pleno->id;
        $this->sidang_id = $artikel_pleno->sidang_id;
        $this->seksi_id = $artikel_pleno->seksi_id;
        $this->nomor_artikel_seksi = $artikel_pleno->nomor_artikel_seksi;
        $this->nomor_artikel = $artikel_pleno->nomor_artikel;
        $this->repo_bId = $artikel_pleno->repob_id;
        $this->judul = $artikel_pleno->judul;
        $this->setelah_sidang_bahas = $artikel_pleno->setelah_sidang_bahas;
        $this->Mengingat = $artikel_pleno->Mengingat;
        $this->Mempertimbangkan = $artikel_pleno->Mempertimbangkan;
        $this->Memutuskan = $artikel_pleno->Memutuskan;
        $this->lampiran = $artikel_pleno->lampiran; 
        $this->showModalView();
    }




}
