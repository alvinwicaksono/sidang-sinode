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
            <form autocomplete="off">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="mb-4 ">
                        <h3 class="text-center font-bold">Repo A</h3>
                        <hr>
                    </div>


                    <div>
                        <input wire:model="repo_aId" type="hidden" class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">

                        <div class="mb-2">
                            <label class="block">Sidang</label>
                            <div class="select">
                              <select wire:model="sidang_id" name="sidang_id">
                                  <option value="" disabled selected>Pilih Seksi</option>
                                  @foreach ($sidangs as $sidang)
                                  <option value="{{ $sidang->id }}">{{ $sidang->akta_sidang }}</option>
                                  @endforeach
                              </select>
                              <div class="select_arrow">
                              </div>
                          </div>
                        </div>
                        <div class="mb-2">
                            <label for="judul_materi" class="block">Judul Materi</label>
                            <input wire:model="judul_materi" type="text" placeholder="Masukan Judul Materi" name="judul_materi" class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">
                        </div>
                        <div class="mb-2">
                            <label for="isi_materi" class="block">Isi Materi</label>
                            <input wire:model="isi_materi" type="text" placeholder="Masukan Isi Materi" name="isi_materi" class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">
                        </div>
                        <div class="mb-2">
                            <label for="sumber_materi" class="block">Sumber Materi</label>
                            <input wire:model="sumber_materi" type="text" placeholder="Masukan Sumber Materi" name="sumber_materi" class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">
                        </div>
                        <div class="mb-2">
                            <label for="attachment" class="block">Lampiran</label>
                            <input wire:model="attachment" type="file" placeholder="Masukan Lampiran" name="attachment" class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">
                        </div>
                        
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
          <button wire:click="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
            Submit
          </button>
        </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
          <button wire:click="hideModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
            Cancel
          </button>

        </span>
                </div>
            </form>
        </div>

    </div>
</div>