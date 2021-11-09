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

<body onload="carga()">
@include('layouts.main')

@if(Session::has('jsAlert'))
    @if(session('info'))
    {{ session('info') }}
    @endif
@endif


<!-- formularios de carga-->
<div class="grid grid-cols-1 2xl:w-1/2 xl:w-3/5 lg:w-2/3 md:w-full h-screen content-start rounded-md shadow-md overscroll-contain bg-gray-200  mx-2 my-2 px-2">
    <div class="bg-green-200">
            <div id="titulo01" style="display:none;" class="float-left font-semibold text-xl text-red-700 py-2 px-2 w-3/4">
            Editar la indentificación del proyecto
            </div>
            <div id="titulo02" style="display:none;" class="col float-left font-semibold text-xl text-red-700 py-2 px-2 w-3/4">
            Editar los valores del proyecto
            </div>
            <div id="titulo03" style="display:none;" class="col float-left font-semibold text-xl text-red-700 py-2 px-2 w-3/4">
            Editar otras datos del proyecto
            </div>
            <div id="titulo04" style="display:none;" class="col float-left font-semibold text-xl text-red-700 py-2 px-2 w-3/4">
            Editar los antecedentes, descripción y objetivos del proyecto
            </div>
            <div id="titulo05" style="display:none;" class="col float-left font-semibold text-xl text-red-700 py-2 px-2 w-3/4">
            Editar variables del proyecto
            </div>

    </div>
    <!--formularios-->
    <div class="grid grid-cols-1">
        <form class="col-span-1" name="editProyecto" action="{{ route('proyectos.update',$proyecto->idProy) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="bg-purple-200 w-full rounded-md py-2 px-2" id="parte1" style="display:none;">
            <!--primera parte-->
                <!-- idProy -->
                <div class="form-group">
                    <input id="idProy" hidden name="idProy" value="{{ $proyecto->idProy }}" class="form-control" readonly required/>
                </div>
                <!-- fecha de referencia -->
                <div class="form-group mt-2 flex">
                    <label for="fechaReferencia" class="control-label align-top pt-1 w-1/4">Fecha de referencia:</label>
                    <div class="w-2/3">
                    @if($proyecto->fechaReferencia)
                        <input class="form-control form-control bg-white rounded-md w-full border-blue-300" name="fechaReferencia" type="date" value="{{ Carbon::parse($proyecto->fechaReferencia)->format('Y-m-d') }}">
                    @else
                        <input class="form-control form-control bg-white rounded-md w-full border-blue-300" name="fechaReferencia" type="date">
                    @endif


                    </div>
                </div>
                <!-- nombre proyecto -->
                <div class="form-group flex">
                    <label for="nombreProyecto" class="w-1/4 control-label align-top pt-2">Nombre del proyecto:</label>
                    <div class="w-2/3">
                    <textarea class="bg-white rounded-md h-20 w-full border-blue-300"name="nombreProyecto" autofocus onkeyup = "validar(this.form)">{{ old('nombreProyecto', $proyecto->nombreProyecto) }}</textarea>
                    </div>
                </div>
                <!-- bienes q prod -->
                <div class="form-group flex">
                    <label for="bienesQueProduce" class="w-1/4 control-label align-top pt-2">Bienes que produce:</label>
                    <div class="w-2/3">
                    <textarea class="bg-white rounded-md h-28 w-full border-blue-300" name="bienesQueProduce" autofocus onkeyup = "validar(this.form)">{{ old('bienesQueProduce', $proyecto->bienesQueProduce) }}</textarea>
                    </div>
                </div>
                <!-- garantías ofrecidas -->
                <div class="form-group flex">
                    <label for="garantiasOfrecidas" class="control-label align-top pt-1 w-1/4">Garantias ofrecidas:</label>
                    <div class="w-2/3">
                        <input name="garantiasOfrecidas" value="{{ old('garantiasOfrecidas', $proyecto->garantiasOfrecidas) }}" list="garantiasOfrecidas" class="form-multiselect rounded-md form-control bg-white border-blue-300 w-full h-10" required onkeyup = "validar(this.form)"/>
                        <datalist id="garantiasOfrecidas">
                        @foreach($gtias as $garantiasOfrecidas => $op)
                             <option value="{{ $op }}" {{ (old("garantiasOfrecidas") == $op ? "selected":"") }}>{{ $op }}</option>
                        @endforeach
                        </datalist>
                    </div>
                </div>
        </div>
        <div class="flex bg-purple-200 w-full rounded-md py-2 px-2" id="parte2" style="display:none;">
        <!--segunda parte-->
                <!-- bienes q prod -->
                <div class="form-group top-0 mt-2 flex">
                    <label for="destinoFondos" class="w-1/4 control-label align-top pt-2">Destino de los Fondos:</label>
                    <div class="w-2/3">
                        <textarea class="bg-white rounded-md h-28 w-full border-blue-300"
                        name="destinoFondos" autofocus onkeyup = "validar2(this.form)">{{ old('destinoFondos', $proyecto->destinoFondos) }}</textarea>
                    </div>
                </div>
                <!-- montoTotal -->
                <div class="form-group flex">
                    <label for="montoTotal" class="control-label w-1/4">Monto solicitado:</label>
                    <div class="w-2/3">
                        <input class="form-control bg-white rounded-md h-11 w-full border-blue-300 px-1"
                        value="{{ $proyecto->montoTotal }}" type="number" step="0.1" name="montoTotal" required autofocus onkeyup = "validar2(this.form)"/>
                    </div>
                </div>
                <!-- inversionTotal -->
                <div class="form-group flex">
                    <label for="inversionTotal" class="control-label w-1/4 align-top pt-1">Inversión total:</label>
                    <div class="w-2/3">
                        <input class="form-control bg-white rounded-md h-11 w-full border-blue-300 px-1"
                        value="{{ $proyecto->inversionTotal }}" type="number" step="0.1" name="inversionTotal" required autofocus onchange = "monInversion(this.form)" onkeyup = "validar2(this.form)"/>
                        <input name="relMonInv" hidden="hidden" disable class="text-red-400 font-thin size-xs w-full">
                    </div>
                </div>
                <!-- personalOcupado -->
                <div class="form-group flex">
                    <label for="personalOcupado" class="control-label w-1/4">Personal ocupado:</label>
                    <div class="w-2/3">
                        <input class="form-control bg-white rounded-md h-11 w-full border-blue-300 px-1"
                        value="{{ $proyecto->personalOcupado }}" type="number" name="personalOcupado" autofocus/>
                    </div>
                </div>
        </div>
        <div class="flex bg-purple-200 w-full rounded-md py-2 px-2" id="parte3" style="display:none;">
        <!--tercera parte-->
                <!-- ciiuCs -->
                <div class="form-group mt-2 flex">
                    <label for="ciiuCs" class="control-label w-1/4">Código actividad: </label>
                    <div class="1/4 mx-4">
                        <input name="ciiuCs" id="ciiuCs" class="form-control bg-white rounded-md h-11 w-full border-blue-300 px-1" value="{{ $proyecto->ciiuCs }}" onchange = "validar3(this.form)"/>
                    </div>
                    <div class="w-1/4 ml-2">
                        <button type="button" class="bg-black hover:bg-gray-500 text-white font-bold py-2 px-2 rounded-md" onclick="pegarciiu()">Pegar código</button>
                    </div>
                    <div class="w-1/4 mt-2">
                        <a class="bg-blue-600 hover:bg-purple-500 text-white font-bold py-2 px-2 rounded-md" href="{{ route('pymes.ciiusearch') }}" target="_blank">Buscar código</a>
                    </div>
                </div>
                <!-- tipo Moneda -->
                <div class="form-group flex">
                    <label for="ciiuCs" class="control-label w-1/4">Tipo de moneda:</label>
                    <div class="w-2/3">
                        <select name="moneda" id="moneda" class="form-multiselect block rounded-md border-blue-300 shadow-sm mt-1 w-full" onchange = "validar3(this.form)">
                        <option value=""></option>
                        @foreach($dfmoney as $id => $mon)
                            <option value="{{ $id }}" {{ ( $id == $proyecto->moneda) ? 'selected' : '' }}>
                                {{ $mon }}
                            </option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <!-- tipo de Cambio -->
                <div class="form-group flex">
                    <label for="tipodeCambio" class="control-label w-1/4">Tasa de cambio:</label>
                    <div class="w-2/3">
                        <input class="form-control bg-white rounded-md h-11 w-full border-blue-300 px-1"  type="number" step="0,01"
                        value="{{ $proyecto->tipodeCambio }}" name="tipodeCambio" required autofocus onchange = "validar3(this.form)"/>
                    </div>
                </div>
        </div>
        <div class="flex bg-purple-200 w-full rounded-md py-2 px-2" id="parte4" style="display:none;">
                <!-- descripcionProyecto -->
                <label for="descripcionProyecto" class="control-label">Descripcipón del proyecto</label>
                <textarea class="bg-white rounded-md h-28 w-full border-blue-300 px-1"
                name="descripcionProyecto" autofocus>{{ old('descripcionProyecto', $proyecto->descripcionProyecto) }}</textarea>
                <!-- antecentes -->
                <label for="antecedentes" class="control-label">Antecedentes - reseña histórica</label>
                <textarea class="bg-white rounded-md h-28 w-full border-blue-300 px-1"
                name="antecentes" autofocus>{{ old('antecentes', $proyecto->antecentes) }}</textarea>
                <!-- justificacion -->
                <label for="justificacion" class="control-label">Justificación o fundamentos del proyecto</label>
                <textarea class="bg-white rounded-md h-28 w-full border-blue-300 px-1"
                name="justificacion" autofocus>{{ old('justificacion', $proyecto->justificacion) }}</textarea>
                <!-- tasacion  -->
                <label for="tasacion" class="control-label">Tasación estimada del bien ofrecido en garantía</label>
                <input class="form-control bg-white rounded-md h-11 w-full border-blue-300 px-1"
                value="{{ $proyecto->tasacion }}" name="tasacion" autofocus>
                <!-- nroPartida -->
                <label for="nroPartida" class="control-label">Numero de partida</label>
                <input class="form-control bg-white rounded-md h-11 w-full border-blue-300 px-1"
                value="{{ $proyecto->nroPartida }}" name="nroPartida" autofocus>
                <!-- nroMatricula -->
                <label for="nroMatricula" class="control-label">Número de matrícula</label>
                <input class="form-control bg-white rounded-md h-11 w-full border-blue-300 px-1"
                value="{{ $proyecto->nroMatricula }}" name="nroMatricula" autofocus>
        </div>
            <div id="enviar" style="display:none;" class="pull-right py-2 px-2">
                    <button  id="guardar" disabled="disabled" type="submit" class="bg-black hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-md">Guardar</button>
            </div>

        <!--botones siguiente / anterior -->
            <div id="siguiente1" style="display:none;" class="pull-right py-2">
                <button type="button" class="btn btn-primary" onclick="siguiente1()">Siguiente</button>
            </div>
            <div id="anterior1" style="display:none;" class="pull-left py-2">
                <button type="button" class="btn btn-primary" onclick="anterior1()">Anterior</button>
            </div>
            <div id="siguiente2" style="display:none;" class="pull-right py-2">
                <button type="button" class="btn btn-primary" onclick="siguiente2()">Siguiente</button>
            </div>
            <div id="siguiente3" style="display:none;" class="pull-right pr-4 py-2">
                <button type="button" class="bg-gray-600 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded-md" onclick="siguiente3()">Mas...</button>
            </div>
            <div id="anterior2" style="display:none;" class="pull-left py-2">
                <button type="button" class="btn btn-primary" onclick="anterior2()">Anterior</button>
            </div>
            <div id="anterior3" style="display:none;" class="pull-left py-2">
                <button type="button" class="btn btn-primary" onclick="anterior3()">Anterior</button>
            </div>
            <div id="cancelar1" style="display:block;" class="pull-right py-2 px-4">
                    <a href="javascript: history.go(-1)" id="cancelar" class="btn btn-warning">Cancelar</a>
            </div>

        </form>
    </div>
</div>
</body>
<script src="{{ asset('/js/proyedit.js') }}"> </script>
<script>
    xcuit =  "<?php echo session('xcuit') ?>";
</script>


<footer class="row">
    @include('layouts.foo-ueperios')
</footer>
