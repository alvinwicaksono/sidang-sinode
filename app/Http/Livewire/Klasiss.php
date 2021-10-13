<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Klasis;

class Klasiss extends Component
{
    public $klasiss;
    public $isOpen=0;
    public $klasisId, $kode_klasis, $nama_klasis, $tahun_buka, $tahun_tutup;
    public function render()
    {
        $this->klasiss=Klasis::all();
        return view('livewire.klasis.klasiss');
    }

    public function showModal() {
        $this->isOpen = true;
    }

    public function hideModal() {
        $this->isOpen = false;
    }

    public function store() {
        $this->validate([
            'kode_klasis'=>'required',
            'nama_klasis'=>'required',

        ]);

        Klasis::updateOrCreate(['id'=>$this->klasisId],
            [
                'kode_klasis'=>$this->kode_klasis,
                'nama_klasis'=>$this->nama_klasis,
                'tahun_buka'=>$this->tahun_buka,
                'tahun_tutup'=>$this->tahun_tutup
            ]);

        $this->hideModal();
        if ($this->klasisId)
            $this->emit('alert',['type'=>'success','message'=>'Data Berhasil Diupdate','title'=>'Berhasil']);
        else
            $this->emit('alert',['type'=>'success','message'=>'Data Berhasil Ditambahkan','title'=>'Berhasil']);
        $this->klasisId='';
        $this->nama_klasis='';
        $this->kode_klasis='';
        $this->tahun_buka='';
        $this->tahun_tutup='';

    }

    public function edit($id){
        $klasis = Klasis::findOrFail($id);
        $this->klasisId = $id;
        $this->kode_klasis = $klasis->kode_klasis;
        $this->nama_klasis = $klasis->nama_klasis;
        $this->tahun_buka = $klasis->tahun_buka;
        $this->tahun_tutup = $klasis->tahun_tutup;
        $this->showModal();
    }

    public function delete($id){
        Klasis::find($id)->delete();
    }
}
