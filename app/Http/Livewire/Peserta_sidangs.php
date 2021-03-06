<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Peserta_sidang;
use App\Models\User;
use App\Models\Sidang;
use Alert;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;

class Peserta_sidangs extends Component
{
    use WithPagination;
    public $search;
    public $isOpen=0, $isOpenEdit=0, $isOpenDelete=0;
    public $peserta_sidangId, $user_id='', $nama_pengguna, $sidang_id='', $utusan;
    public function render()
    {
        $search = '%'.$this->search. '%';
        $sidang =  Sidang::latest()->first();
        return view('livewire.peserta_sidang.peserta_sidangs',[
            'i' => 1,
            'users' => User::orderBy('id','asc')->get(),
            'sidangs' => $sidang,
            'peserta_sidangs' => Peserta_sidang::join('users','peserta_sidangs.user_id','=','users.id')
                                ->join('sidangs', 'peserta_sidangs.sidang_id','=','sidangs.id')
                                ->where('peserta_sidangs.sidang_id', $sidang->id)
                                ->where(function($query) use ($search){
                                    $query->where('peserta_sidangs.nama_pengguna','LIKE',$search)
                                            ->orWhere('peserta_sidangs.utusan','LIKE',$search)
                                            ->orWhere('users.nama','LIKE',$search)
                                            ->orWhere('sidangs.akta_sidang','LIKE',$search);
                                })
                                ->select('*','peserta_sidangs.id as ps_id')
                                ->orderBy('peserta_sidangs.id', 'desc')
                                ->paginate(5)
        ]);
    }

    private function clearCache() {
        $this->peserta_sidangId='';
        $this->user_id='';
        $this->nama_pengguna='';
        $this->sidang_id='';
        $this->utusan='';
    }

    public function showModal() {
        $this->isOpen = true;
    }
    public function hideModal() {
        $this->clearCache();   
        $this->resetValidation();
        $this->isOpen = false;
    }

    public function showModalEdit() {
        $this->isOpenEdit = true;
    }
    public function hideModalEdit() {
        $this->clearCache();
        $this->resetValidation();   
        $this->isOpenEdit = false;
    }

    public function showModalDelete() {
        $this->isOpenDelete = true;
    }
    public function hideModalDelete() {
        $this->clearCache();
        $this->isOpenDelete = false;
    }

    public function edit($id){
        $peserta_sidang = Peserta_sidang::findOrFail($id);

        $sidangs = Sidang::find($peserta_sidang->sidang_id);

        $this->akta_sidang = $sidangs->akta_sidang;
        $this->status = $sidangs->status;

        $this->peserta_sidangId = $id;
        $this->user_id = $peserta_sidang->user_id;
        $this->nama_pengguna = $peserta_sidang->nama_pengguna;
        $this->sidang_id = $peserta_sidang->sidang_id;
        $this->utusan = $peserta_sidang->utusan;
        $this->showModalEdit();
    }

    public function store() {

        $validatedData = $this->validate(
            [
                'user_id' => 'required',
                'nama_pengguna' => 'required',
                'utusan' => 'required'
            ],
            [
                'user_id.required' => 'Form :attribute tidak boleh kosong',
                'nama_pengguna.required' => 'Form :attribute tidak boleh kosong',
                'utusan.required' => 'Form :attribute tidak boleh kosong',
            ],
            [
                'user_id' => 'User',
                'nama_pengguna' => 'Nama Pengguna',
                'utusan' => 'Utusan',
            ]
        );
        
        $sidangs =  Sidang::latest()->first();

        Peserta_sidang::create(
        [
            'user_id' => $this->user_id,
            'nama_pengguna' => $this->nama_pengguna,
            'sidang_id' => $sidangs->id,
            'utusan' => $this->utusan
        ]);

        $this->hideModal();
        $this->emit('alert',['type'=>'success','message'=>'Peserta Sidang Berhasil Ditambahkan','title'=>'Berhasil']);        
    }

    public function update() {
        $validatedData = $this->validate(
            [
                'user_id' => 'required',
                'nama_pengguna' => 'required',
                'utusan' => 'required'
            ],
            [
                'user_id.required' => 'Form :attribute tidak boleh kosong',
                'nama_pengguna.required' => 'Form :attribute tidak boleh kosong',
                'utusan.required' => 'Form :attribute tidak boleh kosong',
            ],
            [
                'user_id' => 'User',
                'nama_pengguna' => 'Nama Pengguna',
                'utusan' => 'Utusan',
            ]
        );

        $peserta_sidang = Peserta_sidang::find($this->peserta_sidangId);
        
        $peserta_sidang->update(
        [
            'user_id' => $this->user_id,
            'nama_pengguna' => $this->nama_pengguna,
            'utusan' => $this->utusan
        ]);

        $this->hideModalEdit();
        $this->emit('alert',['type'=>'success','message'=>'Peserta Sidang Berhasil Diupdate','title'=>'Berhasil']);        
    }

    public function remove($id){
        $peserta_sidang = Peserta_sidang::find($id);

        $this->peserta_sidangId = $id;
        $this->nama_pengguna = $peserta_sidang->nama_pengguna;

        $this->showModalDelete();
    }

    public function delete(){
        Peserta_sidang::find($this->peserta_sidangId)->delete();
        $this->clearCache();
        $this->hideModalDelete();
        $this->emit('alert',['type'=>'success','message'=>'Peserta Sidang Berhasil Dihapus','title'=>'Berhasil']);
    }
   
}
