<?php

namespace App\Http\Livewire;

use App\Models\SubBidang;
use App\Models\Bidang;
use Livewire\Component;

class SubBidangs extends Component
{
    public $subBidangs;
    public $isOpen=0;
    public $subBidangId, $kode_subBidang, $nama_subBidang, $bidangId;
    public function render()
    {
        $this->subBidangs = SubBidang::all();
        $bidang = Bidang::all();
        return view('livewire.subBidang.sub-bidangs',compact('bidang'));
    }

    public function showModal(){
        $this->isOpen = true;
    }
    public function hideModal(){
        $this->isOpen = false;
    }

    public function store(){
        $rid= Bidang::where('nama_bidang',$this->bidangId)->first()->id;
        $this->validate([
            'kode_subBidang'=>'required',
            'nama_subBidang'=>'required',
            'bidangId'=>'required'
        ]);

        SubBidang::updateOrCreate(['id'=>$this->subBidangId],[
            'kode_subBidang'=>$this->kode_subBidang,
            'nama_subBidang'=>$this->nama_subBidang,
            'bidang_id'=>$rid,
        ]);
        $this->hideModal();
        if ($this->subBidangId)
            $this->emit('alert',['type'=>'success','message'=>'Data Berhasil Diupdate','title'=>'Berhasil']);
        else
            $this->emit('alert',['type'=>'success','message'=>'Data Berhasil Ditambahkan','title'=>'Berhasil']);
        $this->subBidangId='';
        $this->nama_subBidang='';
        $this->kode_subBidang='';
        $this->bidangId='';
    }

    public function edit($id){
        $subBidang = SubBidang::findOrFail($id);
        $this->subBidangId=$id;
        $this->kode_subBidang = $subBidang->kode_subBidang;
        $this->nama_subBidang = $subBidang->nama_subBidang;
        $this->bidangId = $subBidang->bidang_id;
        $this->showModal();
    }

    public function delete($id){
        SubBidang::find($id)->delete;
    }
}
