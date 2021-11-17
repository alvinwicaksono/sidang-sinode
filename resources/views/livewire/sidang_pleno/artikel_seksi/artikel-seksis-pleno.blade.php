
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('ARTIKEL SEKSI') }}
    </h2>
</x-slot>


<div style="margin-top: 50px;" class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-5">

{{--        <div>--}}
{{--        @if(session()->has('toast_success'))--}}
{{--        @endif--}}
    
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="button-table align-right">
         
                   
                <input type="text" class="form-control mt-5 ml-5 search-custom" placeholder='Cari' wire:model="search">
            </div>
            
            @if($isOpen)
                @include('livewire.sidang_pleno.artikel_seksi.create')
            @endif

            @if($isOpenView)
                @include('livewire.sidang_pleno.artikel_seksi.view')
            @endif

           
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nomor Artikel Seksi
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
                        <div class="text-sm font-medium text-grey-900 custom-green">Terverifikasi</div>
                        @else
                        <div class="text-sm font-medium text-grey-900 custom-red">Belum Terverifikasi</div>
                        @endif
                    </td>
                    @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Sekretaris Moderamen')
                        @if ($sidangs->status == 'Sidang')
                            <td class="px-2 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        <a wire:click="createPleno({{$artikel_seksi->as_id}})" class="myButton-addRepoB">Pleno</a> 
                                    </div>
                                </td>
                        @endif
                    @endif
                    <td class="px-2 py-4 whitespace-nowrap text-center text-sm font-medium">
                        
                        <a wire:click="view({{$artikel_seksi->as_id}})" class="margin-right-custom custom-green"><i class="far fa-eye"></i></a>
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
