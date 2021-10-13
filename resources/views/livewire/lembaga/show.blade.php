<div class="fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!--
          Background overlay, show/hide based on modal state.

          Entering: "ease-out duration-300"
            From: "opacity-0"
            To: "opacity-100"
          Leaving: "ease-in duration-200"
            From: "opacity-100"
            To: "opacity-0"
        -->
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
        <!--
          Modal panel, show/hide based on modal state.

          Entering: "ease-out duration-300"
            From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            To: "opacity-100 translate-y-0 sm:scale-100"
          Leaving: "ease-in duration-200"
            From: "opacity-100 translate-y-0 sm:scale-100"
            To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        -->

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form>
                <div class="bg-white  px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex items-center w-full mb-4" >
                        <div class="text-gray-900 font-medium text-lg">Detail Lembaga</div>
                        <svg wire:click="hideDetail()" class="ml-auto fill-current text-gray-700 w-6 h-6 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"/>
                        </svg>
                    </div>
                    <hr>

                    <div>
                        <div class="mt-4">
                            <label for="kode_lembaga" class="block">Kode Lembaga</label>
                            <h2 class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">{{$lembaga->kode_lembaga}}</h2>
                        </div>
                        <div class="mb-2">
                            <label for="nama_lembaga" class="block">Nama Lembaga</label>
                            <p class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">{{$lembaga->nama_lembaga}}</p>
                        </div>

                        <div class="-mx-3 md:flex mb-6">
                            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                <label for="tgl_berdiri" class="block">Tahun Buka</label>
                                <p class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">{{$lembaga->tgl_berdiri}}</p>
                            </div>
                            <div class="md:w-1/2 px-3">
                                <label for="status" class="block">Status</label>
                                <p class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">{{$lembaga->status}}</p>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label for="alamat" class="block">Alamat</label>
                            <p class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">{{$lembaga->alamat}}</p>
                        </div>
                        <div class="mb-2">
                            <label for="klasisId" class="block">Klasis</label>
                            <p class="shadow  border rounded w-full mb-2 py-2 px-3 text-black">{{$lembaga->Klasis->nama_klasis}}</p>

                        </div>

                    </div>


                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
{{--        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">--}}
{{--          <button wire:click="edit({{$lembaga->id}}})" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">--}}
{{--            Edit--}}
{{--          </button>--}}
{{--        </span>--}}
{{--                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">--}}
{{--          <button wire:click="hideDetail()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">--}}
{{--            Cancel--}}
{{--          </button>--}}

{{--        </span>--}}
                </div>
            </form>
        </div>

    </div>
</div>




<div class="">Apakah anda yakin akan menghapus ini?</div>
<hr>
<div class="ml-auto">
    <button wire:click="delete()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
        Hapus
    </button>
    <button class="bg-transparent hover:bg-gray-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
        Batal
    </button>
</div>
