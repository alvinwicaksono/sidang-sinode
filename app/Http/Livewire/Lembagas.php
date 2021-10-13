<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Lembaga;
use App\Models\Klasis;

class Lembagas extends Component
{
    public $lembagas;
    public $isOpen=0;
    public $isDetail=0;
    public $lembagaId, $kode_lembaga, $nama_lembaga, $tgl_berdiri, $status, $alamat, $klasisId ;
    public function render()
    {
        $this->lembagas=Lembaga::all();
        $klasis = Klasis::all();
        $lid = Lembaga::where('id',$this->lembagaId)->first();
        return view('livewire.lembaga.lembagas',compact('klasis','lid'));
    }

    public function showModal() {
        $this->isDetail = false;
        $this->isOpen = true;
    }

    public function hideModal() {
        $this->isOpen = false;
        $this->lembagaId='';
        $this->nama_lembaga='';
        $this->kode_lembaga='';
        $this->tgl_berdiri='';
        $this->status='';
        $this->alamat='';
        $this->klasisId='';
    }

    public function showDetail($id) {
        $lembaga = Lembaga::findOrFail($id);
        $this->lembagaId = $id;
        $this->isDetail = true;
    }

    public function hideDetail() {
        $this->isDetail = false;
    }

    public function store() {
        $kid= Klasis::where('nama_klasis',$this->klasisId)->first()->id;
        $this->validate([
            'kode_lembaga'=>'required',
            'nama_lembaga'=>'required',
            'status'=>'required',
            'alamat'=>'required',
            'klasisId'=>'required',
        ]);

        Lembaga::updateOrCreate(['id'=>$this->lembagaId],
            [
                'kode_lembaga'=>$this->kode_lembaga,
                'nama_lembaga'=>$this->nama_lembaga,
                'tgl_berdiri'=>$this->tgl_berdiri,
                'status'=>$this->status,
                'alamat'=>$this->alamat,
                'klasis_id'=>$kid
            ]);

        $this->hideModal();
        if ($this->lembagaId)
            $this->emit('alert',['type'=>'success','message'=>'Data Berhasil Diupdate','title'=>'Berhasil']);
        else
            $this->emit('alert',['type'=>'success','message'=>'Data Berhasil Ditambahkan','title'=>'Berhasil']);
        $this->lembagaId='';
        $this->nama_lembaga='';
        $this->kode_lembaga='';
        $this->tgl_berdiri='';
        $this->status='';
        $this->tgl_berdiri='';
        $this->klasisId='';

    }

    public function edit($id){
        $lembaga = Lembaga::findOrFail($id);
        $this->lembagaId = $id;
        $this->kode_lembaga = $lembaga->kode_lembaga;
        $this->nama_lembaga = $lembaga->nama_lembaga;
        $this->tgl_berdiri = $lembaga->tgl_berdiri;
        $this->status = $lembaga->status;
        $this->alamat = $lembaga->alamat;
        $this->klasisId = $lembaga->Klasis->nama_klasis;
        $this->showModal();
    }

    public function delete($id){
        Lembaga::find($id)->delete();
    }

}
