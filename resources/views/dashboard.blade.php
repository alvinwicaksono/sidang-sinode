<div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-5">

@if($sidang_current != null)

    <div class="py-12 bg-white mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h1 class="text-base text-center tracking-wide custom-title">Detail Sidang</h1>
            </div>
            <table class="custom-table">
                <tr>
                    <td><b>Status Sidang</b></td>
                    <td>: </td>
                    <td>{{$sidang_current->status}} </td>
                </tr>
                <tr>
                    <td><b>Akta Sidang </b></td>
                    <td>: </td>
                    <td>{{$sidang_current->akta_sidang}}</td>
                </tr>
                <tr>
                    <td><b>Tema Sidang</b></td>
                    <td>: </td>
                    <td>{{$sidang_current->tema}}</b></td>
                </tr>
                <tr>
                    <td><b>Gereja Penghimpun</b></td>
                    <td>: </td>
                    <td>{{$sidang_current->penghimpun}}</td>
                </tr>
                <tr>
                    <td><b>Pelaksanaan Sidang </b></td>
                    <td>: </td>
                    <td>{{ date('d F Y', strtotime($sidang_current->periode_awal))}} - {{ date('d F Y', strtotime($sidang_current->periode_akhir))}}</td>
                </tr>
                <tr>
                    <td><b>Tempat Sidang </b></td>
                    <td>: </td>
                    <td>{{$sidang_current->penghimpun}}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="py-12 bg-white mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h1 class="text-base text-center tracking-wide custom-title">Moderamen Sidang</h1>
            </div>
            <table class="custom-table">
            @if($moderamen_ketua->count() > 0)
                @foreach ($moderamen_ketua as $key => $ketua)
                <tr>
                    <td><b>Ketua {{ ++$key }}</b></td>
                    <td> :</td>
                    <td> {{$ketua->nama_pengguna}}</td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td><b>Ketua</b></td>
                    <td> :</td>
                    <td> -</td>
                </tr>
            @endif
            <br>
            @if($moderamen_sekretaris->count() > 0)
                @foreach ($moderamen_sekretaris as $key => $sekretaris)
                <tr>
                    <td><b>Sekretaris Moderamen {{ ++$key }}</b></td>
                    <td> :</td>
                    <td> {{$sekretaris->nama_pengguna}}</td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td><b>Sekretaris Moderamen</b></td>
                    <td> :</td>
                    <td> -</td>
                </tr>
            @endif
            </table>
        </div>
    </div>

@else
    <div class="py-12 bg-white mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center text-center">
                <h1><i class="fas fa-exclamation-circle custom-red"></i> <b>Belum Ada Sidang</b></h1>
                <h1>Hubungi Admin untuk menambahkan Sidang</h1>
            </div>
        </div>
    </div>
@endif
    
</div><br><br>



    

