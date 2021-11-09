<?php
use Carbon\Carbon;
?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts-->
        <link rel="stylesheet" type="text/css" href="{{ '../../css/pdf.css' }}">
        <head>
</head>

<body style="width:210mm; height:257mm; margin-right:8px; margin-left:16px; ">
<!--logo y encabezado-->
    <table>
        <tr>
            <td style="align-content: center; width:140px">
            <img src="{{ public_path('logoerios.png') }}" style="width: 140px; height: 140px; border-radius: 50%;"></img></td>
            <td  style="width:460px">
                <div style="text-align:center; color: #272626; font-size:18px; line-height:50%">
                    <p>Secretaría General de la Gobernación</p>
                    <p>Unidad Operadora Provincial – CFI</p>
                    <p>cfierios@gmail.com</p>
                </div>
            </td>
            <td style="align-content: center; width:140px">
            <img src="{{ public_path('logocfi.png') }}" style="width:65px; height:65px; border-radius: 50%;"></img></td>
        </tr>
        <tr>
            <td colspan="3"> <p class="b" style="text-align:center; font-style: italic; font-size:15px;">“2021-Año del Bicentenario de la Muerte del Caudillo Francisco Ramírez”-</p></td>
        </tr>
    </table>
    <!--fecha-->
<br>
<div class="container">
     @yield('content')
@foreach ($notas as $nota)
@endforeach

     <!--fecha-->
<p style="text-align:right; font-style:italic; margin-right:17%">
Paraná, {{ $fechaFormat }}.-</p>
<br>
<br>
    <!--remitente-->
<p style="margin-left:5%; font-weight:bold; line-height:50%">Señor</p>
<p style="margin-left:5%; font-weight:bold; line-height:50%">Gerente de Administración Crediticia</p>
<p style="margin-left:5%; font-weight:bold; line-height:50%">Nuevo Banco de Entre Ríos S.A.</p>
<p style="margin-left:5%; font-weight:bold; line-height:50%">S__________________/___________________D</p>

<!--texto-->
<table style="width:700px; height:500px">
<tr valign="top">
<td style="height:500px;">
<br>
<p style="margin-left:5%; text-align:justify">
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
La firma <b> {{ $nota->razonSocial }} </b>, con domicilio en <b> {{ $nota->ciudad }}</b>,
Departamento <b> {{ $nota->departamento }} </b>, está interesado en gestionar un crédito,
<b> en el Marco de la Línea de Créditos {{ $nota->operatoriaPrograma }} </b>,
perteneciente a la Operatoria del Consejo Federal de Inversiones,
para <b>{{ $nota->nombreProyecto }} </b> por un monto de $ <b> {{ number_format($nota->montoTotal, 0, ',', '.') }}-
</b></p>

<p style="margin-left:5%; text-align:justify">
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>El solicitante quiere presentar la carpeta financiera en la <b> Sucursal
{{ $nota->sucursalVentanilla }} </b> del Nuevo Banco de Entre Ríos S.A.</p>

<p style="margin-left:5%; text-align:justify">
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>En función de ello solicitamos, se informe a esta Unidad Operadora
Provincial (UOP) si la empresa de referencia, resulta ser un sujeto
 hábil de crédito para la mencionada Línea.</p>

 <p style="margin-left:5%; text-align:justify;">
 <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Asimismo, les agradeceremos nos mencione cualquier otra información que Uds.
 consideren importante, pues dicho informe se remitirá al Consejo Federal de
  Inversiones para la continuidad de su gestión.</p>

 <p style="margin-left:5%; text-align:justify">
 <span style="text-align:left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Agradeciendo su valiosa colaboración, saludo a Ud. muy atte.</p>

</td>
</tr>
<tr>
<td>
<p style="color:#313131; text-align:center; font-style: italic; font-size:14px">UOP – CFI– Alameda de la Federación Nº 451– Paraná E.R. (3100) –Tel. 343- 4316653 - 4840314</p>
</td>
</tr>
</table>
</div>
</body>
</html>
