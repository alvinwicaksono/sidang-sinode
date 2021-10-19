<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Repo_a;
use App\Models\Sidang;
use Alert;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Repo_as extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $search;
    public $isOpen=0, $isOpenView=0, $isOpenEdit=0;
    public $repo_aId, $sidang_id='', $judul_materi, $isi_materi, $sumber_materi, $attachment=[], $attachmentString, $status, $address;
    public function render()
    {
        $search = '%'.$this->search. '%';
        return view('livewire.repo_a.repo_as',[
            'i' => 1,
            'sidangs' => Sidang::orderBy('id','asc')->get(),
            'repo_as' => Repo_a::join('sidangs', 'repo_as.sidang_id','=','sidangs.id')
                                ->where('repo_as.judul_materi','LIKE',$search)
                                ->orWhere('repo_as.isi_materi','LIKE',$search)
                                ->orWhere('repo_as.sumber_materi','LIKE',$search)
                                ->orWhere('repo_as.status','LIKE',$search)
                                ->orWhere('sidangs.akta_sidang','LIKE',$search)
                                ->select('*','repo_as.id as ra_id')
                                ->orderBy('repo_as.id', 'desc')
                                ->paginate(5)
        ]);
    }

    private function clearCache() {
        $this->repo_aId='';
        $this->sidang_id='';
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
        $this->isOpen = false;
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
        $this->validate([
            'sidang_id' => 'required',
            'judul_materi' => 'required',
            'isi_materi' => 'required',
        ]);

        $this->validate([
            'attachment.*' => 'image|max:5024', // 5MB Max
        ]);
 
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
        $this->validate([
            'sidang_id' => 'required',
            'judul_materi' => 'required',
            'isi_materi' => 'required',
        ]);

        $this->validate([
            'attachment.*' => 'image|max:5024', // 5MB Max
        ]);
 
        foreach ($this->attachment as $key => $image) {
            $this->attachment[$key] = $image->store('public');
        }
    
        //$this->attachment = json_encode($this->attachment);
        
        $repo_a = Repo_a::find($this->repo_aId);

        $attachment= json_decode($repo_a->attachment,true);

        $attachment = array_push($attachment, $this->attachment);

        $attachment_final = json_encode($attachment);

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
   
}
