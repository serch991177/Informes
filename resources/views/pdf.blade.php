<html lang="en">
    <head>
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
          .item{
            height:40px;
            padding:2em;
            margin:1em;
            background-color:#b30089;
            color:white;
          }

          .tabla_firmas {
            /*position: fixed;*/
            
            /**background-color: #2a0927;**/
           
            /**float:left;*/
          }
          
          .qr_page{
            
          }
          /*#pie_pagina .page:after {
            content: counter(page);
          }*/

          .informacion {
                position: fixed;
                bottom: -2cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;*/
                /**background-color: #2a0927;**/
                color: black ;
                line-height: 1px;
                
          }
          
          .firmas {
              position: fixed;
              bottom: 0cm;
              left: 0cm;
              right: 5cm;
              height: 1cm;
              /**background-color: #2a0927;**/
              color: black ;
              text-align: right;
              line-height: 11px;
             
          }
          #pie_pagina .page:after {
            content: counter(page);
          }
      </style>
    </head>
    <body>

    
          
        <!--<div class="informacion">
                        </div>-->
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
                  <th >Vo.Bo. Asesor 2 de secretaria general</th>
                  <th>Jefe de departamento de movilidad urbana</th> 
                  <th>Vo.Bo. Secretaria general</th>
                  <th>Secretario de medio ambiente</th>
                  <th >Vo.Bo. Asesor 2 de secretaria general</th>
                  <th >Vo.Bo. Asesor 2 de secretaria general</th>
                  <!--<th >Vo.Bo. Asesor 2 de secretaria general</th>-->
              </tr>
              <tr>
                  <td align="center"><img src="https://upload.wikimedia.org/wikipedia/commons/f/f8/Firma_Len%C3%ADn_Moreno_Garc%C3%A9s.png" width="50" height="50" alt=""></br>Abg. Alfredo Alberto Marusic Quiroga</td>
                  <td align="center"><img src="https://upload.wikimedia.org/wikipedia/commons/f/f8/Firma_Len%C3%ADn_Moreno_Garc%C3%A9s.png" width="50" height="50" alt=""></br>Lic. Henry Gonzalo Rico Garcia</td>
                  <td align="center"><img src="https://upload.wikimedia.org/wikipedia/commons/f/f8/Firma_Len%C3%ADn_Moreno_Garc%C3%A9s.png" width="50" height="50" alt=""></br>Ing. Pepito Ronaldo Perez Pereira Fernandez</td>
                  <td align="center"><img src="https://upload.wikimedia.org/wikipedia/commons/f/f8/Firma_Len%C3%ADn_Moreno_Garc%C3%A9s.png" width="50" height="50" alt=""></br>Ing. Ricardo Mendoza Garcia</td>
                  <td align="center"><img src="https://upload.wikimedia.org/wikipedia/commons/f/f8/Firma_Len%C3%ADn_Moreno_Garc%C3%A9s.png" width="50" height="50" alt=""></br>Cap. Manfred Reyes Villa Bacigalupi</td>
                  <td align="center"><img src="https://upload.wikimedia.org/wikipedia/commons/f/f8/Firma_Len%C3%ADn_Moreno_Garc%C3%A9s.png" width="50" height="50" alt=""></br>Cap. Manfred Reyes Villa Bacigalupi</td>
                  <!--<td align="center"><img src="https://upload.wikimedia.org/wikipedia/commons/f/f8/Firma_Len%C3%ADn_Moreno_Garc%C3%A9s.png" width="50" height="50" alt=""></br>Cap. Manfred Reyes Villa Bacigalupi</td>-->
              </tr>
          </table>
          </div>
          <div style="position:relative; right:-580px; top: -40px; width: 35% !important;">
            <img  src="https://upload.wikimedia.org/wikipedia/commons/d/d7/Commons_QR_code.png" width="31%" /> 
            <br><br>
            <div id="pie_pagina" >
              Pág. <snap class="page"></snap>      
            </div>
          </div>
        </footer>
       

        

        <!-- Wrap the content of your PDF inside a main tag -->
        
        <main >
            <h3>What is Lorem Ipsum?</h3>
            <p style="page-break-after: never;">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </p>
            <h3>Where does it come from?</h3>
            <p style="page-break-after: never;">            
                Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
            </p>

            <h3>What is Lorem Ipsum?</h3>
            <p style="page-break-after: never;">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </p>
            <h3>Where does it come from?</h3>
            <p style="page-break-after: never;">            
                Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
            </p>

            <h3>What is Lorem Ipsum?</h3>
            <p style="page-break-after: never;">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </p>
            <h3>Where does it come from?</h3>
            <p style="page-break-after: never;">            
                Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
            </p>

            <h3>What is Lorem Ipsum?</h3>
            <p style="page-break-after: never;">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </p>
            <h3>Where does it come from?</h3>
            <p style="page-break-after: never;">            
                Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
            </p>

            <h3>What is Lorem Ipsum?</h3>
            <p style="page-break-after: never;">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </p>
            <h3>Where does it come from?</h3>
            <p style="page-break-after: never;">            
                Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
            </p>

        </main>

        

    </body>
    
</html>