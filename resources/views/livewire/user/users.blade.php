
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('User') }}
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
                <a wire:click="showModal()" class="myButton"><i class="fas fa-plus"></i></i> Tambah</a>
                <input type="text" class="form-control float-right mt-5 mr-5 search-custom" placeholder='Cari' wire:model="search">
            </div>
            
            @if($isOpen)
                @include('livewire.user.create')
            @endif
            @if($isOpenUpdate)
                @include('livewire.user.update')
            @endif
            @if($isOpenPass)
                @include('livewire.user.pass')
            @endif

            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                    <th scope="col" class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Seksi
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Role
                    </th>
                    <th scope="col" class="relative px-2 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($users as $key => $user)
                    <tr>
                    <td class="px-2 py-4 text-center whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $users->firstItem() + $key }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
    
                                <div class="text-sm font-medium text-gray-900">
                                {{$user->nama}}
                                </div>
                                <div class="text-sm text-gray-500">
                                {{$user->email}}
                                </div>
                            
        
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{$user->seksi->nama_seksi}}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{$user->role}}
                    </td>
                    <td class="px-2 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <a wire:click="pass({{$user->us_id}})" class="margin-right-custom custom-green"><i class="fas fa-unlock-alt"></i></a>
                        <a wire:click="edit({{$user->us_id}})" class="margin-both-custom custom-blue"><i class="far fa-edit"></i></a>
                        <a wire:click="delete({{$user->us_id}})" class="margin-left-custom custom-red"><i class="fas fa-trash-alt"></i></a>
                    </td>
                    </tr>
                @endforeach
                </tbody>
                </table>

                <div class="pagination-custom">
                    {{ $users->links() }}
                </div>
                
            </div>
            </div>
        </div> 
    
    </div>

</div>