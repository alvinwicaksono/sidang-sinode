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

class Repo_as extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $search;
    public $isOpen=0, $isOpenView=0, $isOpenEdit=0, $isOpenRepoB;
    public $repo_aId, $sidang_id='', $judul_materi, $isi_materi, $sumber_materi, $attachment=[], $attachmentString, $status;
    public function render()
    {
        $search = '%'.$this->search. '%';
        return view('livewire.repo_a.repo_as',[
            'i' => 1,
            'sidangs' => Sidang::all(),
            'seksis' => Seksi::all(),
            'repo_as' => Repo_a::join('sidangs', 'repo_as.sidang_id','=','sidangs.id')
                                ->where('repo_as.judul_materi','LIKE',$search)
                                ->orWhere('repo_as.isi_materi','LIKE',$search)
                                ->orWhere('repo_as.sumber_materi','LIKE',$search)
                                ->orWhere('repo_as.status','LIKE',$search)
                                ->orWhere('sidangs.akta_sidang','LIKE',$search)
                                ->select('*','repo_as.id as ra_id', 'repo_as.judul_materi as judul', 'repo_as.status as stat')
                                ->orderBy('repo_as.id', 'desc')
                                ->paginate(5)
        ]);
    }

    private function clearCache() {
        $this->repo_aId='';
        $this->sidang_id='';
        $this->repoa_id='';
        $this->seksi_id='';
        $this->judul_materi='';
        $this->isi_materi='';
        $this->sumber_materi='';
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
        $this->isOpen = false;
    }

    public function showModalEdit() {
        $this->isOpenEdit = true;
    }
    public function hideModalEdit() {
        $this->clearCache();
        $this->resetValidation();
        $this->isOpenEdit = false;
    }

    public function showModalRepoB() {
        $this->isOpenRepoB = true;
    }
    public function hideModalRepoB() {
        $this->clearCache();
        $this->resetValidation();
        $this->isOpenRepoB = false;
    }

    public function showModalView() {
        $this->isOpenView = true;
    }
    public function hideModalView() {
        $this->clearCache();
        $this->resetValidation();
        $this->isOpenView = false;
    }

    public function view($id){
        $repo_a = Repo_a::findOrFail($id);
        $sidangs = Repo_a::join('sidangs', 'repo_as.sidang_id','=','sidangs.id')
                        ->findOrFail($id);

        $this->repo_aId = $id;
        $this->judul_materi = $repo_a->judul_materi;
        $this->isi_materi = $repo_a->isi_materi;
        $this->sumber_materi = $repo_a->sumber_materi;
        $this->attachment = $repo_a->attachment;
        $this->status = $repo_a->status;

        $this->sidang = $sidangs->akta_sidang;
                            
        $this->showModalView();
    }

    public function edit($id){
        $repo_a = Repo_a::findOrFail($id);
        $this->repo_aId = $id;
        $this->sidang_id = $repo_a->sidang_id;
        $this->judul_materi = $repo_a->judul_materi;
        $this->isi_materi = $repo_a->isi_materi;
        $this->sumber_materi = $repo_a->sumber_materi;
    
        $this->attachment=[]; 
        $this->attachmentString = $repo_a->attachment;

        $this->showModalEdit();
    }

    public function removeImg($index)
    {
        array_splice($this->attachment, $index, 1);
    }

    public function store() { 

        $validatedData = $this->validate(
            [
                'sidang_id' => 'required',
                'judul_materi' => 'required',
                'attachment' => 'max:10024'
            ],
            [
                'sidang_id.required' => 'Form :attribute tidak boleh kosong',
                'judul_materi.required' => 'Form :attribute tidak boleh kosong',
                'attachment.max' => 'Form :attribute minimal ukuran total semua gambar 10Mb'
            ],
            [
                'sidang_id' => 'Sidang',
                'judul_materi' => 'Judul Materi',
                'attachment' => 'Lampiran',
            ]
        ); 
 
        foreach ($this->attachment as $key => $image) {
            $this->attachment[$key] = $image->store('public');
        }
    
        $this->attachment = json_encode($this->attachment);
        
        Repo_a::create(
        [
            'sidang_id' => $this->sidang_id,
            'judul_materi' => $this->judul_materi,
            'isi_materi' => $this->isi_materi,
            'sumber_materi' => $this->sumber_materi,
            'attachment' => $this->attachment,
            'status' => 'Pra Sidang'
        ]);

        $this->hideModal();
        $this->emit('alert',['type'=>'success','message'=>'Repo A Berhasil Ditambahkan','title'=>'Berhasil']);    
    }

    public function update() {
        $validatedData = $this->validate(
            [
                'sidang_id' => 'required',
                'judul_materi' => 'required',
                'attachment' => 'max:10024'
            ],
            [
                'sidang_id.required' => 'Form :attribute tidak boleh kosong',
                'judul_materi.required' => 'Form :attribute tidak boleh kosong',
                'attachment.max' => 'Form :attribute minimal ukuran total semua gambar 10Mb'
            ],
            [
                'sidang_id' => 'Sidang',
                'judul_materi' => 'Judul Materi',
                'attachment' => 'Lampiran',
            ]
        );
 
        foreach ($this->attachment as $key => $image) {
            $this->attachment[$key] = $image->store('public');
        }
            
        $repo_a = Repo_a::find($this->repo_aId);

        $attachment= json_decode($repo_a->attachment,true);

        $attachments = array_merge($attachment, $this->attachment);

        $attachment_final = json_encode($attachments);

        $repo_a->update([
            'sidang_id' => $this->sidang_id,
            'judul_materi' => $this->judul_materi,
            'isi_materi' => $this->isi_materi,
            'sumber_materi' => $this->sumber_materi,
            'attachment' => $attachment_final
        ]);
       
        $this->hideModalEdit();
        $this->emit('alert',['type'=>'success','message'=>'Repo A Berhasil Diupdate','title'=>'Berhasil']);
    }

    public function delete($id){
        $repo_a = Repo_a::find($id);

        foreach (json_decode($repo_a->attachment) as $lampiran) {
            if(\File::exists(str_replace('public','storage',$lampiran))) {
                \File::delete(str_replace('public','storage',$lampiran));
            }
        }

        $repo_a->delete();

        $this->clearCache();
        $this->emit('alert',['type'=>'success','message'=>'Repo A Berhasil Dihapus','title'=>'Berhasil']);
    }

    public function deleteStorage($id, $path, $index){
        $repo_a = Repo_a::find($id);

        $attachment= json_decode($repo_a->attachment,true);

        if (($key = array_search($path, $attachment)) !== false) {
            unset($attachment[$key]);
            $attachment = array_values($attachment);
        }
        $attachment_final = json_encode($attachment);
                
        $repo_a->update([
            'attachment' => $attachment_final
        ]);

        if(\File::exists(str_replace('public','storage',$path))) {
            \File::delete(str_replace('public','storage',$path));
        }

        $this->clearCache();
    }


    //~~~~~~~~~~~~~~~~~~~~~~~~ REPO B ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

    public function createRepoB($id){
        $repo_a = Repo_a::find($id);

        $this->repoa_id = $id;
        $this->judul_repo_a = $repo_a->judul_materi;
        $this->sidang_id = $repo_a->sidang_id;
        $this->judul_materi = $repo_a->judul_materi;
        $this->isi_materi = $repo_a->isi_materi;
    
        $this->seksi_id ='';
        $this->attachment=[]; 
        $this->attachmentString = $repo_a->attachment;

        $this->showModalRepoB();
    }

    public function storeRepoB() {
        $validatedData = $this->validate(
            [
                'sidang_id' => 'required',
                'judul_materi' => 'required',
                'isi_materi' => 'required',
                'repoa_id' => 'required',
                'seksi_id' => 'required',
                'attachment' => 'max:10024'
            ],
            [
                'sidang_id.required' => 'Form :attribute tidak boleh kosong',
                'judul_materi.required' => 'Form :attribute tidak boleh kosong',
                'isi_materi.required' => 'Form :attribute tidak boleh kosong',
                'repoa_id.required' => 'Form :attribute tidak boleh kosong',
                'seksi_id.required' => 'Form :attribute tidak boleh kosong',
                'attachment.max' => 'Form :attribute maksimal total semua gambar 10Mb'
            ],
            [
                'sidang_id' => 'Sidang',
                'judul_materi' => 'Judul Materi',
                'isi_materi' => 'Isi Materi',
                'repoa_id' => 'Repo A',
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

        $this->hideModalRepoB();
        $this->emit('alert',['type'=>'success','message'=>'Repo B Berhasil Ditambahkan','title'=>'Berhasil']);     
    }
   
}
