<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ArtikelSeksi extends Component
{
    public $isOpen=0;
    public $attachment=[];
    public function render()
    {
        return view('livewire.artikel_seksi.artikel-seksi');
    }

    private function clearCache() {
        $this->repo_aId='';
        $this->sidang_id='';
        $this->judul_materi='';
        $this->isi_materi='';
        $this->sumber_materi='';
        $this->status=''; 
        $this->attachment=[];
        $this->attachment_final=[]; 
    }

    public function showModal() {
        $this->isOpen = true;
    }

    public function hideModal() {
        $this->clearCache();
        $this->isOpen = false;
    }

}
