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
                        <h3 class="text-center font-bold">Edit Data {{$nama}}</h3>
                        <hr>
                    </div>


                    <div>
                        <input wire:model="userId" type="hidden" name="kode_user" class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">

                        <div class="mb-2">
                            <label for="judul_materi" class="block">Nama (Mininmal 3 Karakter)</label>
                            <input wire:model="nama" type="text" placeholder="Masukan Nama" name="nama" class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                          </div>
                        <div class="mb-2">
                            <label for="isi_materi" class="block">Email</label>
                            <input wire:model="email" type="text" placeholder="Masukan Email" name="email" class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">
                        </div>
                        <div class="mb-2">
                            <label class="block">Seksi</label>
                            <div class="select">
                              <select wire:model="seksi_id" name="seksi_id">
                                  <option value="" disabled selected>Pilih Seksi</option>
                                  @foreach ($seksis as $seksi)
                                  <option value="{{ $seksi->id }}">{{ $seksi->nama_seksi }}</option>
                                  @endforeach
                              </select>
                              <div class="select_arrow">
                              </div>
                          </div>
                        </div>
                        <div class="mb-2">
                            <label class="block">Role</label>
                            <div class="select">
                              <select wire:model="role" name="role">
                                  <option value="" disabled selected>Pilih Role</option>
                                  <option value="Admin">Admin</option>
                                  <option value="Ketua">Ketua</option>
                                  <option value="Sekretaris Moderamen">Sekretaris Moderamen</option>
                                  <option value="Sekretaris Seksi">Sekretaris Seksi</option>
                                  <option value="Gereja Penghimpun">Gereja Penghimpun</option>
                              </select>
                              <div class="select_arrow">
                              </div>
                          </div>
                        </div>
                    </div>


                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
          <button wire:click="update()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
            Submit
          </button>
        </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
          <button wire:click="hideModalUpdate()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
            Cancel
          </button>

        </span>
                </div>
            </form>
        </div>

    </div>
</div>
