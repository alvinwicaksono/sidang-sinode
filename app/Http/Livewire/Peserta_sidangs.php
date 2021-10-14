<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Peserta_sidang;
use App\Models\User;
use App\Models\Sidang;
use Alert;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;

class Peserta_sidangs extends Component
{
    use WithPagination;
    public $search;
    public $isOpen=0;
    public $peserta_sidangId, $user_id, $nama_pengguna, $sidang_id, $utusan;
    public function render()
    {
        $search = '%'.$this->search. '%';
        return view('livewire.peserta_sidang.peserta_sidangs',[
            'i' => 1,
            'peserta_sidangs' => Peserta_sidang::join('users','peserta_sidangs.user_id','=','users.id')
                                ->join('sidangs', 'peserta_sidangs.sidang_id','=','sidangs.id')
                                ->where('peserta_sidangs.nama_pengguna','LIKE',$search)
                                ->orWhere('peserta_sidangs.utusan','LIKE',$search)
                                ->orWhere('users.nama','LIKE',$search)
                                ->orWhere('sidangs.akta_sidang','LIKE',$search)
                                ->orderBy('peserta_sidangs.id', 'desc')
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
        $peserta_sidang = Peserta_sidang::findOrFail($id);
        $this->peserta_sidangId = $id;
        $this->user_id = $peserta_sidang->user_id;
        $this->nama_pengguna = $peserta_sidang->nama_pengguna;
        $this->utusan = $peserta_sidang->utusan;
        $this->showModal();
    }

    public function store() {
        $this->validate([
            'nama_peserta_sidang' => 'required|min:3|max:50',
        ]);
        
        peserta_sidang::updateOrCreate(['id' => $this->peserta_sidangId],
        [
            'nama_peserta_sidang'=>$this->nama_peserta_sidang,
        ]);

        $this->hideModal();
        if ($this->peserta_sidangId)
            $this->emit('alert',['type'=>'success','message'=>'peserta_sidang Berhasil Diupdate','title'=>'Berhasil']);
        else
            $this->emit('alert',['type'=>'success','message'=>'peserta_sidang Berhasil Ditambahkan','title'=>'Berhasil']);
        $this->peserta_sidangId='';
        $this->nama_peserta_sidang='';
        Alert::success('Berhasil','peserta_sidang Berhasil ditambahkan');
           
    }

    public function delete($id){
        peserta_sidang::find($id)->delete();
        $this->emit('alert',['type'=>'success','message'=>'peserta_sidang Berhasil Dihapus','title'=>'Berhasil']);
    }
   
}
