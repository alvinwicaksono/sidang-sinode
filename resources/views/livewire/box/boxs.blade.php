<div>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-5">


        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <button wire:click="showModal()" class="ml-3 bg-green-500 mt-4 mb-4 hover:bg-green-700 text-white font-bold py-1 px-4 rounded-full">
                Tambah Box
            </button>
            @if($isOpen)
                @include('livewire.box.create')
            @endif
            <table class="table-fix w-full">
                <thead class="bg-blue-100">
                <tr>
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Kode Box</th>
                    <th class="px-4 py-2">Nama Box</th>
                    <th class="px-4 py-2">Nama Rak</th>
                    <th class="px-4 py-2">Action</th>

                </tr>
                </thead>
                <tbody>
                @foreach($boxs as $box)
                    <tr>
                        <td class="border px-4 py-2 text-center">1</td>
                        <td class="border px-4 py-2 text-center">{{$box->kode_box}}</td>
                        <td class="border px-4 py-2 text-center">{{$box->nama_box}}</td>
                        <td class="border px-4 py-2 text-center">{{$box->rak_id}}</td>
                        <td class="border px-4 py-2 text-center">
                            <button wire:click="edit({{$box->id}})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded-full">
                                Edit
                            </button>
                            <button wire:click="delete({{$box->id}})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded-full">
                                Hapus
                            </button>

                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>

       
    </div>
</div>
