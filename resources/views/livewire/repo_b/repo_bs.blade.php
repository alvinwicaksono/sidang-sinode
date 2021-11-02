
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Repositori B') }}
    </h2>
    <h4>
        <b>Sidang :</b> {{$sidangs->akta_sidang}} ({{$sidangs->status}})
    </h4>
</x-slot>


<div style="margin-top: 50px;" class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-5">

{{--        <div>--}}
{{--        @if(session()->has('toast_success'))--}}
{{--        @endif--}}
    
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="button-table">
                @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Sekretaris Moderamen')
                    @if ($sidangs->status == 'Pra Sidang')
                    <a wire:click="showModal()" class="myButton"><i class="fas fa-plus"></i></i> Tambah</a>
                    @else
                    <a class="myButtonGrey"><i class="fas fa-plus"></i></i> Tambah</a>
                    @endif
                    <input type="text" class="form-control float-right mt-5 mr-5 search-custom" placeholder='Cari' wire:model="search">
                @else
                    <input type="text" class="form-control mt-5 mr-5 search-custom" placeholder='Cari' wire:model="search">
                @endif
                </div>
            
            @if($isOpen) 
                @include('livewire.repo_b.create')
            @endif
            @if($isOpenEdit) 
                @include('livewire.repo_b.edit')
            @endif
            @if($isOpenView)
                @include('livewire.repo_b.view')
            @endif
            @if($isOpenDelete)
                @include('livewire.repo_b.delete')
            @endif

            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                    <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        No.
                    </th>
                    <th scope="col" class="px-8 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Judul Materi
                    </th>
                    <th scope="col" class="px-8 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Seksi
                    </th>
                    <th scope="col" class="px-8 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th scope="col" class="relative px-2 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                    @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Sekretaris Moderamen')
                    <th scope="col" class="relative px-2 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                    <th scope="col" class="relative px-2 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                    @endif
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($repo_bs as $key => $repo_b)
                    <tr>
                    <td class="px-3 py-4 text-center whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $repo_bs->firstItem() + $key }}</div> 
                    </td>
                    <td class="px-8 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{$repo_b->judul}}</div>      
                    </td>
                    <td class="px-8 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{$repo_b->seksi->nama}}</div>
                    </td>
                    <td class="px-8 py-4 whitespace-nowrap">
                        @if ($repo_b->stat == 'Belum Terbahas')
                        <div class="text-sm font-medium text-gray-900 custom-red">{{$repo_b->stat}}</div>
                        @else
                        <div class="text-sm font-medium text-gray-900 custom-green">{{$repo_b->stat}}</div>
                        @endif
                    </td>
                @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Sekretaris Moderamen')
                    <td class="px-2 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <a wire:click="view({{$repo_b->rb_id}})" class="custom-green"><i class="far fa-eye"></i></a>
                    </td>
                    @if ($sidangs->status == 'Pra Sidang')
                    <td class="px-2 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <a wire:click="edit({{$repo_b->rb_id}})" class="custom-blue"><i class="far fa-edit"></i></i></a>
                    </td>
                    <td class="px-2 py-4 whitespace-nowrap text-center text-sm font-medium">
                        @if ($repo_b->stat == 'Belum Terbahas')
                        <a wire:click="remove({{$repo_b->rb_id}}, {{$repo_b->repoa_id}})" class="custom-red"><i class="fas fa-trash-alt"></i></a>
                        @else
                        <a class="custom-grey"><i class="fas fa-trash-alt"></i></a>
                        @endif
                    </td>
                    @else
                    <td class="px-2 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <a class="custom-grey"><i class="far fa-edit"></i></i></a>
                    </td>
                    <td class="px-2 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <a class="custom-grey"><i class="fas fa-trash-alt"></i></a>
                    </td>
                    @endif
                @else
                    <td class="px-2 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <a wire:click="view({{$repo_b->rb_id}})" style="margin-right: 20px;" class="custom-green"><i class="far fa-eye"></i></a>
                    </td>
                @endif
                    </tr>
                @endforeach
                </tbody>
                </table>

                <div class="pagination-custom">
                    {{ $repo_bs->links() }}
                </div>
                
            </div>
            </div>
        </div> 
    
    </div>

</div>