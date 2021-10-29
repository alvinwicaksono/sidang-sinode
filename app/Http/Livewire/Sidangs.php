<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sidang;

use Alert;


class Sidangs extends Component
{
    public $sidangs;
    public $isOpen=0;
    public $sidangId, $akta_sidang, $penghimpun, $tema, $periode_awal, $periode_akhir, $tempat, $keterangan, $status;
    public function render()
    {
        $this->sidangs=Sidang::all();
        return view('livewire.sidang.sidangs');
    }

    public function showModal() {
        $this->isOpen = true;
    }

    public function hideModal() {
        $this->isOpen = false;
    }

    public function store() {
        $this->status="Pra Sidang";
        $this->validate([
            'akta_sidang'=>'required',
            'penghimpun'=>'required',
            'tema'=>'required',
            'periode_awal'=>'required',
            'periode_akhir'=>'required',
            'tempat'=>'required',

        ]);

        Sidang::updateOrCreate(['id'=>$this->sidangId],
            [
                'akta_sidang'=>$this->akta_sidang,
                'penghimpun'=>$this->penghimpun,
                'tema'=>$this->tema,
                'periode_awal'=>$this->periode_awal,
                'periode_akhir'=>$this->periode_akhir,
                'tempat'=>$this->tempat,
                'keterangan'=>$this->keterangan,
                'status'=>$this->status
            ]);

        $this->hideModal();
        if ($this->sidangId)
            $this->emit('alert',['type'=>'success','message'=>'Data Berhasil Diupdate','title'=>'Berhasil']);
        else
            $this->emit('alert',['type'=>'success','message'=>'Data Berhasil Ditambahkan','title'=>'Berhasil']);
        $this->sidangId='';
        $this->akta_sidang='';
        $this->penghimpun='';
        $this->tema='';
        $this->periode_awal='';
        $this->periode_akhir='';
        $this->tempat='';
        $this->keterangan='';
        $this->status='';

    }

    public function edit($id){
        $sidang = Sidang::findOrFail($id);

        $this->sidangId= $id;
        $this->akta_sidang= $sidang->akta_sidang;
        $this->penghimpun= $sidang->penghimpun;
        $this->tema= $sidang->tema;
        $this->periode_awal= $sidang->periode_awal;
        $this->periode_akhir= $sidang->periode_akhir;
        $this->tempat= $sidang->tempat;
        $this->keterangan= $sidang->keterangan;
        $this->status= $sidang->status;
        $this->showModal();
    }

    public function delete($id){
        Sidang::find($id)->delete();
    }

}
