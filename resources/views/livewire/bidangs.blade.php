<div>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-5">



        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <button wire:click="showModal()" class="ml-3 bg-green-500 mt-4 mb-4 hover:bg-green-700 text-white font-bold py-1 px-4 rounded-full">
                Tambah Bidang
            </button>
            @if($isOpen)
                @include('livewire.create_bidang')
            @endif
            <table class="table-fix w-full">
                <thead class="bg-blue-100">
                <tr>
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Kode Bidang</th>
                    <th class="px-4 py-2">Nama Bidang</th>
                    <th class="px-4 py-2">Action</th>

                </tr>
                </thead>
                <tbody>
                @foreach($bidangs as $bidang)
                    <tr>
                        <td class="border px-4 py-2 text-center">1</td>
                        <td class="border px-4 py-2 text-center">{{$bidang->kode_bidang}}</td>
                        <td class="border px-4 py-2 text-center">{{$bidang->nama_bidang}}</td>
                        <td class="border px-4 py-2 text-center">
                            <button wire:click="edit({{$bidang->id}})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded-full">
                                Edit
                            </button>
                            <button wire:click="delete({{$bidang->id}})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded-full">
                                Hapus
                            </button>

                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>

        <div class="flex justify-center mt-4 sm:items-center sm:justify-between">

</div>
