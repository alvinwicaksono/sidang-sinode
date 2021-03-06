<?php

namespace App\Http\Livewire;


use App\Models\Sidang;
use App\Models\User;
use App\Models\Seksi;


use Livewire\Component;

class Masterdata extends Component
{
    public function render()
    {
        $sidang = Sidang::count();
        $user = User::count();
        $seksi = User::count();
        return view('livewire.masterdata',compact('sidang','user', 'seksi'));
    }

    public function sidang(){
         $this->redirect('/daftarsidang');
    }

    public function user(){
        $this->redirect('/user');
   }

   public function seksi(){
    $this->redirect('/seksi');
}




}
