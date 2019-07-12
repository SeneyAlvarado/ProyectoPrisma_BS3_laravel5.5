@extends('masterAdmin')
@section('contenido_Admin')
<!DOCTYPE html>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="/lib/html2pdf/dist/html2pdf.bundle.min.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Productos', 'mes'],
            @foreach ($products as $product)
              @if($product->total > 0)
              ['{{ $product->name}}', {{ $product->total}}],
              @endif
            @endforeach
        ]);

        var options = {
          title: ''
        };
        //console.log(data.wg.length + "XD");
        //console.log(data);
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        if(data.getNumberOfRows() == 0 ){
          $("#piechart").append("<br><br><br><br><br><br><br>" +
          "<h2>No hay información de productos entre las fechas seleccionadas<h2>");
        } else {
          chart.draw(data, options);
        }
      }
      function generatePDF(start, end) {
      // Choose the element that our invoice is rendered in.
      var element = document.getElementById("report");
      var startDate = start.split("-");
      startDate = startDate[0] + "." + startDate[1] + "." + startDate[2];
      var endDate = end.split("-");
      endDate = endDate[0] + "." + endDate[1] + "." + endDate[2];

      var opt = {
        margin:       15,
        filename:     'Productos_Mas_Vendidos_Desde_' + startDate + '_Hasta_' + endDate + '.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
};
      // Choose the element and save the PDF for our user.
      html2pdf().set(opt).from(element).save();
    }
    </script>
  </head>
  <body>
      <div style="padding:10px;" >
          <div class="card">
              <p class="card-header" style="text-align:left"><button onclick="generatePDF('{{$product->start}}','{{$product->end}}')">Descargar reporte en PDF</button></p>
              <div class="card-body">
                  <div class="container-fluid" style="paddin-top:10px">
             
      <div class="col-md-12 col-md-offset-2" id="report" >
          <table style="border:hidden;">
              <tr style="border:hidden; text-align: center;">
                  <td style="width:33%;">
                      <img src="Imagenes/PrismaReport.png" width="180px" height="80px"/>
                  </td>
                  <td style="align-items: center; width:33%; border:hidden;">
                      <h4 style="text-align:center">Reporte productos más vendidos</h4>
                  </td>
                  <td style="width:33%; align-items: center;border:hidden;">
                      <div>
                      <p style="text-align:center; font-size:18px;">Fecha</p>
                      <p style="text-align:center; font-size:18px">
                          <?php
                              use Carbon\Carbon;
                              echo Carbon::now('America/Costa_Rica')->format('d/m/Y');
                          ?>
                      </p>
                      </div>
                  </td>
              </tr>
          </table>
          <hr style="color: #96183a; border: 1px solid" />
          <div id="element-to-print" align="center">
            <h6 align="left">Desde {{\Carbon\Carbon::parse($product->start)->format('d/m/Y')}} hasta {{\Carbon\Carbon::parse( $product->end)->format('d/m/Y') }}</h6>
              <div id="piechart" class = "col-md-12 col-md-offset-2" style="width: 800px; height: 400px;"></div> 
              <br>
              <br>
              <p align="center">******************************* ÚLTIMA PÁGINA *******************************</p>
  </div>
  </div>
</div>
  </body>
</html>

@endsection