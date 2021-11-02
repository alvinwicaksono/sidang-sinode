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

        $validatedData = $this->validate(
            [
                'akta_sidang'=>'required',
                'penghimpun'=>'required',
                'tema'=>'required',
                'periode_awal'=>'required',
                'periode_akhir'=>'required',
                'tempat'=>'required'
            ],
            [
                'akta_sidang.required'=>'Form :attribute tidak boleh kosong',
                'penghimpun.required'=>'Form :attribute tidak boleh kosong',
                'tema.required'=>'Form :attribute tidak boleh kosong',
                'periode_awal.required'=>'Form :attribute tidak boleh kosong',
                'periode_akhir.required'=>'Form :attribute tidak boleh kosong',
                'tempat.required'=>'Form :attribute tidak boleh kosong'
            ],
            [
                'akta_sidang'=>'Akta Sidang',
                'penghimpun'=>'Gereja Penghimpun',
                'tema'=>'Tema',
                'periode_awal'=>'Periode Awal',
                'periode_akhir'=>'Periode Akhir',
                'tempat'=>'Tempat'
            ]
        );

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
        $this->clearCache();
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
            $this->emit('alert',['type'=>'error','message'=>'Sidang sedang dibahas di Repositori A','title'=>'Gagal']);
        }
    }

}
