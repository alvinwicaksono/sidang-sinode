<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Box;
use App\Models\Rak;

class Boxs extends Component
{
    public $boxs;
    public $isOpen=0;
    public $boxId, $kode_box, $nama_box, $rakId;
    public function render()
    {
        $this->boxs = Box::all();
        $rak = Rak::all();
        return view('livewire.box.boxs',compact('rak'));
    }

    public function showModal(){
        $this->isOpen = true;
    }
    public function hideModal(){
        $this->isOpen = false;
    }

    public function store(){
        $rid= Rak::where('nama_rak',$this->rakId)->first()->id;
        $this->validate([
            'kode_box'=>'required',
            'nama_box'=>'required',
            'rakId'=>'required'
        ]);

        Box::updateOrCreate(['id'=>$this->boxId],[
            'kode_box'=>$this->kode_box,
            'nama_box'=>$this->nama_box,
            'rak_id'=>$rid,
        ]);
        $this->hideModal();
        if ($this->boxId)
            $this->emit('alert',['type'=>'success','message'=>'Data Berhasil Diupdate','title'=>'Berhasil']);
        else
            $this->emit('alert',['type'=>'success','message'=>'Data Berhasil Ditambahkan','title'=>'Berhasil']);
        $this->boxId='';
        $this->nama_box='';
        $this->kode_box='';
        $this->rakId='';
    }

    public function edit($id){
        $box = Box::findOrFail($id);
        $this->boxId=$id;
        $this->kode_box = $box->kode_box;
        $this->nama_box = $box->nama_box;
        $this->rakId = $box->rak_id;
        $this->showModal();
    }

    public function delete($id){
        Box::find($id)->delete;
    }

}
