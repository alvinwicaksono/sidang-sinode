<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use PDF;
use App\Models\Repo_b;
use App\Models\Sidang; 
  
class PDFRepoB extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
    {
        $sidang = Sidang::latest()->first();
        $repo_b = Repo_b::join('repo_as', 'repo_bs.repoa_id','=','repo_as.id')
                            ->where('repo_bs.sidang_id', $sidang->id)
                            ->select('*','repo_as.sumber_materi as sumber')
                            ->orderBy('repo_bs.id', 'asc')->get();

        $pdf = \PDF::loadView('cetakRepoB', compact(
                                'sidang',
                                'repo_b'))
                    ->setPaper('a5')
                    ->setOptions([
                                'isHtml5ParseEnabled' => true,
                                'isRemoteEnabled' => true,
                                'isPhpEnabled' => true
                    ]);
    
        return $pdf->stream('Repositori B '.$sidang->akta_sidang.'.pdf');
    }
}