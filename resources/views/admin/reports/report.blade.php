<!DOCTYPE html>
<html>
    <title>Reporte Clientes</title>
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
        </style>
    </head>
    <h2 style="display:inline-block;">Reporte Clientes</h2>
    <body>
        <br>
        <br>
        <br>
        <br>
        <table>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Nombre</th>
                <th>Direccion</th>
                <th>Cedula</th>
                <th>Estado</th>
            </tr>
            @foreach ($clients as $client)
            <tr>
                <td>{{$client->id}}</td>
                <td>{{$client->type}}</td>
                <td>{{$client->name}}</td>
                <td>{{$client->address}}</td>
                <td>{{$client->identification}}</td>
                <td>{{$client->active_flag}}</td>
            </tr>
            @endforeach
        </table>
    </body>
</html>