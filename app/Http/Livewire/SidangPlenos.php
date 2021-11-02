<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Repo_b;
use App\Models\artikelSeksi;
use App\Models\artikelPleno;
use App\Models\Sidang;
use App\Models\Peserta_sidang;

use Illuminate\Support\Facades\Auth;


class SidangPlenos extends Component
{
    public $isOpen;
    public $tutup;
    public function render()
    {
        try{
            $user_seksi = Auth::User()->seksi_id;

            $sidang_current = Sidang::latest()->first();

            $artikel_seksi = ArtikelSeksi::where('sidang_id',$sidang_current->id)
                                ->where('verified',1)
                                ->count();

            $repo_b = Repo_b::where('sidang_id',$sidang_current->id)
                                ->count();

            $artikel_pleno = ArtikelPleno::where('sidang_id',$sidang_current->id)
                                            ->count();

            $peserta_sidang = Peserta_sidang::where('sidang_id',$sidang_current->id)
                                                ->count();
                                                
            return view('livewire.sidang_pleno.sidang-plenos',compact('repo_b','artikel_seksi','sidang_current','peserta_sidang', 'artikel_pleno'));

        } catch (\Exception $e) {
            $user_seksi = Auth::User()->seksi_id;
            $sidang_current = Sidang::latest()->first();
            $repo_b = Repo_b::count();
            $artikel_pleno = ArtikelPleno::count();
            $peserta_sidang = Peserta_sidang::count();
            return view('livewire.sidang_pleno.sidang-plenos',compact('repo_b','sidang_current','peserta_sidang', 'artikel_pleno'));
        }
    }

    public function repo_b(){
        $this->redirect('/repo_b');
    }

    public function sidangseksi(){
        $this->redirect('/artikel_seksi_pleno');
    }

    public function artikelpleno()
    {
        $this->redirect('/artikel_pleno');
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
        if($this->tutup == 'tutup sidang')
        {
            // Sidang::where('id',$sidang_current->id)
            //     ->update([
            //         'status'=>'Selesai'
            //     ]);
                $this->hideModal();
                $this->clear();
                $this->emit('alert',['type'=>'success','message'=>'Penutupan Sidang Berhasil','title'=>'Berhasil']);
        }else{
            $this->hideModal();
            $this->clear();
            $this->emit('alert',['type'=>'error','message'=>'Penutupan Sidang gagal','title'=>'Gagal']);
    
    }
}

}
