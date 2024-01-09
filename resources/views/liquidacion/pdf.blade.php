<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
        h1, h2, h3, h4, h5, h6, p {
            margin: 0;
        }
        p {
            font-size: 12px;
        }
    </style>
</head>
<body>
<!-- Encabezado de la factura -->
<div class="container">
    <div class="row">
        <div class="col-8 d-flex flex-column">
            <h6>{{strtoupper($usuario->name)}} {{strtoupper($usuario->lastname)}} </h6>
            <p>{{$usuario->dni}}</p>
            <p>{{strtoupper($usuario->address)}}</p>
            <p>{{$usuario->cp}} {{strtoupper($usuario->city)}} ({{strtoupper($usuario->province)}})</p>
        </div>
        <div class="col-4 d-flex justify-content-center align-items-center">
            <h4 class="text-success">LUXPOWER</h4>
        </div>
    </div>
    <div class="row pt-5">
        <div class="col-6">
        </div>
        <div class="col-6 d-flex flex-column justify-content-end align-items-end">
            <h6><b>PERSONA FISICA</b></h6>
            <p>DNI: DNI</p>
            <p>C/ Calle Calle</p>
            <p>CP Y CIUDAD</p>
        </div>

    </div>
</div>

<!-- Detalles de la factura -->
<div class="container">
    <div class="row">
        <div class="col-12">
            <hr class="border border-success border-2 opacity-50">
            <div class="row">
                <h6 class="col-6 ps-4"><strong>Número de factura:</strong> #{{$liquidacion->numero_factura}}</h6>
                <h6 class="col-6 d-flex justify-content-end pe-4">
                    <strong class="pe-2">Fecha:     </strong>  {{date('d/m/Y', strtotime($liquidacion->fecha))}}</h6>
            </div>
            <hr class="border border-success border-2 opacity-50">
        </div>

    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-bordered ">
                <thead>
                <tr class="row">
                    <th class="col-10">Descripción</th>
                    <th class="col-2 d-flex justify-content-end">Importe</th>
                </tr>
                </thead>
                <tbody>
                @foreach($contratos as $contrato)
                    <tr class="row">
                        <td class="col-10 " style="font-size: 12px">Contrato nº{{$contrato->id}} con
                            CUPS {{$contrato->cups}}</td>
                        <td class="col-2 d-flex justify-content-end"
                            style="font-size: 12px;height:2rem">{{number_format($contrato->precio_producto * $contrato->comision / 100,2)}}
                            €
                        </td>
                    </tr>
                @endforeach
                @foreach($contratosTel as $contratoTel)
                    @php
                            $productosContrato = \App\Models\Producto_contrato::where('contrato_id',$contratoTel->id)->get();
                            foreach ($productosContrato as $productoContrato){
                                $producto= \App\Models\Producto::find($productoContrato->producto_id);
                                $comision = \App\Models\Comision::where('producto_id',$productoContrato->producto_id)
                                ->where('user_id',$contratoTel->user->id)
                                ->first();
                                if($comision==null){
                                    $comision = 0;
                                }else{
                                    $comision = $comision->comision;
                                }
                            $importe= $producto->precio * $comision / 100;
                            echo '<tr class="row">
                                    <td class="col-10 " style="font-size: 12px">Contrato Telefonía nº'.$contratoTel->id.'</td>
                                    <td class="col-2 d-flex justify-content-end"
                                    style="font-size: 12px;height:2rem">
                                    '.number_format($producto->precio * $comision / 100,2).'
                            €
                        </td>
                    </tr>';
                        }
                    @endphp
                @endforeach
                <tr class="row">
                    <td class="col-10 " style="font-size: 12px;height:2rem"></td>
                    <td class="col-2 d-flex justify-content-end" style="font-size: 12px"></td>
                </tr>
                </tbody>
            </table>
            <hr class="border border-success border-2 opacity-50">
            <div class="row">
                <div class="col-6"></div>
                <table class="col-6">
                    <tr class="row">
                        <td class="col-10 " style="font-size: 12px">Base imponible</td>
                        <td class="col-2 d-flex justify-content-end"
                            style="font-size: 12px;height:2rem">{{$total_importes}}€
                        </td>
                    </tr>
                    <tr class="row">
                        <td class="col-10 " style="font-size: 12px">IVA (21%)</td>
                        <td class="col-2 d-flex justify-content-end" style="font-size: 12px;height:2rem">{{number_format($total_importes *21 /100,2)}}€
                        </td>
                    </tr>
                    <tr class="row">
                        <td class="col-10 " style="font-size: 12px">IRPF ({{$usuario->irpf}}%)</td>
                        <td class="col-2 d-flex justify-content-end" style="font-size: 12px;height:2rem">{{number_format($total_importes* $usuario->irpf/100,2)}}€
                        </td>
                    </tr>
                    <tr class="row">
                        <td class="col-10 " style="font-size: 12px">Total</td>
                        <td class="col-2 d-flex justify-content-end"
                            style="font-size: 12px;height:2rem">{{$importeDefinitivo}}€
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
<script>
    // Crea una instancia de html2pdf con la configuración deseada
    const pdf = new html2pdf(document.body, {
        margin: [10, 10],
        filename: 'factura_{{$liquidacion->numero_factura}}.pdf',
        image: {type: 'jpeg', quality: 1.0},
        html2canvas: {dpi: 192, letterRendering: true},
        jsPDF: {unit: 'mm', format: 'a4', orientation: 'portrait'}
    });

    // Exporta la página web a PDF
    pdf.from().save();
</script>
</body>
</html>
