<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Bidang;
use Alert;

class Bidangs extends Component
{
    public $bidangs;
    public $isOpen=0;
    public $bidangId, $kode_bidang, $nama_bidang;
    public function render()
    {
        $this->bidangs=Bidang::all();
        return view('livewire.bidangs');
    }

    public function showModal() {
        $this->isOpen = true;
    }

    public function hideModal() {
        $this->isOpen = false;
    }

    public function store() {
        $this->validate([
            'kode_bidang'=>'required',
            'nama_bidang'=>'required'
        ]);

        Bidang::updateOrCreate(['id'=>$this->bidangId],
        [
            'kode_bidang'=>$this->kode_bidang,
            'nama_bidang'=>$this->nama_bidang,
        ]);

        $this->hideModal();
        if ($this->bidangId)
            $this->emit('alert',['type'=>'success','message'=>'Data Berhasil Diupdate','title'=>'Berhasil']);
        else
            $this->emit('alert',['type'=>'success','message'=>'Data Berhasil Ditambahkan','title'=>'Berhasil']);
        $this->bidangId='';
        $this->nama_bidang='';
        $this->kode_bidang='';
        Alert::success('Berhasil','Data Berhasil ditambahkan');
    }

    public function edit($id){
        $bidang = Bidang::findOrFail($id);
        $this->bidangId = $id;
        $this->kode_bidang = $bidang->kode_bidang;
        $this->nama_bidang = $bidang->nama_bidang;
        $this->showModal();
    }

    public function delete($id){
        Bidang::find($id)->delete();
    }
}
