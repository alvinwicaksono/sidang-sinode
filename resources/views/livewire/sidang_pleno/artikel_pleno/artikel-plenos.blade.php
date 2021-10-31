
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('ARTIKEL SIDANG PLENO') }}
    </h2>
</x-slot>


<div style="margin-top: 50px;" class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-5">

{{--        <div>--}}
{{--        @if(session()->has('toast_success'))--}}
{{--        @endif--}}
    
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="button-table">
            @if($isOpen)
                <a wire:click="hideModal()" class="myButton"><i class="fas fa-minus"></i></i> Batalkan</a>
             @else
                 <a wire:click="showModal()" class="myButton"><i class="fas fa-plus"></i></i> Tambah</a>
           @endif 
                   
                <input type="text" class="form-control float-right mt-5 mr-5 search-custom" placeholder='Cari' wire:model="search">
            </div>
            
            @if($isOpen)
                @include('livewire.sidang_pleno.artikel_pleno.create')
            @endif

            @if($isOpenView)
                @include('livewire.sidang_pleno.artikel_pleno.view')
            @endif

           
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nomor Artikel
                    </th>
                    <th scope="col" class="px-15 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Judul
                    </th>
                    <th scope="col" class="px-15 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Seksi 
                    </th>
                    <th scope="col" class="px-15 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th scope="col" class="relative px-2 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
              @foreach ($artikel_seksis as $key => $artikel_seksi)
                    <tr>
                    <td class="px-6 py-4 text-center whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $artikel_seksis->firstItem() + $key }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{$artikel_seksi->nomor_artikel_seksi}}</div>
                    </td>
                    <td class="px-15 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{$artikel_seksi->judul}}</div>
                    </td>
                    <td class="px-15 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{$artikel_seksi->seksi->nama}}</div>
                    </td>
                    <td class="px-15 py-4 whitespace-nowrap">
                        @if($artikel_seksi->verified)
                        <div class="text-sm font-medium text-gray-900">Terverifikasi</div>
                        @else
                        <div class="text-sm font-medium text-gray-900">Belum Terverifikasi</div>
                        @endif
                    </td>
                    <td class="px-15 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900"></div>
                    </td>
                    <td class="px-2 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <a wire:click="view({{$artikel_seksi->ap_id}})" class="margin-right-custom custom-green"><i class="far fa-eye"></i></a>
                        @if(!$artikel_seksi->nomor_artikel_seksi)
                        <a wire:click="" class="margin-both-custom custom-blue"><i class="far fa-edit"></i></a>
                        <a wire:click="" class="margin-left-custom custom-red"><i class="fas fa-trash-alt"></i></a>
                        @endif
                    </td>
                    </tr>
                     @endforeach  
                </tbody>
                </table>

                <div class="pagination-custom">
                   {{$artikel_seksis->links()}}
                </div>
                
                
            </div>
            </div>
        </div> 
    
    </div>

</div>
