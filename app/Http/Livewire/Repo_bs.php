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

class Repo_bs extends Component
{
    use WithPagination;
    public $search;
    public $isOpen=0;
    public $repo_bId, $sidang_id, $repoa_id, $seksi_id, $judul_materi, $isi_materi, $attachment, $status;
    public function render()
    {
        $search = '%'.$this->search. '%';
        return view('livewire.repo_b.repo_bs',[
            'i' => 1,
            'sidangs' => Sidang::orderBy('id','asc')->get(),
            'seksis' => Seksi::orderBy('id','asc')->get(),
            'repo_as' => Repo_a::orderBy('id','asc')->get(),
            'repo_bs' => Repo_b::join('sidangs', 'repo_bs.sidang_id','=','sidangs.id')
                                ->join('seksis', 'repo_bs.seksi_id','=','seksis.id')
                                ->join('repo_as', 'repo_bs.repoa_id','=','repo_as.id')
                                ->where('repo_bs.judul_materi','LIKE',$search)
                                ->orWhere('repo_bs.isi_materi','LIKE',$search)
                                ->orWhere('repo_bs.status','LIKE',$search)
                                ->orWhere('sidangs.akta_sidang','LIKE',$search)
                                ->orWhere('seksis.nama','LIKE',$search)
                                ->orWhere('repo_as.judul_materi','LIKE',$search)
                                ->select('*','repo_bs.id as rb_id', 'repo_bs.status as stat')
                                ->orderBy('repo_bs.id', 'desc')
                                ->paginate(5)
        ]);
    }

    public function showModal() {
        $this->isOpen = true;
    }

    public function hideModal() {
        $this->isOpen = false;
    }

    public function edit($id){
        $repo_b = Repo_b::findOrFail($id);
        $this->repo_bId = $id;
        $this->sidang_id = $repo_b->sidang_id;
        $this->seksi_id = $repo_b->seksi_id;
        $this->repoa_id = $repo_b->repoa_id;
        $this->judul_materi = $repo_b->judul_materi;
        $this->isi_materi = $repo_b->isi_materi;
        $this->attachment = $repo_b->attachment;
        $this->showModal();
    }

    public function store() {
        $this->validate([
            'sidang_id' => 'required',
            'judul_materi' => 'required',
            'isi_materi' => 'required',
            'repoa_id' => 'required',
            'seksi_id' => 'required'
        ]);
        
        Repo_b::updateOrCreate(['id' => $this->repo_bId],
        [
            'sidang_id' => $this->sidang_id,
            'seksi_id' => $this->seksi_id,
            'repoa_id' => $this->repoa_id,
            'judul_materi' => $this->judul_materi,
            'isi_materi' => $this->isi_materi,
            'attachment' => $this->attachment,
            'status' => 'Belum Terbahas'
        ]);

        $this->hideModal();
        if ($this->repo_bId)
            $this->emit('alert',['type'=>'success','message'=>'Repo B Berhasil Diupdate','title'=>'Berhasil']);
        else
            $this->emit('alert',['type'=>'success','message'=>'Repo B Berhasil Ditambahkan','title'=>'Berhasil']);
        $this->repo_bId='';
        $this->sidang_id='';
        $this->seksi_id='';
        $this->repoa_id='';
        $this->judul_materi='';
        $this->isi_materi='';
        $this->attachment='';
        $this->status='';
        Alert::success('Berhasil','Repo B Berhasil ditambahkan');
           
    }

    public function delete($id){
        Repo_b::find($id)->delete();
        $this->emit('alert',['type'=>'success','message'=>'Repo B Berhasil Dihapus','title'=>'Berhasil']);
    }
   
}
