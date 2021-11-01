<div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-5">
<div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-3">
    <div
        wire:click="sidang()"
        class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800 hover:bg-gray-100 hover:bg-gray-100"
    >
        <div class="p-4 flex items-center">
            <div
                class="p-3 rounded-full text-indigo-500 dark:text-indigo-100 bg-indigo-100 dark:bg-indigo-500 mr-4"
            >
                <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
                    <path
                    d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"
                    ></path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Sidang
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{$sidang}}
                </p>
            </div>
        </div>
    </div>
    <div
        wire:click="user()"
        class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800 hover:bg-gray-100"
    >
        <div class="p-4 flex items-center">
            <div
                class="p-3 rounded-full text-purple-500 dark:text-purple-100 bg-purple-100 dark:bg-purple-500 mr-4"
            >
                <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
                    <path
                        fill-rule="evenodd"
                        d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                        clip-rule="evenodd"
                    ></path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    User
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                  {{$user}}
                </p>
            </div>
        </div>
    </div>
    <div
        wire:click="seksi()"
        class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-white dark:bg-gray-800 hover:bg-gray-100"
    >
        <div class="p-4 flex items-center">
            <div
                class="p-3 rounded-full text-yellow-500 dark:text-yellow-100 bg-yellow-100 dark:bg-yellow-500 mr-4"
            >
                <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
                    <path
                    d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"
                    ></path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Seksi
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{$seksi}}
                </p>
            </div>
        </div>
    </div>
</div>
