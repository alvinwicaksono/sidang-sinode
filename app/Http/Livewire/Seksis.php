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
    
    public $isOpen=0;
    public $seksiId, $nama;
    public function render()
    {
        return view('livewire.seksi.seksis',[
            'i' => 1,
            'seksis' => Seksi::latest()->paginate(5)
        ]);
    }

    public function showModal() {
        $this->isOpen = true;
    }

    public function hideModal() {
        $this->isOpen = false;
    }

    public function edit($id){
        $seksi = Seksi::findOrFail($id);
        $this->seksiId = $id;
        $this->nama = $seksi->nama;
        $this->showModal();
    }

    public function store() {
        $this->validate([
            'nama' => 'required|min:3|max:50',
        ]);
        
        Seksi::updateOrCreate(['id' => $this->seksiId],
        [
            'nama'=>$this->nama,
        ]);

        $this->hideModal();
        if ($this->seksiId)
            $this->emit('alert',['type'=>'success','message'=>'Seksi Berhasil Diupdate','title'=>'Berhasil']);
        else
            $this->emit('alert',['type'=>'success','message'=>'Seksi Berhasil Ditambahkan','title'=>'Berhasil']);
        $this->seksiId='';
        $this->nama='';
        Alert::success('Berhasil','Seksi Berhasil ditambahkan');
           
    }

    public function delete($id){
        Seksi::find($id)->delete();
        $this->emit('alert',['type'=>'success','message'=>'Seksi Berhasil Dihapus','title'=>'Berhasil']);
    }
   
}
