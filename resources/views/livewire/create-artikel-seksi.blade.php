        <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Artikel Seksi') }}
    </h2>
    <h4>
        <b>Sidang :</b> {{$sidangs->akta_sidang}} ({{$sidangs->status}})
    </h4>
</x-slot>


<div style="margin-top: 50px;" class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-5">

        <div class="mb-10">
            <form  >
                <div class="bg-white px-8 pt-7 pb-6 sm:p-6 sm:pb-4">
                    <div class="mb-4 ">
                        <h3 class="text-center font-bold">Tambah Artikel Sidang Seksi</h3>
                        <hr>
                    </div>


                    <div>
                   
                    <input wire:model="repo_aId" type="hidden" class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">

                        
                        <div class="mb-2">
                            <label class="block">Repositori B</label>
                            <div class="select">
                              <select wire:model="repo_bId" name="repo_bId" wire:click="chooseRepoB($event.target.value)">
                                  <option value=""  selected>Pilih Repositori B</option>
                                @foreach ($repobs as $repo_b)
                                  <option value="{{$repo_b->id}}">{{$repo_b->judul_materi}}</option>
                              @endforeach
                              </select>
                              <div class="select_arrow">
                              </div>
                          </div>
                        </div>

                     
                        <input wire:model="repo_bId" type="hidden">
                        <div class="mb-2">
                            <label for="judul" class="block">Judul</label>
                            <input wire:model="judul" type="text" placeholder="Masukan Judul Materi" name="judul" class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">
                        </div>
                        <div wire:ignore class="mb-2">
                            <label for="isi_materi" class="block">Isi Materi</label>
                            <textarea wire:model="isi_materi" name="isi_materi" id="isi_materi" cols="30" rows="10" placeholder="Masukan Isi Materi" disabled class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black disabled"></textarea>
                          </div>
                        <div wire:ignore class="mb-2">
                            <label for="setelah_sidang_bahas" class="block">Setelah Sidang Membahas</label>
                            <textarea wire:model="setelah_sidang_bahas" name="setelah_sidang_bahas" id="setelah_sidang_bahas" cols="30" rows="10" placeholder="Masukan Isi Materi" class="ckeditor form-control"></textarea>
                          </div>
                        <div wire:ignore class="mb-2">
                            <label for="Mengingat" class="block">Mengingat</label>
                            <textarea wire:model="Mengingat" name="Mengingat" id="Mengingat" cols="30" rows="10" placeholder="Masukan Isi Materi" class="ckeditor form-control"></textarea>
                          </div>
                          <div wire:ignore class="mb-2">
                            <label for="Mempertimbangkan" class="block">Mempertimbangkan</label>
                            <textarea wire:model="Mempertimbangkan" name="Mempertimbangkan" id="Mempertimbangkan" cols="30" rows="10" placeholder="Masukan Isi Materi" class="ckeditor form-control"></textarea>
                          </div>
                          <div wire:ignore class="mb-2">
                            <label for="Memutuskan" class="block">Memutuskan</label>
                            <textarea wire:model="Memutuskan" name="Memutuskan" id="Memutuskan" cols="30" rows="10" placeholder="Masukan Isi Materi" class="ckeditor form-control"></textarea>
                          </div>
                         
                        <div class="mb-2">
                            <label for="lampiran" class="block">Lampiran ( Bisa lebih dari 1 )</label>
                            <input wire:model="lampiran" type="file" placeholder="Tambah File" name="lampiran" class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">
                            <div wire:loading wire:target="lampiran">Uploading...</div>
                          </div>
                          <!-- @if ($lampiran)
                              Lampiran Preview:
                              <div class="row">
                                  @foreach ($lampiran as $lampiran)
                                  <div class="col-3 card me-1 mb-1">
                                      <img src="{{ $lampiran->temporaryUrl() }}">
                                      <button class="remove-button" wire:click.prevent="removeImg({{$loop->index}})">
                                          <i class="fas fa-trash-alt"></i> Remove
                                      </button>
                                  </div>
                                  @endforeach
                              </div>
                          @else
                          <div class="lightblue-custom">Lampiran Kosong</div>
                          @endif --> 
                        
                         
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
          <div wire:loading wire:target="store()">Process...</div>

        </span>
                </div>
            </form>
        </div>
 
    </div>
</div>
</div>

