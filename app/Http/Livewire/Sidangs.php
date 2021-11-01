<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sidang;
use Livewire\WithPagination;

use Alert;


class Sidangs extends Component
{
    use WithPagination;
    public $search;
    public $isOpen=0, $isOpenDelete=0;
    public $sidangId, $akta_sidang, $penghimpun, $tema, $periode_awal, $periode_akhir, $tempat, $keterangan, $status;
    public function render()
    {

        $search = '%'.$this->search. '%';
        return view('livewire.sidang.sidangs',[
            'sidangs' => Sidang::where('akta_sidang','LIKE',$search)
                                ->orWhere('penghimpun','LIKE',$search)
                                ->orWhere('tema','LIKE',$search)
                                ->orWhere('tempat','LIKE',$search)
                                ->orWhere('status','LIKE',$search)
                                ->orderBy('id', 'desc')
                                ->paginate(5)
        ]);
    }

    private function clearCache() {
        $this->akta_sidang='';
        $this->penghimpun='';
        $this->tema='';
        $this->periode_awal='';
        $this->periode_akhir='';
        $this->tempat='';
        $this->keterangan='';
        $this->status='';
    }

    public function showModal() {
        $this->isOpen = true;
    }
    public function hideModal() {
        $this->clearCache();
        $this->resetValidation();
        $this->isOpen = false;
    }

    public function showModalDelete() {
        $this->isOpenDelete = true;
    }
    public function hideModalDelete() {
        $this->clearCache();
        $this->resetValidation();
        $this->isOpenDelete = false;
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

    public function remove($id){
        $sidang = Sidang::find($id);

        $this->sidangId = $id;
        $this->akta_sidang = $sidang->akta_sidang;

        $this->showModalDelete();
    }

    public function delete(){
        try{
            Sidang::find($this->sidangId)->delete();
            $this->clearCache();
            $this->hideModalDelete();
            $this->emit('alert',['type'=>'success','message'=>'Sidang Berhasil Dihapus','title'=>'Berhasil']);
        } catch ( \Exception $e) {
            $this->hideModalDelete();
            $this->emit('alert',['type'=>'error','message'=>'Sidang sudah dibahas','title'=>'Gagal']);
        }
    }

}
