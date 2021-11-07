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
           
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="mb-4 ">
                        <h3 class="text-center font-bold">Repositori A {{$judul_materi}}</h3>
                        <hr>
                    </div>
                    <div>
                      <table class="custom-table-view">
                        <tr>
                            <td><b>Akta Sidang</b></td>
                            <td>:</td>
                            <td> {{$akta_sidang}} ({{$status_sidang}}) </td>
                        </tr>
                        <tr>
                            <td><b>Judul Materi</b></td>
                            <td>:</td>
                            <td> {{$judul_materi}} </td>
                        </tr>
                        <tr>
                            <td><b>Sumber Materi</b></td>
                            <td>:</td>
                            <td> {{$sumber_materi}} </td>
                        </tr>
                        <tr>
                            <td><b>Isi Materi</b></td>
                            <td>:</td>
                            <td><textarea disabled name="" id="" cols="30" rows="10">{{$isi_materi}}</textarea></td>
                        </tr>
                        <tr>
                            <td><b>Status</b></td>
                            <td>:</td>
                            <td> {{$status}} </td>
                        </tr>
                        <tr>
                            <td><b>Lampiran</b></td>
                            @if($attachment == '[]')
                            <td>:</td>
                            <td>-</td>
                            @else
                            <td>:</td>
                            @endif
                        </tr>
                      </table>
                      <div class="mb-2">
                            @foreach (json_decode($attachment) as $lampiran)
                              <img src="<?php echo str_replace('public','storage',$lampiran); ?>"/><br>
                            @endforeach
                          </label>
                      </div>
                        

                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                      
                      <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button wire:click="hideModalView()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                          Close
                        </button>
                      </span>
                    </div>
                </div>
           
        </div>

    </div>
</div>
