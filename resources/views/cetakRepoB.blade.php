<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style type="text/css">
        @page{
            margin: 2cm,2cm,2cm,1.8cm;
        }

        .1{
            float: left;
            width : 50%;
            height : 100px;

        }
        .2{
            float: right;
            width : 50%;
            height: 100px;



        }
    </style>

</head>
<body>

<div class="card-header">
              <h3 class="card-title" style="text-align:center">Materi Sidang</h3>
              <h3 class="card-title" style="text-align:center">{{ $sidang->akta_sidang}} </h3>
              <h3 class="card-title" style="text-align:center">GEREJA-GEREJA KRISTEN JAWA</h3>

              <hr>

            <div class="logo" style="text-align:center; margin: 4em 1em 1em 1em";>
            <?php
                $path = "https://sidang.sinodegkj.or.id/admin/dist/img/AdminLTELogo.png";
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                ?>
                <img src="<?php echo $base64?>" width="200" height="200"/>
            </div>



            <div class="info" style="text-align:center; margin: 3em 1em 1em 1em;">

			      <h5>{{ $sidang->tempat}}</h5>
			      <h5>{{ date('d F Y', strtotime($sidang->periode_awal))}} - {{ date('d F Y', strtotime($sidang->periode_akhir))}}</h5>
            <h5>Gereja Penghimpun: {{$sidang->penghimpun}}</h5>

            </div>
            <hr>
            </div>

            <div style="page-break-before: always;"></div>
<div class="card-body">
@foreach ($repo_b as $repo)
<!-- Main content -->

  <div class="card">
    <div class="card-body ">
      <div class="mb-3">
        <a>
            <h4 style="text-align:center">{{$repo->judul}}</h4>

            @if($repo->sumber != null)
            <h5>Sumber Materi : </h5>
            <p style="white-space: pre-wrap;">{!! $repo->sumber !!}</p>
            @endif
            @if($repo->isi != null)
            <h5>Isi Materi :</h5>
            <p style="white-space: pre-wrap;">{!! $repo->isi !!}</p>
            @endif
        </a>
      </div>
    </div>
  </div>
  <br>
@endforeach

</div>


</body>

<script type="text/php">
    if (isset($pdf) ) {
        // OLD
        // $font = Font_Metrics::get_font("helvetica", "bold");
        // $pdf->page_text(72, 18, "{PAGE_NUM}", $font, 6, array(255,0,0));
        // v.0.7.0 and greater
        $x = 15;
        $y = 580;
        $text = "Materi Sidang - {{$sidang->akta_sidang}} ";
        $font = $fontMetrics->get_font("helvetica", "bold");
        $size = 10;
        $color = array(0,0,0);
        $word_space = 0.0;  //  default
        $char_space = 0.0;  //  default
        $angle = 0.0;   //  default
        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
    }
    if (isset($pdf) ) {
        // OLD
        // $font = Font_Metrics::get_font("helvetica", "bold");
        // $pdf->page_text(72, 18, "{PAGE_NUM}", $font, 6, array(255,0,0));
        // v.0.7.0 and greater
        $x = 380;
        $y = 580;
        $text = " {PAGE_NUM}";
        $font = $fontMetrics->get_font("helvetica", "bold");
        $size = 10;
        $color = array(0,0,0);
        $word_space = 0.0;  //  default
        $char_space = 0.0;  //  default
        $angle = 0.0;   //  default
        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
    }
    </script>
</html>
