<head>

</head>

<div class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:text-center">
            <h1 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Detail Sidang</h1>
        </div>
        <h2>Akta Sidang : {{$sidang_current->akta_sidang}}</h2>
        <h2>Tema Sidang: {{$sidang_current->tema}}</h2>
        <h2>Gereja Penghimpun: {{$sidang_current->penghimpun}}</h2>
        <h2>Pelaksanaan Sidang : {{ date('d F Y', strtotime($sidang_current->periode_awal))}} - {{ date('d F Y', strtotime($sidang_current->periode_akhir))}}</h2>
        <h2>Tempat Sidang :  {{$sidang_current->penghimpun}}</h2>
    </div>
    <a wire:click="showModal()" class="myButton float-right mr-10"><i class="fas fa-deny"></i></i> Tutup Pra Sidang</a>
</div>
@if($isOpen)
                @include('livewire.pra_sidang.close')
   @endif
<div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-5">
    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
        <div
            wire:click="repo_a()"
            class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800 hover:bg-gray-100 hover:bg-gray-100"
        >
            <div class="p-4 flex items-center">
                <div
                    class="p-3 rounded-full text-orange-500 dark:text-orange-100 bg-orange-100 dark:bg-orange-500 mr-4"
                >
                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
                        ></path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Repo A
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        {{$repo_a}}
                    </p>
                </div>
            </div>
        </div>
        <div
            wire:click="repo_b()"
            class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800 hover:bg-gray-100"
        >
            <div class="p-4 flex items-center">
                <div
                    class="p-3 rounded-full text-green-500 dark:text-green-100 bg-green-100 dark:bg-green-500 mr-4"
                >
                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
                        <path
                            fill-rule="evenodd"
                            d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                            clip-rule="evenodd"
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
            wire:click="peserta_sidang()"
            class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800 hover:bg-gray-100"
        >
            <div class="p-4 flex items-center">
                <div
                    class="p-3 rounded-full text-blue-500 dark:text-blue-100 bg-blue-100 dark:bg-blue-500 mr-4"
                >
                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
                        <path
                            d=""
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
            </div>
        </div>
        <div
            wire:click=""
            class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800"
        >
            <div class="p-4 flex items-center">
                <div
                    class="p-3 rounded-full text-teal-500 dark:text-teal-100 bg-teal-100 dark:bg-teal-500 mr-4"
                >
                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
                        <path
                            fill-rule="evenodd"
                            d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Pengaturan Sidang
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"></p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-3">
        <div
            wire:click=""
            class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800 hover:bg-gray-100 hover:bg-gray-100"
        >
            <div class="p-4 flex items-center">
                <div
                    class="p-3 rounded-full text-orange-500 dark:text-orange-100 bg-orange-100 dark:bg-orange-500 mr-4"
                >
                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
                        <path
                            d="M2,1.99079514 C2,0.891309342 2.89706013,0 4.00585866,0 L14.9931545,0 C15.5492199,0 16,0.443864822 16,1 L16,2 L5.00247329,2 C4.44882258,2 4,2.44386482 4,3 C4,3.55228475 4.44994876,4 5.00684547,4 L16.9931545,4 C17.5492199,4 18,4.44463086 18,5.00087166 L18,18.0059397 C18,19.1072288 17.1054862,20 16.0059397,20 L3.99406028,20 C2.8927712,20 2,19.1017876 2,18.0092049 L2,1.99079514 Z M6,4 L10,4 L10,12 L8,10 L6,12 L6,4 Z"
                        ></path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Format
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                       
                    </p>
                </div>
            </div>
        </div>
        <div
            wire:click=""
            class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800 hover:bg-gray-100"
        >
            <div class="p-4 flex items-center">
                <div
                    class="p-3 rounded-full text-green-500 dark:text-green-100 bg-green-100 dark:bg-green-500 mr-4"
                >
                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
                        <path
                            fill-rule="evenodd"
                            d="M0,2 L20,2 L20,6 L0,6 L0,2 Z M0,10 L20,10 L20,12 L0,12 L0,10 Z M0,16 L20,16 L20,18 L0,18 L0,16 Z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Rak
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                      
                    </p>
                </div>
            </div>
        </div>
        <div
            wire:click=""
            class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800 hover:bg-gray-100"
        >
            <div class="p-4 flex items-center">
                <div
                    class="p-3 rounded-full text-blue-500 dark:text-blue-100 bg-blue-100 dark:bg-blue-500 mr-4"
                >
                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
                        <path
                            d="M0,2 C0,0.8954305 0.898212381,0 1.99079514,0 L18.0092049,0 C19.1086907,0 20,0.887729645 20,2 L20,4 L0,4 L0,2 Z M1,5 L19,5 L19,18.0081158 C19,19.1082031 18.1073772,20 17.0049107,20 L2.99508929,20 C1.8932319,20 1,19.1066027 1,18.0081158 L1,5 Z M7,7 L13,7 L13,9 L7,9 L7,7 Z"
                        ></path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Box
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                      
                    </p>
                </div>
            </div>
        </div>

    </div>                
</div>
