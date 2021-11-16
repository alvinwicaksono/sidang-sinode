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
              <h3 class="card-title" style="text-align:center">Akta Sidang</h3>
              <h3 class="card-title" style="text-align:center">{{ $sidang->akta_sidang}} </h3>
              <h3 class="card-title" style="text-align:center">GEREJA-GEREJA KRISTEN JAWA</h3>
              <h3 class="card-title" style="text-align:center">{{$sidang->penyelenggara}}</h3>
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
            </div>
            <hr>
            </div>

            <div style="page-break-before: always;"></div>
<div class="card-body">
@foreach ($artikels as $artikel)
<!-- Main content -->

  <div class="card">
    <div class="card-body ">
      <div class="mb-3">
        <a>
            <h3 style="text-align:center">
              <b>Artikel {{$artikel->nomor_artikel}}</b>
            </h3>
            <h3 style="text-align:center">{{$artikel->judul}}</h3>

            <p style="white-space: pre-wrap;">
            @if($artikel->setelah_sidang_bahas != null)
            </p>
            <h4>Setelah Sidang Membahas : </h4>
            {!! $artikel->setelah_sidang_bahas !!}<br>
            @endif
            @if($artikel->Mengingat != null)
            <h4>Mengingat :</h4>
            {!! $artikel->Mengingat !!}<br>
            @endif
            @if($artikel->Mempertimbangkan != null)
            <h4>Mempertimbangkan :</h4>
            {!! $artikel->Mempertimbangkan !!}<br>
            @endif
            @if($artikel->Memutuskan != null)
            <h4>Memutuskan :</h4>
            {!! $artikel->Memutuskan !!}
            @endif
        </a>
      </div>
    </div>
  </div>
  <br><br><br>
@endforeach

    <br><br><br><br><br>

    <p style="text-align:center">{{$sidang->tempat}}, {{ date('d F Y', strtotime($sidang->periode_akhir))}} </p>
    <p style="text-align:center">Pemimpin Sidang {{$sidang->akta_sidang}}</p>

    <table style="margin-left:auto; margin-right:auto; margin-top: 40px;">
        @if($ketuas->count() > 0)
        <tr>
            @foreach ($ketuas as $key => $ketua)
                <td style="text-align:center;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ketua {{ ++$key }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
            @endforeach
        </tr>
        <tr>@foreach ($ketuas as $key => $ketua) <td></td>@endforeach</tr>
        <tr>@foreach ($ketuas as $key => $ketua) <td></td>@endforeach</tr>
        <tr>@foreach ($ketuas as $key => $ketua) <td></td>@endforeach</tr>
        <tr>@foreach ($ketuas as $key => $ketua) <td></td>@endforeach</tr>
        <tr>@foreach ($ketuas as $key => $ketua) <td></td>@endforeach</tr>
        <tr>@foreach ($ketuas as $key => $ketua) <td></td>@endforeach</tr>
        <tr>@foreach ($ketuas as $key => $ketua) <td></td>@endforeach</tr>
        <tr>@foreach ($ketuas as $key => $ketua) <td></td>@endforeach</tr>
        <tr>@foreach ($ketuas as $key => $ketua) <td></td>@endforeach</tr>
        <tr>@foreach ($ketuas as $key => $ketua) <td></td>@endforeach</tr>
        <tr>@foreach ($ketuas as $key => $ketua) <td></td>@endforeach</tr>
        <tr>
            @foreach ($ketuas as $key => $ketua)
                <td style="text-align:center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$ketua->nama_pengguna}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            @endforeach
        </tr>
        @else
        <tr>
            <td><b>Ketua</b></td>
        </tr>
        @endif
    </table>
    <table style="margin-left:auto; margin-right:auto; margin-top: 40px;">
        @if($sekretaris->count() > 0)
        <tr>
            @foreach ($sekretaris as $key => $sekret)
                <td style="text-align:center;"><b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sekretaris {{ ++$key }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b></td>
            @endforeach
        </tr>
        <tr>@foreach ($sekretaris as $key => $sekret) <td></td>@endforeach</tr>
        <tr>@foreach ($sekretaris as $key => $sekret) <td></td>@endforeach</tr>
        <tr>@foreach ($sekretaris as $key => $sekret) <td></td>@endforeach</tr>
        <tr>@foreach ($sekretaris as $key => $sekret) <td></td>@endforeach</tr>
        <tr>@foreach ($sekretaris as $key => $sekret) <td></td>@endforeach</tr>
        <tr>@foreach ($sekretaris as $key => $sekret) <td></td>@endforeach</tr>
        <tr>@foreach ($sekretaris as $key => $sekret) <td></td>@endforeach</tr>
        <tr>@foreach ($sekretaris as $key => $sekret) <td></td>@endforeach</tr>
        <tr>@foreach ($sekretaris as $key => $sekret) <td></td>@endforeach</tr>
        <tr>@foreach ($sekretaris as $key => $sekret) <td></td>@endforeach</tr>
        <tr>@foreach ($sekretaris as $key => $sekret) <td></td>@endforeach</tr>
        <tr>
            @foreach ($sekretaris as $key => $sekret)
                <td style="text-align:center;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$sekret->nama_pengguna}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
            @endforeach
        </tr>
        @else
        <tr>
            <td><b>Sekretaris</b></td>
        </tr>
        @endif
    </table>

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
        $text = "Akta Sidang {{$sidang->akta_sidang}} ";
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
