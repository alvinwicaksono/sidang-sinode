<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RepoAs extends Component
{
    public function render()
    {
        return view('livewire.repoa.repo-as');
    }

    public $klasiss;
    public $isOpen=0;
    public $klasisId, $kode_klasis, $nama_klasis, $tahun_buka, $tahun_tutup;
    

    public function showModal() {
        $this->isOpen = true;
    }

    public function hideModal() {
        $this->isOpen = false;
    }

    
}
