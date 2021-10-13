


<div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-5">



    {{--        <div>--}}
    {{--        @if(session()->has('toast_success'))--}}
    {{--        @endif--}}
    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
        <button wire:click="showModal()" class="bg-green-500 mt-4 mb-4 hover:bg-green-700 text-white font-bold py-1 px-4 rounded-full">
            Tambah Lembaga
        </button>
        @if($isOpen)

            @include('livewire.lembaga.create')
        @endif
        <table class="table-fix w-full">
            <thead class="bg-blue-100">
            <tr>
                <th class="px-4 py-2">No</th>
                <th class="px-4 py-2">Kode lembaga</th>
                <th class="px-4 py-2">Nama lembaga</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Action</th>

            </tr>
            </thead>
            <tbody>
            @foreach($lembagas as $lembaga)
                <tr>
                    <td class="border px-4 py-2 text-center">1</td>
                    <td class="border px-4 py-2 text-center">{{$lembaga->kode_lembaga}}</td>
                    <td class="border px-4 py-2 text-center">{{$lembaga->nama_lembaga}}</td>
                    <td class="border px-4 py-2 text-center">{{$lembaga->status}}</td>
                    <td class="border px-4 py-2 text-center">
                        <button wire:click="showDetail({{$lembaga->id}})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded-full">
                            Show
                        </button>
                        @if($isDetail)
                            @include('livewire.lembaga.show')
                        @endif
                        <button wire:click="edit({{$lembaga->id}})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded-full">
                            Edit
                        </button>
                        <button wire:click="delete({{$lembaga->id}})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded-full">
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
</div>
</div>

