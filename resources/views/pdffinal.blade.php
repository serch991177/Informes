<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Informe</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap');
        .logo {
            width: 10%;
            text-align: center;
            border: 0px;   
        }
        @page { margin: 108px 80px; font-size:11px !important; line-height: 14px;  }
        header {
            position: fixed;
            top: -108px;
            left: 0px;
            right: 0px;
            height: 108px;
            padding: .5em;
            text-align: center;
        }
        footer {
          /*overflow: hidden;*/
          position: fixed;
          bottom: -0.3cm;
          left: 0cm;
          right: 0cm;
          height: 1cm;            
        }
        #pie_pagina .page:after {
          content: counter(page);
        }
    </style>
    </head>
    <body>

    
          
    
        <header >
          <div  class="logo"  style="width: 20% !important; float:left;">
            @php($image_path1 = public_path() . '/img/escudo.png')
            @php($imageData = base64_encode(file_get_contents($image_path1)))
            @php($src = 'data:' . mime_content_type($image_path1) . ';base64,' . $imageData)
            <img  align="left" src="{{$src}}" height="100px" class="img-fluid">
          </div>
          <div style="width: 50% !important; float:right;">    
            @php($image_path2 = public_path() . '/img/cocha.png')
            @php($imageData2 = base64_encode(file_get_contents($image_path2)))
            @php($src2 = 'data:' . mime_content_type($image_path2) . ';base64,' . $imageData2)
            <img align="right"  src="{{$src2}}" height="60px" class="img-fluid"/> 
          </div>
          <div class="linea" style="border-top: 3px solid #33bbff; height: 20px; max-width: 2000px; padding: 0; margin: 100px auto 0 auto;"></div>
        </header>
        <!--footer style="padding:1em;"-->
        

        <!-- Define header and footer blocks before your content -->
       

        <footer style="bottom: -0.6cm;left: 0cm;right: 0cm;height: 1cm;color: black ;text-align: left;line-height: 10px;">
          <div class="linea2" style="border-top: 3px solid #33bbff; height: 1px; max-width: 800px; padding: 0; margin: -7px auto 0 auto;"></div>
          <div style="left: 0cm; right: 0cm; height: 1cm; color: black ; text-align: left; line-height: 10px;" >
          <table style="width:84%; height:84%; " cellspacing="0" border="1">
              <tr>
                  
                 
                  @php($arr=(json_decode($informe->usuario, true)))
                  @php($json_convertido = json_decode($arr)) 
                  @foreach($json_convertido as $json_convertidos)
                  <th >{{$json_convertidos->cargo}}</th>
                  @endforeach
              </tr>
              <tr>
              @php($arr=(json_decode($informe->usuario, true)))
                  @php($json_convertido = json_decode($arr)) 
                  @foreach($json_convertido as $json_convertidos)
                  @php($image_pathfooter = public_path() . '/imagenes/'.$json_convertidos->firma)
                  @php($imageDatafooter = base64_encode(file_get_contents($image_pathfooter)))
                  @php($srcfooter = 'data:' . mime_content_type($image_pathfooter) . ';base64,' . $imageDatafooter)
                  <td align="center"><img src="{{$srcfooter}}" width="50" height="50" alt="Firma"></br>{{$json_convertidos->nombre}}</td>
                  @endforeach
              </tr>
          </table>
          </div>
          <div style="position:relative; right:-580px; top: -40px; width: 35% !important;">
            <img  src="https://upload.wikimedia.org/wikipedia/commons/d/d7/Commons_QR_code.png" width="31%" /> 
            <br><br>
            <div id="pie_pagina" >
              <span style="font-size: 1.3pc;">Pág. </span><snap  style="font-size: 1.3pc;" class="page"></snap>      
            </div>
          </div>
        </footer>
       

        

        <!-- Wrap the content of your PDF inside a main tag -->

       


        <main>
            <br>
            <!--<span style="font-size:1pc;">Cochabamba, 1 de Marzo de 2023 </span>-->
            <span style="font-size:1pc;">Cochabamba, {{$fechaformateada}}</span>
            <h2 style="line-height: 0cm;">GAMC-CM-CE-505/2022</h2><br><br>

            <span style="font-size:1pc; line-height: 0.5cm;">A:</span><br>
            <span style="font-size:1pc; line-height: 0.5cm;">{{$informe->nombre_dirigido}}</span><br>
            <span style="font-size:1pc; line-height: 0.5cm;"><strong>{{$informe->cargo_dirigido}}</strong></span><br>
            <span style="font-size:1pc; line-height: 0.5cm;"><strong>{{$informe->unidad_dirigido}}</strong></span><br>
            <span style="font-size:1pc; line-height: 0.5cm;">De:</span><br>
            @php($arr=(json_decode($informe->usuario, true)))
            @php($json_convertido = json_decode($arr)) 
            @foreach($json_convertido as $json_convertidos)
            <span style="font-size:1pc; line-height: 0.5cm;">{{$json_convertidos->nombre}}</span><br>
            <span style="font-size:1pc; line-height: 0.5cm;"><strong>{{$json_convertidos->cargo}}</strong></span><br>
            <span style="font-size:1pc; line-height: 0.5cm;"><strong>{{$json_convertidos->unidad}}</strong></span><br>
            @endforeach
            <span style="font-size:1pc; line-height: 0.5cm;">Presente.</span><br>
            <span style="font-size:1pc; line-height: 1cm;" >Ref.:&nbsp;&nbsp;&nbsp;<strong><u>{{$informe->referencia}}</u></strong></span>
            <span style="font-size: 11pt">{!! $informe->dato_informe !!}</span>
        </main>

        

    </body>
    
</html>