<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Seksi;
use Alert;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;

class Seksis extends Component
{
    use WithPagination;
    public $search;
    public $isOpen=0, $isOpenEdit=0;
    public $seksiId, $nama;
    public function render()
    {
        $search = '%'.$this->search. '%';
        return view('livewire.seksi.seksis',[
            'seksis' => Seksi::where('nama','LIKE',$search)
                                ->orderBy('id', 'desc')
                                ->paginate(5)
        ]);
    }

    private function clearCache() {
        $this->seksiId='';
        $this->nama='';
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

    public function edit($id){
        $seksi = Seksi::findOrFail($id);
        $this->seksiId = $id;
        $this->nama = $seksi->nama;
        $this->showModalEdit();
    }

    public function store() {
        $this->validate([
            'nama' => 'required|min:3|max:50',
        ]);
        
        Seksi::create(
        [
            'nama'=>$this->nama,
        ]);

        $this->hideModal();
        $this->emit('alert',['type'=>'success','message'=>'Seksi Berhasil Ditambahkan','title'=>'Berhasil']);
    }

    public function update() {
        $this->validate([
            'nama' => 'required|min:3|max:50',
        ]);

        $seksi = Seksi::find($this->seksiId);
        
        $seksi->update(
        [
            'nama'=>$this->nama,
        ]);

        $this->hideModalEdit();
        $this->emit('alert',['type'=>'success','message'=>'Seksi Berhasil Diupdate','title'=>'Berhasil']);
    }

    public function delete($id){
        Seksi::find($id)->delete();
        $this->clearCache();
        $this->emit('alert',['type'=>'success','message'=>'Seksi Berhasil Dihapus','title'=>'Berhasil']);
    }
   
}
