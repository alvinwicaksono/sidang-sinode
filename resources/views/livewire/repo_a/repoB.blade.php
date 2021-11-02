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
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="mb-4 ">
                        <h3 class="text-center font-bold">Tambah Repositori B {{$judul_materi}}</h3>
                        <hr>
                    </div>


                    <div>
                        <input wire:model="repoa_id" type="hidden" name="kode_user" class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">
                        <input wire:model="sidang_id" type="hidden" name="kode_user" class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">
                        <div class="mb-2">
                            <label class="block">Repositori A :<b> {{$judul_repo_a}}</b></label>                            
                        </div>
                        <div class="mb-2">
                            <label class="block">Akta Sidang :<b> {{$akta_sidang}}</b> ({{$status}})</label>                            
                        </div>

                        <div class="mb-2">
                            <label for="judul_materi" class="block">Judul Materi<label class="custom-red">*</label></label>
                            <input wire:model="judul_materi" type="text" placeholder="Masukan Judul Materi" name="judul_materi" class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">
                            @error('judul_materi') <span class="error custom-red"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span> @enderror
                          </div>
                        <div class="mb-2">
                            <label for="isi_materi" class="block">Isi Materi<label class="custom-red">*</label></label>
                            <textarea wire:model="isi_materi" name="isi_materi" id="isi_materi" cols="30" rows="10" placeholder="Masukan Isi Materi" class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black"></textarea>
                            @error('isi_materi') <span class="error custom-red"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span> @enderror
                          </div>
                        <div class="mb-2">
                            <label class="block">Seksi<label class="custom-red">*</label></label>
                            <div class="select">
                              <select wire:model="seksi_id" name="seksi_id">
                                  <option value="" disabled selected>Pilih Seksi</option>
                                  @foreach ($seksis as $seksi)
                                  <option value="{{ $seksi->id }}">{{ $seksi->nama }}</option>
                                  @endforeach
                              </select>
                              <div class="select_arrow">
                              </div>
                          </div>
                          @error('seksi_id') <span class="error custom-red"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span> @enderror
                        </div>
                        <div class="mb-2">
                            <label for="attachment" class="block">Lampiran ( Bisa lebih dari 1 )</label>
                            <input wire:model="attachment" type="file" placeholder="Tambah File" name="attachment" class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">
                            @error('attachment') <span class="error custom-red"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span> @enderror
                            <div wire:loading wire:target="attachment">Uploading...<div class="loader"></div></div>
                        </div>
                        @if ($attachment)
                        <label class="block lightblue-custom"><b>Lampiran Baru Preview :</b></label>
                        <div class="row">
                            @foreach ($attachment as $image)
                            <div class="col-3 card me-1 mb-1">
                                <img src="{{ $image->temporaryUrl() }}">
                                <button class="remove-button" wire:click.prevent="removeImg({{$loop->index}})">
                                  <i class="fas fa-trash-alt"></i> Remove
                                </button>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        <br>
                        <div class="mb-2">
                          <label class="block"><b>Lampiran Yang Sudah Ada :</b>
                            @foreach (json_decode($attachmentString) as $lampiran)
                              <img src="<?php echo str_replace('public','storage',$lampiran); ?>"/><br>
                            @endforeach
                          </label>
                        </div>

                 
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
          <button wire:click="storeRepoB()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
            Submit
          </button>
        </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
          <button wire:click="hideModalRepoB()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
            Cancel
          </button>
          <div wire:loading wire:target="storeRepoB()">Process...<div class="loader"></div></div>

        </span>
                </div>
            </form>
        </div>

    </div>
</div>
