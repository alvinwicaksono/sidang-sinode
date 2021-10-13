<div class="mb-10">
<form>
    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="mb-4 ">
            <h3 class="text-center font-bold">Tambah Dokumen</h3>
            <hr>
        </div>


        <div>

            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-1/3 px-3 mb-6 md:mb-0">
                    <label for="kode_document" class="lock uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">Kode Dokumen</label>
                    <input wire:model="kode_document" type="text"  name="kode_document" class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">
                </div>
                <div class="md:w-2/3 px-3">
                    <label for="nama_document" class="ck uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">Nama Dokumen</label>
                    <input wire:model="nama_document" type="text" name="nama_document" class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">
                </div>
            </div>

            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                    <label for="tanggal_buat" class="ck uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">Tanggal Buat</label>
                    <input wire:model="tanggal_buat" type="date" name="tanggal_buat" class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">
                </div>
                <div class="md:w-1/2 px-3">
                    <label for="tanggal_masuk" class="ck uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">Tanggal Masuk</label>
                    <input wire:model="tanggal_masuk" type="date" name="tanggal_masuk" class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">
                </div>
            </div>

            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                    <label for="pengarang" class="ck uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">Pengarang</label>
                    <input wire:model="pengarang" type="text" name="pengarang" class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">
                </div>
                <div class="md:w-1/2 px-3">
                    <label for="keterangan" class="ck uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">Keterangan</label>
                    <input wire:model="keterangan" type="text" name="keterangan" class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">
                </div>
            </div>

            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                    <label for="lembagaId" class="ck uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">Lembaga</label>
                    <input list="lembagaId" wire:model="lembagaId" name="lembagaId" class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">
                    <datalist id="lembagaId">
                        @foreach($lembaga as $lembaga)
                            <option value="{{ $lembaga->nama_lembaga }}">
                        @endforeach
                    </datalist>
                </div>
                <div class="md:w-1/2 px-3">
                    <label for="subbidangId" class="ck uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">Sub Bidang</label>
                    <input list="subbidangId" wire:model="subbidangId" name="subbidangId" class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">
                    <datalist id="subbidangId">
                        @foreach($subbidang as $subbidang)
                            <option value="{{ $subbidang->nama_subBidang }}">
                        @endforeach
                    </datalist>
                </div>
            </div>

            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-1/3 px-3 mb-6 md:mb-0">
                    <label for="batas_akses" class="ck uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">Batas Akses</label>
                    <input list="batas_akses" wire:model="batas_akses" name="batas_akses" class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">
                    <datalist id="batas_akses">
                        <option value="Rahasia">
                        <option value="Terbatas">
                        <option value="Umum">
                    </datalist>
                </div>
                <div class="md:w-1/3 px-3">
                    <label for="boxId" class="ck uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">Box</label>
                    <input list="boxId" wire:model="boxId" name="boxId" class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">
                    <datalist id="boxId">
                        @foreach($box as $box)
                            <option value="{{ $box->nama_box }}">
                        @endforeach
                    </datalist>
                </div>
                <div class="md:w-1/3 px-3">
                    <label for="formatId" class="ck uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">Format</label>
                    <input list="formatId" wire:model="formatId" name="formatId" class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">
                    <datalist id="formatId">
                        @foreach($format as $format)
                            <option value="{{ $format->nama_format }}">
                        @endforeach
                    </datalist>
                </div>
                <div class="w-1/4 px-3">
                    <label for="jumdok" class="ck uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">jumlah dokumen</label>
                    <input wire:model="jumdok" type="integer" name="jumdok" class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">

                </div>
            </div>
            <div class="mb-2">
                <label for="file" class="ck uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">File</label>
                <input wire:model="file" type="file" name="file" class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-black">
            </div>
        </div>


    </div>
    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
          <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
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
