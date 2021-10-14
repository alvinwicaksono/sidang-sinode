<?php

namespace App\Http\Livewire;

use App\Models\Format;
use Livewire\Component;
use Livewire\WithPagination;

class Formats extends Component
{
    use WithPagination;

   
    public $isOpen=0;
    public $formatId, $kode_format, $nama_format;
   

    public function render()
    {
        
        return view('livewire.format.formats',[
            'formats' => Format::latest()->paginate(5)
        ]);
    }

    public function showModal() {
        $this->isOpen = true;
    }

    public function hideModal() {
        $this->isOpen = false;
    }


    public function store() {
        $this->validate([
            'kode_format'=>'required',
            'nama_format'=>'required'
        ]);

        Format::updateOrCreate(['id'=>$this->formatId],
            [
                'kode_format'=>$this->kode_format,
                'nama_format'=>$this->nama_format,
            ]);


        $this->hideModal();
        if ($this->formatId)
            $this->emit('alert',['type'=>'success','message'=>'Data Berhasil Diupdate','title'=>'Berhasil']);
        else
            $this->emit('alert',['type'=>'success','message'=>'Data Berhasil Ditambahkan','title'=>'Berhasil']);
        $this->formatId='';
        $this->nama_format='';
        $this->kode_format='';
    }

    public function edit($id){
        $format = Format::findOrFail($id);
        $this->formatId = $id;
        $this->kode_format = $format->kode_format;
        $this->nama_format = $format->nama_format;
        $this->showModal();
    }

    public function delete($id){
        Format::find($id)->delete();
    }

}
