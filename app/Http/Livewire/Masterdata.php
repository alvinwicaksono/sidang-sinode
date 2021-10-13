<?php

namespace App\Http\Livewire;

use App\Models\Klasis;
use App\Models\Box;
use App\Models\Lembaga;
use App\Models\Rak;
use App\Models\Bidang;
use App\Models\SubBidang;
use App\Models\Format;
use Livewire\Component;

class Masterdata extends Component
{
    public function render()
    {
        $klasis = Klasis::count();
        $box = Box::count();
        $lembaga = Lembaga::count();
        $rak = Rak::count();
        $bidang = Bidang::count();
        $subBidang = SubBidang::count();
        $format = Format::count();
        return view('livewire.masterdata',compact('klasis','box','lembaga','rak','bidang','subBidang','format'));
    }

    public function box(){
         $this->redirect('/box');
    }

    public function lembaga(){
        return  $this->redirect('/lembaga');
    }

    public function bidang(){
        return $this->redirect('/bidang');
    }

    public function document(){
        $this->redirect('/document');
    }

    public function format(){
        $this->redirect('/format');
    }

    public function klasis(){
        $this->redirect('/klasis');
    }

    public function rak(){
        $this->redirect('/rak');
    }

    public function subBidang(){
        $this->redirect('/subBidang');
    }

}
