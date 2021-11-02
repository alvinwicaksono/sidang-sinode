<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Peserta_sidang;
use App\Models\Repo_a;
use App\Models\Repo_b;
use App\Models\Sidang;

use Alert;


class Prasidangs extends Component
{
    public $isOpen=0;
    public $tutup;
    public function render()
    {
        $sidang_current = Sidang::latest()->first();
        $peserta_sidang = Peserta_sidang::where('sidang_id',$sidang_current->id)->count();
        $repo_a = Repo_a::where('sidang_id',$sidang_current->id)->count();
        $repo_b = Repo_b::where('sidang_id',$sidang_current->id)->count();
     
        return view('livewire.prasidangs', compact('peserta_sidang','repo_a','repo_b','sidang_current'));
    }

    public function repo_a(){
        $this->redirect('/repo_a');
    }

    public function repo_b(){
        $this->redirect('/repo_b');
    }

    public function peserta_sidang(){
        $this->redirect('/peserta_sidang');
    }

    public function showModal() {
        $this->isOpen = true;
    }
    public function hideModal() {
     
        $this->isOpen = false;
    }

    public function clear()
    {
       $this->tutup = '';
    }

    public function tutup()
    {
      
        $sidang_current = Sidang::latest()->first();
        if($this->tutup == 'tutup pra sidang')
        {
            Sidang::where('id',$sidang_current->id)
                ->update([
                    'status'=>'Sidang'
                ]);
                $this->hideModal();
                $this->clear();
                $this->emit('alert',['type'=>'success','message'=>'Penutupan Pra sidang Berhasil','title'=>'Berhasil']);
        }else{
            $this->hideModal();
            $this->clear();
            $this->emit('alert',['type'=>'error','message'=>'Penutupan Pra sidang gagal','title'=>'Gagal']);
    
    }
    
        
    }

   
}
