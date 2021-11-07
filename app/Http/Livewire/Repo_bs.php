<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Repo_a;
use App\Models\Repo_b;
use App\Models\Sidang; 
use App\Models\Seksi;
use Alert;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Repo_bs extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $search;
    public $isOpen=0, $isOpenRepoA=0, $isOpenEdit=0, $isOpenView=0, $isOpenDelete=0;
    public $repo_bId, $sidang_id='', $repoa_id='', $seksi_id='', $judul_materi, $isi_materi, $attachment=[], $attachmentString, $status;
    public function render()
    {
        $search = '%'.$this->search. '%';
        $sidang =  Sidang::latest()->first();
        return view('livewire.repo_b.repo_bs',[
            'i' => 1,
            'sidangs' => $sidang,
            'seksis' => Seksi::all(),
            'repo_as' => Repo_a::where('sidang_id', $sidang->id)->get(),
            'repo_bs' => Repo_b::join('sidangs', 'repo_bs.sidang_id','=','sidangs.id')
                                ->join('seksis', 'repo_bs.seksi_id','=','seksis.id')
                                ->join('repo_as', 'repo_bs.repoa_id','=','repo_as.id')
                                ->where('repo_as.sidang_id', $sidang->id)
                                ->where(function($query) use ($search){
                                    $query->where('repo_bs.judul_materi','LIKE',$search)
                                            ->orWhere('repo_bs.isi_materi','LIKE',$search)
                                            ->orWhere('repo_bs.status','LIKE',$search)
                                            ->orWhere('sidangs.akta_sidang','LIKE',$search)
                                            ->orWhere('seksis.nama','LIKE',$search);
                                })
                                ->select('*','repo_bs.id as rb_id', 'repo_bs.judul_materi as judul', 'repo_bs.status as stat')
                                ->orderBy('repo_bs.id', 'asc')
                                ->paginate(10)
        ]);
    }

    private function clearCache() {
        $this->repo_aId='';
        $this->sidang_id='';
        $this->repoa_id='';
        $this->seksi_id='';
        $this->judul_materi='';
        $this->isi_materi='';
        $this->status=''; 
        $this->attachment=[];
        $this->attachment_final=[]; 
    }

    public function showModal() {
        $this->isOpen = true;
    }
    public function hideModal() {
        $this->clearCache();
        $this->resetValidation();
        $this->hideRepoA();
        $this->isOpen = false;
    }

    public function showRepoA() {
        $this->resetValidation();
        $this->isOpenRepoA = true;
    }
    public function hideRepoA() {
        $this->clearCache();
        $this->resetValidation();
        $this->isOpenRepoA = false;
    }

    public function showModalEdit() {
        $this->isOpenEdit = true;
    }
    public function hideModalEdit() {
        $this->clearCache();
        $this->resetValidation();
        $this->isOpenEdit = false;
    }

    public function showModalView() {
        $this->isOpenView = true;
    }
    public function hideModalView() {
        $this->clearCache();
        $this->resetValidation();
        $this->isOpenView = false;
    }

    public function showModalDelete() {
        $this->isOpenDelete = true;
    }
    public function hideModalDelete() {
        $this->clearCache();
        $this->isOpenDelete = false;
    }

    public function chooseRepoA($id){
        if($id != null) {
            $repo_a = Repo_a::find($id);
            $sidangs = Sidang::find($repo_a->sidang_id);

            $this->akta_sidang = $sidangs->akta_sidang;
            $this->status_sidang = $sidangs->status;

            $this->judul_materi = $repo_a->judul_materi;
            $this->isi_materi = $repo_a->isi_materi;
            $this->sidang_id = $repo_a->sidang_id;
            $this->seksi_id ='';
            $this->attachment=[]; 
            $this->attachmentString = $repo_a->attachment;
            $this->showRepoA();
        }
    }
    public function chooseEditRepoA($id){
        $repo_a = Repo_a::find($id);
        $this->judul_materi = $repo_a->judul_materi;
        $this->isi_materi = $repo_a->isi_materi;
        $this->attachment=[]; 
        $this->attachmentString = $repo_a->attachment;
    }

    public function view($id){
        $repo_b = Repo_b::findOrFail($id);
        $repo_as = Repo_b::join('repo_as', 'repo_bs.repoa_id','=','repo_as.id')
                        ->findOrFail($id);
        $sidangs = Repo_b::join('sidangs', 'repo_bs.sidang_id','=','sidangs.id')
                        ->findOrFail($id);
        $seksis = Repo_b::join('seksis', 'repo_bs.seksi_id','=','seksis.id')
                        ->findOrFail($id);

        $this->repo_bId = $id;
        $this->judul_materi = $repo_b->judul_materi;
        $this->isi_materi = $repo_b->isi_materi;
        $this->sumber_materi = $repo_b->sumber_materi;
        $this->attachment = $repo_b->attachment;
        $this->status = $repo_b->status;

        $this->repo_a = $repo_as->judul_materi;
        $this->akta_sidang = $sidangs->akta_sidang;
        $this->status_sidang = $sidangs->status;
        $this->seksi = $seksis->nama;
                            
        
        $this->showModalView();
    }

    public function edit($id){
        $repo_b = Repo_b::findOrFail($id);
        $repo_as = Repo_b::join('repo_as', 'repo_bs.repoa_id','=','repo_as.id')
                        ->findOrFail($id);

        $sidangs = Sidang::find($repo_b->sidang_id);

        $this->akta_sidang = $sidangs->akta_sidang;
        $this->status_sidang = $sidangs->status;

        $this->repo_bId = $id;
        $this->sidang_id = $repo_b->sidang_id;
        $this->seksi_id = $repo_b->seksi_id;
        $this->repoa_id = $repo_b->repoa_id;
        $this->judul_materi = $repo_b->judul_materi;
        $this->isi_materi = $repo_b->isi_materi;
        
        $this->attachment=[]; 
        $this->attachmentString = $repo_b->attachment;

        $this->repo_a = $repo_as->judul_materi;

        $this->showModalEdit();
    }

    public function removeImg($index)
    {
        array_splice($this->attachment, $index, 1);
    }

    public function store() {

        $validatedData = $this->validate(
            [
                'judul_materi' => 'required',
                'isi_materi' => 'required',
                'repoa_id' => 'required',
                'seksi_id' => 'required',
                'attachment' => 'max:10024'
            ],
            [
                'judul_materi.required' => 'Form :attribute tidak boleh kosong',
                'isi_materi.required' => 'Form :attribute tidak boleh kosong',
                'repoa_id.required' => 'Form :attribute tidak boleh kosong',
                'seksi_id.required' => 'Form :attribute tidak boleh kosong',
                'attachment.max' => 'Form :attribute maksimal total semua gambar 10Mb'
            ],
            [
                'judul_materi' => 'Judul Materi',
                'isi_materi' => 'Isi Materi',
                'repoa_id' => 'Repositori A',
                'seksi_id' => 'Seksi',
                'attachment' => 'Lampiran'
            ]
        ); 

        foreach ($this->attachment as $key => $image) {
            $this->attachment[$key] = $image->store('public');
        }

        $repo_a = Repo_a::find($this->repoa_id);

        $attachment= json_decode($repo_a->attachment,true);

        foreach ($attachment as $lampiran) {
            $oldPath = str_replace('public','storage',$lampiran);
            $fileExtension = \File::extension($oldPath);

            $oldName = str_replace(['public/','.'.$fileExtension],'',$lampiran);
            $newName = $oldName.'-'.time().'-newAttachmentRepoB.'.$fileExtension;
            $newPathWithName = 'storage/'.$newName;

            if (\File::exists($oldPath)) {
                \File::copy($oldPath , $newPathWithName);
            }
        }

        $index = 0;
        foreach ($attachment as $lampiran) {
            $oldPath = str_replace('public','storage',$lampiran);
            $fileExtension = \File::extension($oldPath);

            $attachment[$index] = str_replace('.'.$fileExtension,'-'.time().'-newAttachmentRepoB.'.$fileExtension,$lampiran);
            $index++;
        }

        $attachments = array_merge($attachment, $this->attachment);

        $attachment_final = json_encode($attachments);
        
        Repo_b::create(
        [
            'sidang_id' => $this->sidang_id,
            'seksi_id' => $this->seksi_id,
            'repoa_id' => $this->repoa_id,
            'judul_materi' => $this->judul_materi,
            'isi_materi' => $this->isi_materi,
            'attachment' => $attachment_final,
            'status' => 'Belum Terbahas'
        ]);

        $count = $repo_a->count + 1;

        $repo_a->update([
            'status' => 'Terbahas',
            'count' => $count
        ]);

        $this->hideModal();
        $this->hideRepoA();
        $this->emit('alert',['type'=>'success','message'=>'Repositori B Berhasil Ditambahkan','title'=>'Berhasil']);     
    }

    public function update() {
        $validatedData = $this->validate(
            [
                'judul_materi' => 'required',
                'isi_materi' => 'required',
                'repoa_id' => 'required',
                'seksi_id' => 'required',
                'attachment' => 'max:10024'
            ],
            [
                'judul_materi.required' => 'Form :attribute tidak boleh kosong',
                'isi_materi.required' => 'Form :attribute tidak boleh kosong',
                'repoa_id.required' => 'Form :attribute tidak boleh kosong',
                'seksi_id.required' => 'Form :attribute tidak boleh kosong',
                'attachment.max' => 'Form :attribute maksimal total semua gambar 10Mb'
            ],
            [
                'judul_materi' => 'Judul Materi',
                'isi_materi' => 'Isi Materi',
                'repoa_id' => 'Repositori A',
                'seksi_id' => 'Seksi',
                'attachment' => 'Lampiran'
            ]
        ); 

        foreach ($this->attachment as $key => $image) {
            $this->attachment[$key] = $image->store('public');
        }

        $repo_b = Repo_b::find($this->repo_bId);

        $attachment= json_decode($repo_b->attachment,true);

        $attachments = array_merge($attachment, $this->attachment);
            
        $attachment_final = json_encode($attachments);

        $repo_b->update([
            'judul_materi' => $this->judul_materi,
            'isi_materi' => $this->isi_materi,
            'repoa_id' => $this->repoa_id,
            'seksi_id' => $this->seksi_id,
            'attachment' => $attachment_final
        ]);
       
        $this->hideModalEdit();
        $this->emit('alert',['type'=>'success','message'=>'Repositori B Berhasil Diupdate','title'=>'Berhasil']);
    }

    public function remove($id, $repo_aId){
        $repo_b = Repo_b::find($id);

        $this->repo_bId = $id;
        $this->repo_aId = $repo_aId;
        $this->judul_materi = $repo_b->judul_materi;

        $this->showModalDelete();
    }

    public function delete(){
        $repo_b = Repo_b::find($this->repo_bId);

        $repo_a = Repo_a::find($this->repo_aId);

        foreach (json_decode($repo_b->attachment) as $lampiran) {
            if(\File::exists(str_replace('public','storage',$lampiran))) {
                \File::delete(str_replace('public','storage',$lampiran));
            }
        }

        $repo_b->delete();

        $count = $repo_a->count - 1;

        if($count == 0){
            $status = 'Belum Terbahas';
        } else {
            $status = 'Terbahas';
        }

        $repo_a->update([
            'status' => $status,
            'count' => $count
        ]);

        $this->clearCache();
        $this->hideModalDelete();
        $this->emit('alert',['type'=>'success','message'=>'Repositori B Berhasil Dihapus','title'=>'Berhasil']);
    }

    public function deleteStorage($id, $path, $index){
        $repo_b = Repo_b::find($id);

        $attachment= json_decode($repo_b->attachment,true);

        if (($key = array_search($path, $attachment)) !== false) {
            unset($attachment[$key]);
            $attachment = array_values($attachment);
        }
        $attachment_final = json_encode($attachment);
                
        $repo_b->update([
            'attachment' => $attachment_final
        ]);

        if(\File::exists(str_replace('public','storage',$path))) {
            \File::delete(str_replace('public','storage',$path));
        }

        $this->clearCache();
    }
   
}
