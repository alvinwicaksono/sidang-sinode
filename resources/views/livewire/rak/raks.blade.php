
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-5">


{{--        <div>--}}
{{--        @if(session()->has('toast_success'))--}}
{{--        @endif--}}
        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <button wire:click="showModal()" class="ml-3 bg-green-500 mt-4 mb-4 hover:bg-green-700 text-white font-bold py-1 px-4 rounded-full">
                Tambah rak
            </button>
            @if($isOpen)
                @include('livewire.rak.create')
            @endif
            <table class="table-fix w-full">
                <thead class="bg-blue-100">
                <tr>
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Kode rak</th>
                    <th class="px-4 py-2">Nama rak</th>
                    <th class="px-4 py-2">Action</th>

                </tr>
                </thead>
                <tbody>
                @foreach($raks as $rak)
                    <tr>
                        <td class="border px-4 py-2 text-center">1</td>
                        <td class="border px-4 py-2 text-center">{{$rak->kode_rak}}</td>
                        <td class="border px-4 py-2 text-center">{{$rak->nama_rak}}</td>
                        <td class="border px-4 py-2 text-center">
                            <button wire:click="edit({{$rak->id}})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded-full">
                                Edit
                            </button>
                            <button wire:click="$set('isDelete',1)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded-full">
                                Hapus
                            </button>
                            @if($isDelete)
                                @include('livewire.delete');
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>

        <div class="flex justify-center mt-4 sm:items-center sm:justify-between">


        </div>
    </div>



