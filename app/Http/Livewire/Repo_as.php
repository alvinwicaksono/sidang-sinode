<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Repo_a;
use App\Models\Sidang;
use Alert;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;

class Repo_as extends Component
{
    use WithPagination;
    public $search;
    public $isOpen=0;
    public $isOpenView=0;
    public $repo_aId, $sidang_id, $judul_materi, $isi_materi, $sumber_materi, $attachment, $status;
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

    public function showModal() {
        $this->isOpen = true;
    }

    public function hideModal() {
        $this->isOpen = false;
    }

    public function showModalView() {
        $this->isOpenView = true;
    }

    public function hideModalView() {
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
        $this->attachment = $repo_a->attachment;
        $this->showModal();
    }

    public function store() {
        $this->validate([
            'sidang_id' => 'required',
            'judul_materi' => 'required',
            'isi_materi' => 'required'
        ]);
        
        Repo_a::updateOrCreate(['id' => $this->repo_aId],
        [
            'sidang_id' => $this->sidang_id,
            'judul_materi' => $this->judul_materi,
            'isi_materi' => $this->isi_materi,
            'sumber_materi' => $this->sumber_materi,
            'attachment' => $this->attachment,
            'status' => 'Pra Sidang'
        ]);

        $this->hideModal();
        if ($this->repo_aId)
            $this->emit('alert',['type'=>'success','message'=>'Repo A Berhasil Diupdate','title'=>'Berhasil']);
        else
            $this->emit('alert',['type'=>'success','message'=>'Repo A Berhasil Ditambahkan','title'=>'Berhasil']);
        $this->repo_aId='';
        $this->sidang_id='';
        $this->judul_materi='';
        $this->isi_materi='';
        $this->sumber_materi='';
        $this->attachment='';
        $this->status='';
        Alert::success('Berhasil','Repo A Berhasil ditambahkan');
           
    }

    public function delete($id){
        Repo_a::find($id)->delete();
        $this->emit('alert',['type'=>'success','message'=>'Repo A Berhasil Dihapus','title'=>'Berhasil']);
    }
   
}
