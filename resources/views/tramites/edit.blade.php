<?php
use Carbon\Carbon;
?>
<head>
@include('layouts.head')
@include('flash-message')
</head>
<header>
@include('layouts.header')
</header>

<body>
@include('layouts.main')

@if(Session::has('jsAlert'))
    @if(session('info'))
    {{ session('info') }}
    @endif
@endif


<!-- formularios de carga-->
<div class="grid grid-cols-1 2xl:w-2/5 xl:w-1/2 lg:w-3/5 md:w-full content-start h-screen rounded-md shadow-md overscroll-contain bg-gray-200  mx-2 my-2 px-2">
    <div class="bg-green-200">
        <div id="titulo01" style="display:block;" class="float-left font-semibold text-xl text-red-700 py-2 px-2 w-3/4">
        Editar fechas del tramite
        </div>
        <div id="titulo02" style="display:none;" class="col float-left font-semibold text-xl text-red-700 py-2 px-2 w-3/4">
        Editar fechas finales del tramite
        </div>
    </div>
    <!--formularios-->
    <div class="grid grid-cols-1">
        <form class="col-span-1" name="edittramite" action="{{ route('tramites.update',$tramite->idProy) }}" method="POST" onchange ="changed(this.form)">
        @csrf
        @method('PUT')

        <!--primera parte-->
        <div class="bg-purple-200 w-full rounded-md px-2 py-2" id="parte1" style="display:block;">
            <!--primera parte-->
                <!--ocultos-->
                <input name="id" hidden value="{{ $tramite->id }}" class="form-control bg-white rounded-md h-11 w-full border-blue-300" readonly required />
                <!-- idProy -->
                <input id="idProy" hidden name="idProy" value="{{ $tramite->idProy }}" class="form-control bg-white rounded-md h-11 w-full border-blue-300" readonly required/>
                <!-- operatoria programa -->
                <!-- fecha presentación idea  proyecto -->
                <div class="form-group mt-2 flex">
                    <label for="presentacionIdeaProy" class="control-label align-top pt-1 w-2/5">Fecha de presentación:</label>
                    <div class="w-2/5">
                    @if($tramite->presentacionIdeaProy)
                        <input class="form-control bg-white rounded-md h-11 w-full border-blue-300" name="presentacionIdeaProy" type="date" value="{{ old('presentacionIdeaProy', Carbon::parse($tramite->presentacionIdeaProy)->format('Y-m-d')) }}" autofocus/>
                    </div>
                    @else
                        <input class="form-control bg-white rounded-md h-11 w-full border-blue-300" name="presentacionIdeaProy" type="date"/>
                    @endif
                </div>
                <!-- fecha de consulta sujeto credito -->
                <div class="form-group mt-2 flex">
                    <label for="consultaAgenteFinan" class="control-label align-top pt-1 w-2/5">Consulta banco (sujeto crédito):</label>
                    <div class="w-2/5">
                    @if($tramite->consultaAgenteFinan)
                        <input class="form-control bg-white rounded-md h-11 w-full border-blue-300" name="consultaAgenteFinan" type="date" value="{{ Carbon::parse($tramite->consultaAgenteFinan)->format('Y-m-d') }}" autofocus onfocus = "validar(this.form)" onchange = "validar(this.form)"/>
                    @else
                        <input class="form-control bg-white rounded-md h-11 w-full border-blue-300" name="consultaAgenteFinan" type="date"/>
                    @endif
                    </div>
                    <div class="w-1/5 pl-4">
                        <button tabindex="-1" type="button" id="notabanco" disabled="disabled" class="btn bg-yellow-600 hover:bg-red-300 text-white font-bold" onclick="window.open('/notas/albanco/generate','_blank')">Nota pdf</abutton>
                    </div>
                </div>
                <!-- fecha del informe sujeto de crédito -->
                <div class="form-group mt-2 flex">
                    <label for="informeSujetoCredito" class="control-label align-top pt-1 w-2/5">Informe sujeto de crédito:</label>
                    <div class="w-2/5">
                    @if($tramite->informeSujetoCredito)
                        <input class="form-control bg-white rounded-md h-11 w-full border-blue-300" name="presentacionIdeaProy" type="date" value="{{ Carbon::parse($tramite->informeSujetoCredito)->format('Y-m-d') }}" autofocus/>
                    @else
                        <input class="form-control bg-white rounded-md h-11 w-full border-blue-300" name="informeSujetoCredito" type="date">
                    @endif
                    </div>
                </div>
                <!-- sujeto de crédito -->
                <div class="form-group flex">
                    <label for="sujetoCredito" class="control-label align-top pt-1 w-2/5">Resultado Sujeto d crédito:</label>
                    <div class="w-2/5">
                        <input name="sujetoCredito" value="{{ old('sujetoCredito', $tramite->sujetoCredito) }}" list="sujetoCredito" class="form-multiselect rounded-md bg-white border-blue-300 w-full h-11"/>
                        <datalist id="sujetoCredito">
                        @foreach($sujetocred as $sujetoCredito => $op)
                            <option value="{{ $op }}" {{ (old("sujetoCredito") == $op ? "selected":"") }}>{{ $op }}</option>
                        @endforeach
                        </datalist>
                    </div>
                </div>
                <!-- fecha de remisión organismo -->
                <div class="form-group mt-2 flex">
                    <label for="remisionOrganismo" class="control-label align-top pt-1 w-2/5">Remisión organismo:</label>
                    <div class="w-2/5">
                    @if($tramite->remisionOrganismo)
                        <input class="form-control bg-white rounded-md h-11 w-full border-blue-300" name="remisionOrganismo" type="date" value="{{ Carbon::parse($tramite->remisionOrganismo)->format('Y-m-d') }}" autofocus/>
                    @else
                        <input class="form-control bg-white rounded-md h-11 w-full border-blue-300" name="remisionOrganismo" type="date">
                    @endif
                    </div>
                </div>

        </div>
        <!--segunda parte-->
        <div class="bg-purple-200 w-full rounded-md px-2 py-2" id="parte2" style="display:none;">
                <!-- fecha de aprob tecnica -->
                <div class="form-group mt-2 flex">
                    <label for="aprobacionTecnica" class="control-label align-top pt-1 w-2/5">Aprobación técnica:</label>
                    <div class="w-2/5">
                    @if($tramite->aprobacionTecnica)
                        <input class="form-control bg-white rounded-md h-11 w-full border-blue-300" name="aprobacionTecnica" type="date" value="{{ Carbon::parse($tramite->aprobacionTecnica)->format('Y-m-d') }}" autofocus/>
                    @else
                        <input class="form-control bg-white rounded-md h-11 w-full border-blue-300" name="aprobacionTecnica" type="date">
                    @endif
                    </div>
                </div>
                <!-- fecha de resolucioneleginilidad -->
                <div class="form-group mt-2 flex">
                    <label for="resolucionElegibilidad" class="control-label align-top pt-1 w-2/5">Resolución elegibilidad:</label>
                    <div class="w-2/5">
                    @if($tramite->resolucionElegibilidad)
                        <input class="form-control bg-white rounded-md h-11 w-full border-blue-300" name="resolucionElegibilidad" type="date" value="{{ Carbon::parse($tramite->resolucionElegibilidad)->format('Y-m-d') }}" autofocus/>
                    @else
                        <input class="form-control bg-white rounded-md h-11 w-full border-blue-300" name="resolucionElegibilidad" type="date">
                    @endif
                    </div>
                </div>
                <!-- fecha de transferencia de fondos -->
                <div class="form-group mt-2 flex">
                    <label for="transferenciaFondos" class="control-label align-top pt-1 w-2/5">Transferencia de fondos:</label>
                    <div class="w-2/5">
                    @if($tramite->transferenciaFondos)
                        <input class="form-control bg-white rounded-md h-11 w-full border-blue-300" name="transferenciaFondos" type="date" value="{{ Carbon::parse($tramite->transferenciaFondos)->format('Y-m-d') }}" autofocus/>
                    @else
                        <input class="form-control bg-white rounded-md h-11 w-full border-blue-300" name="transferenciaFondos" type="date">
                    @endif
                    </div>
                </div>
                <!-- fecha de efectivizacion -->
                <div class="form-group mt-2 flex">
                    <label for="efectivizacion" class="control-label align-top pt-1 w-2/5">Efectivización:</label>
                    <div class="w-2/5">
                    @if($tramite->efectivizacion)
                        <input class="form-control bg-white rounded-md h-11 w-full border-blue-300" name="efectivizacion" type="date" value="{{ Carbon::parse($tramite->efectivizacion)->format('Y-m-d') }}" autofocus/>
                    @else
                        <input class="form-control bg-white rounded-md h-11 w-full border-blue-300" name="efectivizacion" type="date">
                    @endif
                    </div>
                </div>
                <!-- fecha dado de baja -->
                <div class="form-group mt-2 flex">
                    <label for="fechaDadoDeBaja" class="control-label align-top pt-1 w-2/5">Fecha dado de baja:</label>
                    <div class="w-2/5">
                    @if($tramite->fechaDadoDeBaja)
                        <input class="form-control bg-white rounded-md h-11 w-full border-blue-300" name="fechaDadoDeBaja" type="date" value="{{ Carbon::parse($tramite->fechaDadoDeBaja)->format('Y-m-d') }}" autofocus/>
                    @else
                        <input class="form-control bg-white rounded-md h-11 w-full border-blue-300" name="fechaDadoDeBaja" type="date">
                    @endif
                    </div>
                </div>
                <!-- fecha desistido -->
                <div class="form-group mt-2 flex">
                    <label for="fechaDesistido" class="control-label align-top pt-1 w-2/5">Fecha desistido:</label>
                    <div class="w-2/5">
                    @if($tramite->fechaDesistido)
                        <input class="form-control bg-white rounded-md h-11 w-full border-blue-300" name="fechaDesistido" type="date" value="{{ Carbon::parse($tramite->fechaDesistido)->format('Y-m-d') }}" autofocus/>
                    @else
                        <input class="form-control bg-white rounded-md h-11 w-full border-blue-300" name="fechaDesistido" type="date">
                    @endif
                    </div>
                </div>
        </div>
            <div id="enviar" style="display:none;" class="pull-right py-2 px-2">
                <button  id="guardar" disabled="disabled" type="submit" class="btn btn-success hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-md">Guardar</button>
            </div>

        <!--botones siguiente / anterior -->
            <div id="siguiente1" style="display:block;" class="pull-left py-2">
                <button type="button" class="btn btn-primary" onclick="siguiente1()">Siguiente</button>
            </div>
            <div id="anterior1" style="display:none;" class="pull-left py-2">
                <button type="button" class="btn btn-primary" onclick="anterior1()">Anterior</button>
            </div>
            <div id="cancelar1" style="display:block;" class="pull-right py-2 px-4">
                <a href="javascript: history.go({{ $go }})" id="cancelar" class="btn btn-warning">
                    @if ($go==1)
                    Cancelar
                    @else
                    Volver
                    @endif
                </a>
            </div>
        </form>
    </div>
</div>
</body>
<script src="{{ asset('/js/tramitedit.js') }}"> </script>
<script>
    fechabanco =  "<?php echo $tramite->consultaAgenteFinan ?>";
</script>

<footer class="row">
    @include('layouts.foo-ueperios')
</footer>
