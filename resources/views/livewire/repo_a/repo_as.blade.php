
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Repo A') }}
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
                <a wire:click="showModal()" class="myButton"><i class="fas fa-plus"></i> Tambah</a>
                <input type="text" class="form-control float-right mt-5 mr-5 search-custom" placeholder='Cari' wire:model="search">
            </div>
            
            @if($isOpen)
                @include('livewire.repo_a.create')
            @endif
            @if($isOpenEdit)
                @include('livewire.repo_a.edit')
            @endif
            @if($isOpenRepoB)
                @include('livewire.repo_a.repoB')
            @endif
            @if($isOpenView)
                @include('livewire.repo_a.view')
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
                        Sumber Materi
                    </th>
                    <th scope="col" class="px-8 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th scope="col" class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    </th>
                    <th scope="col" class="relative px-2 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                    <th scope="col" class="relative px-2 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                    <th scope="col" class="relative px-2 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($repo_as as $key => $repo_a)
                    <tr>
                    <td class="px-3 py-4 text-center whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $repo_as->firstItem() + $key }}</div>
                    </td>
                    <td class="px-8 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{$repo_a->judul_materi}}</div>
                    </td>
                    <td class="px-8 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{$repo_a->sumber_materi}}</div>
                    </td>
                    <td class="px-8 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{$repo_a->status}}</div>
                    </td>
                    <td class="px-2 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">
                            <a wire:click="createRepoB({{$repo_a->ra_id}})" class="myButton-addRepoB">RepoB</a> 
                        </div>
                    </td>
                    <td class="px-2 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <a wire:click="view({{$repo_a->ra_id}})" class="custom-green"><i class="far fa-eye"></i></a>
                    </td>
                    <td class="px-2 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <a wire:click="edit({{$repo_a->ra_id}})" class="custom-blue"><i class="far fa-edit"></i></a>
                    </td>
                    <td class="px-2 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <a wire:click="delete({{$repo_a->ra_id}})" class="custom-red"><i class="fas fa-trash-alt"></i></a>
                    </td>
                    </tr>
                @endforeach
                </tbody>
                </table>

                <div class="pagination-custom">
                    {{ $repo_as->links() }}
                </div>
                
            </div>
            </div>
        </div> 
    
    </div>

</div>