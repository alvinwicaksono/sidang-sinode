<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Rak;
use RealRashid\SweetAlert\Facades\Alert;


class Raks extends Component
{
    public $raks;
    public $isOpen=0;
    public $isDelete=0;
    public $rakId, $kode_rak, $nama_rak;
    public function render()
    {
        $this->raks=Rak::all();
        return view('livewire.rak.raks');
    }

    public function showModal() {
        $this->isOpen = true;
    }

    public function hideModal() {
        $this->isOpen = false;
    }


    public function store() {
        $this->validate([
            'kode_rak'=>'required',
            'nama_rak'=>'required'
        ]);

        Rak::updateOrCreate(['id'=>$this->rakId],
            [
                'kode_rak'=>$this->kode_rak,
                'nama_rak'=>$this->nama_rak,
            ]);


        $this->hideModal();
        if ($this->rakId)
            $this->emit('alert',['type'=>'success','message'=>'Data Berhasil Diupdate','title'=>'Berhasil']);
        else
            $this->emit('alert',['type'=>'success','message'=>'Data Berhasil Ditambahkan','title'=>'Berhasil']);
        $this->rakId='';
        $this->nama_rak='';
        $this->kode_rak='';


    }

    public function edit($id){
        $rak = Rak::findOrFail($id);
        $this->rakId = $id;
        $this->kode_rak = $rak->kode_rak;
        $this->nama_rak = $rak->nama_rak;
        $this->showModal();
    }

    public function delete($id){
        Rak::find($id)->delete();
    }

}
