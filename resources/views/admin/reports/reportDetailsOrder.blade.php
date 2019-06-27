<!DOCTYPE html>
<html>
<title>Reporte de Orden</title>
    <head>
        <table style="border:hidden">
            <tr style="border:hidden; text-align: center;">
                <td style="width:220px;">
                    <img src="Imagenes/PrismaReport.png" width="180px" height="80px"/>
                </td>
                <td style="align-items: center; width:260px; border:hidden;">
                    <h2 style="text-align:center">Reporte de orden</h2>
                </td>
                <td style="width:180px; align-items: center;border:hidden;">
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
            table.personal_information {
                padding-top: 2%;
                width: 100%;
                border:hidden;
            }
            table.personal_information tr{
                background-color: white;
                border:hidden;
            }
            table.personal_information td {
                border:hidden;
            }
        </style>
    </head>
    <body>
        <div>
            <table class="personal_information">
                <tr>
                    <td>
                        <label>Número de orden: {{$order->id}}</label>
                    </td>
                    <td>
                        <label>Sucursal: {{$order->branch_id}}</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Cliente: {{$order->client_owner}}</label>
                    </td>
                    <td>
                        <label>Fecha entrada: {{Carbon::parse($order->entry_date)->format('d/m/Y')}}</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Fecha salida: {{Carbon::parse($order->entry_date)->format('d/m/Y')}}</label>
                    </td>
                    <td>
                        @if ($order->quotation_number == null)
                        <label>Número de cotización: No posee</label>
                        @else
                        <label>Número de cotización: {{$order->quotation_number}}</label>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Total: {{$order->total}}</label>
                    </td>
                    <td>
                        <label>Adelanto: {{$order->advance_payment}}</label>
                    </td>
                </tr>
            </table>
        </div>
        <div>
            <br>
            <h2>Trabajos</h2>
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
                    <td>{{Carbon::parse($work->entry_date)->format('d/m/Y')}}</td>
                    <td>{{Carbon::parse($work->approximate_date)->format('d/m/Y')}}</td>
                    @if ($work->priority == 0)
                    <td>No posee</td>
                    @else
                    <td>Sí</td>
                    @endif
                </tr>
                @endforeach
            </table>
        </div>
    </body>
</html>