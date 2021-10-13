<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use App\Models\Dokumen;
use App\Models\Lembaga;
use App\Models\Box;
use App\Models\SubBidang;
use App\Models\Format;
use Livewire\WithFileUploads;
use App\Http\Livewire\DB;

class Documents extends Component
{
    use WithFileUploads;
    public $documents;
    public $isOpen=0;
    public $documentId, $jumdok, $kode_document, $nama_document, $tanggal_buat, $tanggal_masuk, $pengarang, $keterangan, $batas_akses, $lembagaId, $boxId, $subbidangId, $formatId, $file ;
    public function render()
    {
        $this->documents=Dokumen::all();
        $format = Format::all();
        $lembaga = Lembaga::all();
        $subbidang = SubBidang::all();
        $box = Box::all();

        return view('livewire.document.documents',compact('box','lembaga', 'format', 'subbidang' ));
    }

    public function showModal() {
        $this->isOpen = true;
    }

    public function hideModal() {
        $this->isOpen = false;
    }

    public function store() {
        $lid= Lembaga::where('nama_lembaga',$this->lembagaId)->first()->id;
        $bid= Box::where('nama_box',$this->boxId)->first()->id;
        $sid= SubBidang::where('nama_subBidang',$this->subbidangId)->first()->id;
        $fid= Format::where('nama_format',$this->formatId)->first()->id;
        $dok= $this->file->store('file','public');
        $this->validate([
            'kode_document'=>'required',
            'nama_document'=>'required',
            'tanggal_masuk'=>'required',
            'pengarang'=>'required',
            'keterangan'=>'required',
            'batas_akses'=>'required',
            'lembagaId'=>'required',
            'boxId'=>'required',
            'subbidangId'=>'required',
            'formatId'=>'required',
            'jumdok'=>'required',
        ]);


        Dokumen::updateOrCreate(['id'=>$this->documentId],
            [

                'kode_dokumen'=>$this->kode_document,
                'nama_dokumen'=>$this->nama_document,
                'tanggal_buat'=>$this->tanggal_buat,
                'tanggal_masuk'=>$this->tanggal_masuk,
                'pengarang'=>$this->pengarang,
                'keterangan'=>$this->keterangan,
                'batas_akses'=>$this->batas_akses,
                'lembaga_id'=>$lid,
                'box_id'=>$bid,
                'subbidang_id'=>$sid,
                'format_id'=>$fid,
                'jumdok'=>$this->jumdok,
                'file'=>$dok,
            ]);

        $this->hideModal();
        if ($this->documentId)
            $this->emit('alert',['type'=>'success','message'=>'Data Berhasil Diupdate','title'=>'Berhasil']);
        else
            $this->emit('alert',['type'=>'success','message'=>'Data Berhasil Ditambahkan','title'=>'Berhasil']);
        $this->documentId='';
        $this->nama_document='';
        $this->kode_document='';
        $this->tanggal_buat='';
        $this->tanggal_masuk='';
        $this->tanggal_buat='';
        $this->pengarang='';
        $this->keterangan='';
        $this->batas_akses='';
        $this->lembagaId='';
        $this->boxId='';
        $this->subbidangId='';
        $this->formatId='';
        $this->jumdok='';
        $this->file='';
    }

    public function edit($id){
        $document = Dokumen::findOrFail($id);
        $subbidang = SubBidang::where('id',$document->subbidang_id)->first()->nama_subBidang;
        $this->documentId = $id;
        $this->kode_document = $document->kode_dokumen;
        $this->nama_document = $document->nama_dokumen;
        $this->tanggal_buat = $document->tanggal_buat;
        $this->tanggal_masuk = $document->tanggal_masuk;
        $this->pengarang = $document->pengarang;
        $this->keterangan = $document->keterangan;
        $this->batas_akses = $document->batas_akses;
        $this->lembagaId = $document->Lembaga->nama_lembaga;
        $this->boxId = $document->Box->nama_box;
        $this->subbidangId = $subbidang;
        $this->formatId = $document->Format->nama_format;
        $this->jumdok = $document->jumdok;
        $this->file = $document->file;
        $this->showModal();
    }

    public function delete($id){
        Dokumen::find($id)->delete();
    }
}
