<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RepoBs extends Component
{
    public $isOpen=0;
    public function render()
    {
        return view('livewire.repob.repo-bs');
    }

    public function showModal() {
        $this->isOpen = true;
    }

    public function hideModal() {
        $this->isOpen = false;
    }

}
