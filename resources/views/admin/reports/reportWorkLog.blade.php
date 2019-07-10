<!DOCTYPE html>
<html>
<title>Reporte de registro actividades trabajo</title>
    <head>
        <table style="border:hidden">
            <tr style="border:hidden; text-align: center;">
                <td style="width:220px;">
                    <img src="Imagenes/PrismaReport.png" width="180px" height="80px"/>
                </td>
                <td style="align-items: center; width:260px; border:hidden;">
                    <h2 style="text-align:center">Reporte de actividades</h2>
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
            footer {
                position: fixed; 
                bottom: 0px; 
                left: 0px; 
                right: 0px;
                height: 50px; 
                text-align: right;
                line-height: 35px;
            }
            table {
                font-family: Arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }
            th {
                border: 1px solid #dddddd;
                text-align: center;
                padding: 8px;
            }
            td {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
                font-size: 14px;
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
            p {
                font-size: 18px;
            }
            .pagenumber:before {
                content: counter(page);
            }
            .pagecount:before {
                content: counter(pages);
            }
            #pageCounter {
                counter-reset: pageTotal;
            }
            /* Show current page number via CSS counter feature */
            .page-number:before {
                content: counter(page);
            }
        </style>
    </head>
    <body>
        <div>
            <h3>Información del trabajo</h3>
            <table class="personal_information">
                <tr>
                    <td>
                        <label>Número de orden: {{$work->order_id}}</label>
                    </td>
                    <td>
                        <label>Fecha entrada: {{Carbon::parse($work->entry_date)->format('d/m/Y')}}</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Producto: {{$work->product_id}}</label>
                    </td>
                    <td>
                        @if ($work->priority == 1)
                        <label>Prioridad: Sí</label>
                        @else
                        <label>Prioridad: No posee</label>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                            @if ($work->designer_date != null )
                            <label>Ingreso a diseño: {{$work->designer_date}}</label>
                            @else
                            <label>Ingreso a diseño: No posee</label>
                            @endif
                    </td>
                    <td>
                            @if ($work->print_date != null )
                            <label>Ingreso a impresión: {{$work->print_date}}</label>
                            @else
                            <label>Ingreso a impresión: No posee</label>
                            @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        @if ($work->post_production_date != null )
                        <label>Ingreso a post-producción: {{$work->post_production_date}}</label>
                        @else
                        <label>Ingreso a post-producción: No posee</label>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
        <div>
            <br>
            <h3>Cambios</h3>
            <table>
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Cambio</th>
                    <th>Descripción cambio</th>
                    <th>Usuario</th>
                </tr>
                @foreach ($logs as $log)
                <tr>
                    <td>{{$log->id}}</td>
                    <td>{{Carbon::parse($log->date)->format('d/m/Y')}}</td>
                    <td>{{Carbon::parse($log->date)->format('H:s')}}</td>
                    <td>{{$log->attribute}}</td>
                    <td>{{$log->value}}</td>
                    <td>{{$log->user_id}}</td>
                </tr>
                @endforeach
            </table>
        </div>
        <br>
        <br>
        <br>
        <br>
        <p style="font-size:11">***************************************** ÚLTIMA PÁGINA *****************************************</p>
        <footer>
                <div class="footer" style="font-size:12pt; font-family: Arial; font-family: Arial;">
                        <span>Página <span class="pagenumber"/></span></div>
            </footer>
        </body>
</html>