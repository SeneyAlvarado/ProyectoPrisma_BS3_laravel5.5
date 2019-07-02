<!DOCTYPE html>
<html>
    <title>Reporte Clientes</title>
    <head>
        <?php

// reference the Dompdf namespace
use Dompdf\Dompdf;

$clients=\DB::table('clients')
          ->select(['id', 'type', 'name', 'address', 'identification', 'active_flag'])
          ->get();
// instantiate and use the dompdf class
/*
$dompdf = new Dompdf();
$dompdf->set_option('defaultFont', 'Courier');
$dompdf->set_option("isPhpEnabled", true);
$dompdf->loadHtml('clients');

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser

*/

$pdf = \App::make('dompdf');
$pdf->loadView('/admin/reports/report', $clients);
$pdf->output();
$dom_pdf = $pdf->getDomPDF();

$canvas = $dom_pdf ->get_canvas();
$canvas->page_text(0, 0, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));

            ?>
             <script type="text/php">
                if ( isset($pdf) ) { 
                    $pdf->page_script('
                        if ($PAGE_COUNT > 1) {
                            $font = Font_Metrics::get_font("Arial, Helvetica, sans-serif", "normal");
                            $size = 12;
                            $pageText = Page . " " . $PAGE_NUM . " of " . $PAGE_COUNT;
                            $y = 15;
                            $x = 520;
                            $pdf->text($x, $y, $pageText, $font, $size);
                        } 
                    ');
                }
            </script> 
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