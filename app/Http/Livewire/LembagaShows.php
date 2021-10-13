<?php

namespace App\Http\Livewire;

use App\Models\Lembaga;
use Livewire\Component;

class LembagaShows extends Component
{
    public $lembaga=0;

    public function mount($id){
        $this->lembaga = Lembaga::find($id);
    }

    public function render()
    {
        return view('livewire.lembaga.show.lembaga-shows',compact('lembaga'));
    }
}
