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

class ArtikelSeksis extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $search;
   
    public $isOpen=0, $isOpenView=0, $isOpenEdit=0, $isOpenPleno=0, $isOpenRepoB=0, $isOpenDelete=0;
    public $artikelseksi_id, $nomor_artikel, $nomor_artikel_seksi, $seksi_id, $repo_bId, $peserta_id, $judul, $setelah_sidang_bahas, $Mengingat, $Mempertimbangkan, $Memutuskan, $lampiran=[], $lampiranString, $verified;
   
    public function render()
    {
        $sidang_current = Sidang::latest()->first();
        $search = '%'.$this->search.'%';
        return view('livewire.artikel_seksi.artikel-seksi',[
            'i' => 1,
            'sidangs'=> Sidang::latest()->first(),
            'seksis'=>Auth::User()->seksi_id,
            'repobs'=>Repo_b::where('status','Belum Terbahas')
                                ->where('sidang_id',$sidang_current->id)
                                ->where('seksi_id',Auth::user()->seksi_id)->get(),
            'pesertas'=>Peserta_sidang::all(),
            'artikel_seksis' => ArtikelSeksi::join('sidangs','artikel_seksis.sidang_id','=','sidangs.id')
                                            ->join('seksis','artikel_seksis.seksi_id','=','seksis.id')
                                            ->join('repo_bs','artikel_seksis.repob_id','=','repo_bs.id')
                                            ->join('peserta_sidangs','artikel_seksis.peserta_id','=','peserta_sidangs.id')
                                            ->where('artikel_seksis.sidang_id',$sidang_current->id)
                                            ->where('artikel_seksis.seksi_id',Auth::User()->seksi_id)
                                            ->where('artikel_seksis.judul','LIKE',$search)
                                            ->select('*','artikel_seksis.id as as_id', 'artikel_seksis.verified as verif', 'artikel_seksis.judul as judulartikel', 'artikel_seksis.seksi_id as s_id')
                                            ->orderBy('artikel_seksis.id','asc')
                                            ->paginate(5)

            
        ]);
    }

    public function createnew(){
       
        return $this->redirect('/createartikelseksi');
            
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


    public function showModalDelete() {
        $this->isOpenDelete = true;
    }
    public function hideModalDelete() {
        $this->clearCache();
        $this->isOpenDelete = false;
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

    //Fungsi untuk menambahkan artikel seksi ke database
    public function store() {
        // $this->validate([
        //     'judul' => 'required',
        //     'attachment.*' => 'image|max:10024' // 5MB Max
        // ]);

        // foreach ($this->attachment as $key => $image) {
        //     $this->attachment[$key] = $image->store('public');
        // }

        // $repo_a = Repo_a::find($this->repoa_id);

        // $attachment= json_decode($repo_a->attachment,true);

        // foreach ($attachment as $lampiran) {
        //     $oldPath = str_replace('public','storage',$lampiran);
        //     $fileExtension = \File::extension($oldPath);

        //     $oldName = str_replace(['public/','.'.$fileExtension],'',$lampiran);
        //     $newName = $oldName.'-'.time().'-newAttachmentRepoB.'.$fileExtension;
        //     $newPathWithName = 'storage/'.$newName;

        //     if (\File::exists($oldPath)) {
        //         \File::copy($oldPath , $newPathWithName);
        //     }
        // }

        // $index = 0;
        // foreach ($attachment as $lampiran) {
        //     $oldPath = str_replace('public','storage',$lampiran);
        //     $fileExtension = \File::extension($oldPath);

        //     $attachment[$index] = str_replace('.'.$fileExtension,'-'.time().'-newAttachmentRepoB.'.$fileExtension,$lampiran);
        //     $index++;
        // }

        // $attachments = array_merge($attachment, $this->attachment);

        // $attachment_final = json_encode($attachments);
        

        $peserta = Peserta_sidang::where('sidang_id',$this->sidang_id)
                ->where('user_id',Auth::user()->id)->first();
        ArtikelSeksi::create(
        [
            'sidang_id' => $this->sidang_id,
            'seksi_id' => Auth::user()->seksi_id,
            'repob_id' => $this->repo_bId,
            'peserta_id' => $peserta->id,
            'judul' => $this->judul,
            'setelah_sidang_bahas' => $this->setelah_sidang_bahas,
            'Mengingat' => $this->Mengingat,
            'Mempertimbangkan' => $this->Mempertimbangkan,
            'Memutuskan' => $this->Memutuskan,
            // 'attachment' => $attachment_final,
        ]);
        Repo_b::where('id',$this->repo_bId)
            ->update([
                'status'=>"Terbahas"
            ]);

        $this->hideModal();
        $this->emit('alert',['type'=>'success','message'=>'Artikel Seksi Berhasil Ditambahkan','title'=>'Berhasil']);     
    }

    public function update() {
       
        $peserta = Peserta_sidang::where('sidang_id',$this->sidang_id)
                ->where('user_id',Auth::user()->id)->first();
        $this->validate([
            'sidang_id' => 'required',
            'seksi_id' => 'required',
            'repo_bId' => 'required',
        ]);

        $artikel_seksi = ArtikelSeksi::find($this->artikelseksi_id);

        $artikel_seksi->update([
            'peserta_id' => $peserta->id,
            'judul' => $this->judul,
            'setelah_sidang_bahas' => $this->setelah_sidang_bahas,
            'Mengingat' => $this->Mengingat,
            'Mempertimbangkan' => $this->Mempertimbangkan,
            'Memutuskan' => $this->Memutuskan,
            
        ]);
       
        $this->hideModalEdit();
        $this->emit('alert',['type'=>'success','message'=>'Artikel Berhasil Diupdate','title'=>'Berhasil']);
    }

    public function view($id){
     
        $artikel_seksi = ArtikelSeksi::findOrFail($id);
       
        $this->artikelseksi_id = $artikel_seksi->id;
        $this->sidang_id = $artikel_seksi->sidang_id;
        $this->seksi_id = $artikel_seksi->seksi_id;
        $this->nomor_artikel_seksi = $artikel_seksi->nomor_artikel_seksi;
        $this->repo_bId = $artikel_seksi->repob_id;
        $this->judul = $artikel_seksi->judul;
        $this->setelah_sidang_bahas = $artikel_seksi->setelah_sidang_bahas;
        $this->Mengingat = $artikel_seksi->Mengingat;
        $this->Mempertimbangkan = $artikel_seksi->Mempertimbangkan;
        $this->Memutuskan = $artikel_seksi->Memutuskan;
        $this->lampiran = $artikel_seksi->lampiran; 
        $this->showModalView();
    }

    public function edit($id)
    {
        $artikel_seksi = ArtikelSeksi::findOrFail($id);
       
        $this->artikelseksi_id = $artikel_seksi->id;
        $this->sidang_id = $artikel_seksi->sidang_id;
        $this->seksi_id = $artikel_seksi->seksi_id;
        $this->nomor_artikel_seksi = $artikel_seksi->nomor_artikel_seksi;
        $this->repo_bId = $artikel_seksi->repob_id;
        $this->judul = $artikel_seksi->judul;
        $this->setelah_sidang_bahas = $artikel_seksi->setelah_sidang_bahas;
        $this->Mengingat = $artikel_seksi->Mengingat;
        $this->Mempertimbangkan = $artikel_seksi->Mempertimbangkan;
        $this->Memutuskan = $artikel_seksi->Memutuskan;
        $this->lampiran = $artikel_seksi->lampiran; 
        $this->showModalEdit();
    }

    public function remove($id){
        $artikel_seksi = ArtikelSeksi::find($id);

        $this->artikelseksi_id = $id;
        $this->judul = $artikel_seksi->judul;
        $this->repo_bId = $artikel_seksi->repob_id;

        $this->showModalDelete();
    }

    public function delete(){
        $artikel_seksi = ArtikelSeksi::find($this->artikelseksi_id);
        $repo_b = Repo_b::find($this->repo_bId);

        $artikel_seksi->delete();
        
        $repo_b->update([
            'status' => 'Belum Terbahas'
        ]);


        $this->clearCache();
        $this->hideModalDelete();
        $this->emit('alert',['type'=>'success','message'=>'Artikel Berhasil Dihapus','title'=>'Berhasil']);
    }


    public function verified($id)
    {
        $as = ArtikelSeksi::find($id);
        $sidang_current = Sidang::latest()->first();
        $user = Auth::User();

        
        $max= ArtikelSeksi::where('sidang_id', $sidang_current->id)
                ->where('seksi_id', $user->seksi_id)
                ->max('nomor_artikel_seksi')+1;
               

        ArtikelSeksi::where('id',$id)
        ->update([
            'nomor_artikel_seksi'=>$max++,
            'verified'=>'1'
        ]);
        $this->emit('alert',['type'=>'success','message'=>'Artikel Berhasil di Verifikasi','title'=>'Berhasil']);
        $this->hideModalView();


    }

}
