@extends('masterAdmin')
@section('contenido_Admin')
<!DOCTYPE html>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Productos', 'mes'],
            @foreach ($products as $product)
              ['{{ $product->name}}', {{ $product->total}}],
            @endforeach
        ]);

        var options = {
          title: 'Producto más vendido'
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
  <h4>Reporte de los porductos más vendidos del día {{ $product->start}} al {{ $product->end}}</h4>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>

@endsection