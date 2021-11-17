
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
                <div class="button-table text-right">
                    <a class="myButton" href="{{ URL::to('/artikelPleno-pdf') }}"><i class="fas fa-download"></i> PDF</a>
                </div>
            <div class="button-table">
            @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Sekretaris Moderamen')
                    @if ($sidangs->status == 'Sidang')
                        @if($isOpen)
                            <a wire:click="hideModal()" class="myButton"><i class="fas fa-minus"></i></i> Batalkan</a>
                        @else
                            <a wire:click="showModal()" class="myButton"><i class="fas fa-plus"></i></i> Tambah</a>
                        @endif 
                    @else
                    <a class="myButtonGrey"><i class="fas fa-plus"></i> Tambah</a>
                    @endif
                    <input type="text" class="form-control float-right mt-5 mr-5 search-custom" placeholder='Cari' wire:model="search">
                @else
                    <input type="text" class="form-control mt-5 mr-5 search-custom" placeholder='Cari' wire:model="search">
             @endif
            </div>
            
            @if($isOpen)
                @include('livewire.sidang_pleno.artikel_pleno.create')
            @endif

            @if($isOpenView)
                @include('livewire.sidang_pleno.artikel_pleno.view')
            @endif

            @if($isOpenEdit)
                @include('livewire.sidang_pleno.artikel_pleno.edit')
            @endif

            @if($isOpenDelete)
                @include('livewire.sidang_pleno.artikel_pleno.delete')
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
                    @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Sekretaris Moderamen' || Auth::user()->role == 'Sekretaris Seksi')
                        @if ($sidangs->status == 'Sidang')
                            <th scope="col" class="relative px-2 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                            <th scope="col" class="relative px-2 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        @endif
                    @endif
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
                        <div class="text-sm font-medium text-gray-900">{{$artikel_seksi->nomor_artikel}}</div>
                    </td>
                    <td class="px-15 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{$artikel_seksi->judul}}</div>
                    </td>
                    <td class="px-15 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{$artikel_seksi->seksi->nama}}</div>
                    </td>
                    <td class="px-15 py-4 whitespace-nowrap">
                        @if($artikel_seksi->verified)
                        <div class="text-sm font-medium text-gray-900 custom-green ">Terverifikasi</div>
                        @else
                        <div class="text-sm font-medium text-gray-900 custom-red">Belum Terverifikasi</div>
                        @endif
                    </td>
                    <td class="px-15 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900"></div>
                    </td>
                    <td class="px-2 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <a wire:click="view({{$artikel_seksi->ap_id}})" class="margin-right-custom custom-green"><i class="far fa-eye"></i></a>
                    </td>
                    @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Sekretaris Moderamen' || Auth::user()->role == 'Sekretaris Seksi')
                        @if ($sidangs->status == 'Sidang')
                            @if(!$artikel_seksi->nomor_artikel)
                                <td class="px-2 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <a wire:click="edit({{$artikel_seksi->ap_id}})" class="margin-both-custom custom-blue"><i class="far fa-edit"></i></a>
                                </td>
                                <td class="px-2 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <a wire:click="remove({{$artikel_seksi->ap_id}})" class="margin-left-custom custom-red"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            @else
                                <td class="px-2 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <a wire:click="" class="margin-both-custom custom-grey"><i class="far fa-edit"></i></a>
                                </td>
                                <td class="px-2 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <a wire:click="" class="margin-left-custom custom-grey"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            @endif
                        @endif
                    @endif

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
