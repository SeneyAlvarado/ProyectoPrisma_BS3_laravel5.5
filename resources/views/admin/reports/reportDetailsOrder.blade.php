<!DOCTYPE html>
<html>
<title>Reporte Detalle Orden</title>
    <head>
        <img src="Imagenes/PrismaReport.png" width="180px" height="80px" style="display:inline-block;"/>
        <p style="float:right; font-size:18px">Fecha: 
            <?php
            use Carbon\Carbon;
            echo Carbon::now('America/Costa_Rica')->format('d/m/Y H:i');
            ?>
        </p>
        
        <hr style="color: #96183a;" />
        <style>
            table {
                font-family: Arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            td,th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #dddddd;
            }
            label{
                font-size: 17px;
            }
        </style>
    </head>
<h2 >Reporte Orden #{{$order->id}}</h2>

    <body>
        
        <div>
            <div class="col-md-5 col-md-offset-2" style="margin-top:5px;">
                <label>Cliente: {{$order->client_owner}}</label>
            <div>
            <div  class="col-md-5">
                <label>Sucursal: {{$order->branch_id}}</label>
            </div>
            <div  class="col-md-5">
            <label>Fecha entrada: {{Carbon::parse($order->entry_date)->format('d/m/Y')}}</label>
            </div>
            <div  class="col-md-5">
            <label>Fecha entrada: {{Carbon::parse($order->entry_date)->format('d/m/Y')}}</label>
            </div>
            <div  class="col-md-5">
            <label>Número de cotización: {{$order->quotation_number}}</label>
            </div>
            <div  class="col-md-5">
            <label>Total: {{$order->total}}</label>
            </div>
            <div  class="col-md-5">
            <label>Adelanto: {{$order->advance_payment}}</label>
            </div>
        </div>
        <br>

        <div>
            <h3>Trabajos</h3>
            <br>
            <table>
                <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Detalles</th>
                    <th>Fecha entrada</th>
                    <th>Fecha aprox. salida</th>
                    <th>Prioridad</th>
                </tr>
                @foreach ($order->works as $work)
                <tr>
                    <td>{{$work->id}}</td>
                    <td>{{$work->product_id}}</td>
                    <td>{{$work->observation}}</td>
                    <td>{{$work->entry_date}}</td>
                    <td>{{$work->approximate_date}}</td>
                    <td>{{$work->priority}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </body>
</html>