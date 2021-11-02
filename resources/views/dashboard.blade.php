<div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-5">

@if($sidang_current != null)

    <div class="py-12 bg-white mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h1 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Detail Sidang</h1>
            </div>
            <h1>Status Sidang: {{$sidang_current->status}} </h1>
            <h2>Akta Sidang : {{$sidang_current->akta_sidang}}</h2>
            <h2>Tema Sidang: {{$sidang_current->tema}}</h2>
            <h2>Gereja Penghimpun: {{$sidang_current->penghimpun}}</h2>
            <h2>Pelaksanaan Sidang : {{ date('d F Y', strtotime($sidang_current->periode_awal))}} - {{ date('d F Y', strtotime($sidang_current->periode_akhir))}}</h2>
            <h2>Tempat Sidang :  {{$sidang_current->penghimpun}}</h2>
        </div>
    </div>

    <div class="py-12 bg-white mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h1 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Moderamen Sidang</h1>
            </div>
    @if($moderamen_ketua != null)
        @foreach ($moderamen_ketua as $key => $ketua)
            <h1>Ketua {{ ++$key }} : {{$ketua->nama}} </h1>
        @endforeach
    @else
        <h1>Ketua : - </h1>
    @endif
    @if($moderamen_sekretaris != null)
        @foreach ($moderamen_sekretaris as $key => $sekretaris)
            <h2>Sekretaris Moderamen {{ ++$key }} : {{$sekretaris->nama}}</h2>
        @endforeach
    @else
        <h1>Sekretaris Moderamen : - </h1>
    @endif
        </div>
    </div>

@else
    <div class="py-12 bg-white mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h1><i class="fas fa-exclamation-circle custom-red"></i> <b>Belum Ada Sidang</b></h1>
                <h1>Hubungi Admin untuk menambahkan Sidang</h1>
            </div>
        </div>
    </div>
@endif
    
</div>



    

