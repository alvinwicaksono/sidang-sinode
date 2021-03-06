<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use PDF;
use App\Models\ArtikelPleno;
use App\Models\Sidang;
use App\Models\Peserta_sidang;
use App\Models\User;
  
class PDFArtikel extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
    {
        $sidang = Sidang::latest()->first();
        $artikels = ArtikelPleno::where('sidang_id','=',$sidang->id)
                                ->where('verified','=',1)
                                ->orderBy('nomor_artikel','asc')
                                ->get();
        $ketuas = Peserta_sidang::join('users','peserta_sidangs.user_id','=','users.id')
                                ->where('peserta_sidangs.sidang_id',$sidang->id)
                                ->where('users.role','Ketua')->orderBy('peserta_sidangs.id','asc')->get();
        $sekretaris = Peserta_sidang::join('users','peserta_sidangs.user_id','=','users.id')
                                ->where('peserta_sidangs.sidang_id',$sidang->id)
                                ->where('role','Sekretaris Moderamen')->orderBy('peserta_sidangs.id','asc')->get();
          
        $pdf = \PDF::loadView('cetakArtikel', compact(
                                'sidang',
                                'artikels',
                                'ketuas',
                                'sekretaris'))
                    ->setPaper('a5')
                    ->setOptions([
                                'isHtml5ParseEnabled' => true,
                                'isRemoteEnabled' => true,
                                'isPhpEnabled' => true
                    ]);
    
        return $pdf->stream('Artikel Pleno '.$sidang->akta_sidang.'.pdf');
    }
}