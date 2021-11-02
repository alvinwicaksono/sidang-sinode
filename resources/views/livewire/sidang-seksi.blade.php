<div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-5">
<div class="py-12 bg-white mb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

@if($sidang_current != null)

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
<div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-3">
    <div
        wire:click="repo_b()"
        class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800 hover:bg-gray-100 hover:bg-gray-100"
    >
        <div class="p-4 flex items-center">
            <div
                class="p-3 rounded-full text-green-500 dark:text-green-100 bg-green-100 dark:bg-green-500 mr-4"
            >
                <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
                    <path
                        fill-rule="evenodd"
                        d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6.414A2 2 0 0016.414 5L14 2.586A2 2 0 0012.586 2H9z"
                        clip-rule="evenodd"
                    ></path>
                    <path
                        d="M3 8a2 2 0 012-2v10h8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"
                    ></path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Repo B
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{$repo_b}}
                </p>
            </div>
        </div>
    </div>
    <div
        wire:click="sidangseksi()"
        class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800 hover:bg-gray-100"
    >
        <div class="p-4 flex items-center">
            <div
                class="p-3 rounded-full text-red-500 dark:text-red-100 bg-red-100 dark:bg-red-500 mr-4"
            >
                <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
                    <path
                        fill-rule="evenodd"
                        d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm1 8a1 1 0 100 2h6a1 1 0 100-2H7z"
                        clip-rule="evenodd"
                    ></path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                   Artikel Sidang Seksi
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{$artikel_seksi}}
                </p>
            </div>
        </div>
    </div>
    <div
        wire:click="peserta_sidang()"
        class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800 hover:bg-gray-100"
    >
        <div class="p-4 flex items-center">
            <div
                class="p-3 rounded-full text-blue-500 dark:text-blue-100 bg-blue-100 dark:bg-blue-500 mr-4"
            >
                <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
                    <path
                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
                    ></path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Peserta Sidang
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{ $peserta_sidang }}
                </p>
            </div>

@else
    <div class="lg:text-center">
        <h1><i class="fas fa-exclamation-circle custom-red"></i> <b>Belum Ada Sidang</b></h1>
        <h1>Hubungi Admin untuk menambahkan Sidang</h1>
    </div>
@endif

        </div>
    </div>
</div>



    

