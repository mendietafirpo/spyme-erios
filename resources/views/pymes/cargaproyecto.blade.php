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
<div class="grid grid-cols-1 2xl:w-1/2 xl:w-3/5 lg:w-2/3 md:w-full content-start h-screen rounded-md shadow-md overscroll-auto bg-gray-200 mx-2 my-2 px-2">
    <div class="bg-green-200">
            <div id="titulo01" style="display:none;" class="float-left font-semibold text-xl text-red-700 py-2 px-2 w-3/4">
            Cargue la indentificación del proyecto
            </div>
            <div id="titulo02" style="display:none;" class="col float-left font-semibold text-xl text-red-700 py-2 px-2 w-3/4">
            Cargue los valores del proyecto
            </div>
            <div id="titulo03" style="display:none;" class="col float-left font-semibold text-xl text-red-700 py-2 px-2 w-3/4">
            Otras variables del proyecto
            </div>
            <div id="titulo04" style="display:none;" class="col float-left font-semibold text-xl text-red-700 py-2 px-2 w-3/4">
            Antecedentes, descripción y objetivos del proyecto
            </div>
            <div id="titulo05" style="display:none;" class="col float-left font-semibold text-xl text-red-700 py-2 px-2 w-3/4">
            Variables del proyecto
            </div>

    </div>
    <!--formularios-->
    <div class="grid grid-cols-1">
        <form class="col-span-1" name="cargaProyecto" action="{{ route('pymes.cargaproyecto') }}" method="POST">
            @csrf
        <div class="bg-purple-200 w-full rounded-md px-2 mb-2" id="parte1" style="display:none;">
            <!--primera parte-->
                <!-- idProy -->
                <div class="form-group">
                    <input id="idProy" hidden name="idProy" value="{{ $idLast }}" class="form-control" readonly required/>
                </div>
                <!-- fecha de referencia -->
                <div class="form-group pt-2 flex">
                    <label for="fechaReferencia" class="w-1/5 control-label align-top pt-1 w-32">Fecha de referencia:</label>
                    <div class="w-2/5">
                        <input type="date" name="fechaReferencia" class="bg-white rounded-md h-11 rounded-md bg-white border-blue-300 w-full h-10" autofocus onchange = "validar(this.form)"/>
                    </div>
                </div>
                <!-- nombre proyecto -->
                <div class="form-group flex">
                    <label for="nombreProyecto" class="w-1/5 control-label align-top pt-2 w-32">Nombre del proyecto:</label>
                    <div class="w-4/5">
                    <textarea class="bg-white rounded-md h-20 w-full border-blue-300" name="nombreProyecto" autofocus onkeyup = "validar(this.form)"></textarea>
                    </div>
                </div>
                <!-- bienes q prod -->
                <div class="form-group flex">
                    <label for="bienesQueProduce" class="w-1/5 control-label align-top pt-2">Bienes que produce:</label>
                    <div class="w-4/5">
                        <textarea class="bg-white rounded-md h-28 w-full border-blue-300" name="bienesQueProduce" autofocus onkeyup = "validar(this.form)"></textarea>
                    </div>
                </div>
                <!-- garantías ofrecidas -->
                <div class="form-group flex">
                    <label for="garantiasOfrecidas" class="w-1/5 control-label align-top pt-2">Garantias ofrecidas:</label>
                    <div class="w-2/5">
                        <input name="garantiasOfrecidas" list="garantiasOfrecidas" class="form-multiselect rounded-md bg-white border-blue-300 w-full h-10" required onkeyup = "validar(this.form)"/>
                        <datalist id="garantiasOfrecidas">
                        @foreach($gtias as $garantiasOfrecidas => $op)
                            <option value="{{ $op }}" {{ (old("garantiasOfrecidas") == $op ? "selected":"") }}>{{ $op }}</option>
                        @endforeach
                        </datalist>
                    </div>
                </div>
        </div>
        <div class="bg-purple-200 w-full rounded-md px-1 mb-2" id="parte2" style="display:none;">
        <!--segunda parte-->
                <!-- bienes q prod -->
                <div class="form-group top-0 pt-2 flex">
                    <label for="destinoFondos" class="w-1/5 control-label align-top pt-2">Destino de los Fondos:</label>
                    <div class="w-4/5">
                        <textarea class="bg-white rounded-md h-28 w-full border-blue-300" name="destinoFondos" autofocus onkeyup = "validar2(this.form)"></textarea>
                    </div>
                </div>
                <!-- montoTotal -->
                <div class="form-group flex">
                    <label for="montoTotal" class="w-1/5 control-label pt-2">Monto solicitado:</label>
                    <div class="w-1/5">
                        <input class="rounded-md h-11 border-blue-300 px-1" type="number" step="0.1" name="montoTotal" required autofocus onkeyup = "validar2(this.form)"/>
                    </div>
                </div>
                <!-- inversionTotal -->
                <div class="form-group flex">
                    <label for="inversionTotal" class="w-1/5 control-label align-top pt-2">Inversión total:</label>
                    <div class="w-1/5">
                        <input class="rounded-md h-11 border-blue-300 px-1" type="number" step="0.1" name="inversionTotal" required autofocus onchange = "monInversion(this.form)" onkeyup = "validar2(this.form)"/>
                        <input name="relMonInv" hidden="hidden" disable class="text-red-400 font-thin size-xs w-full">
                    </div>
                </div>
                <!-- personalOcupado -->
                <div class="form-group flex">
                    <label for="personalOcupado" class="w-1/5 control-label align-top pt-2">Personal ocupado:</label>
                    <div class="w-1/5">
                        <input class="rounded-md h-11 border-blue-300 px-1" type="number" name="personalOcupado" autofocus/>
                    </div>
                </div>
        </div>
        <div class="bg-purple-200 w-full rounded-md px-1 mb-2" id="parte3" style="display:none;">
        <!--tercera parte-->
                <!-- ciiuCs -->
                <div class="form-group pt-2 inline-flex">
                    <label for="ciiuCs" class="w-1/5 control-label align-top mr-2 pt-2">Código actividad: </label>
                    <div class="w-40">
                        <input name="ciiuCs" id="ciiuCs" class="form-control  bg-white w-full rounded-md h-11 border-blue-300 px-1" onchange = "validar3(this.form)"/>
                    </div>
                    <div class="w-1/3">
                        <button type="button" class="bg-black hover:bg-gray-500 text-white font-bold mx-2 py-2 px-2 rounded-md" onclick="pegarciiu()">Pegar código</button>
                    </div>
                    <div class="w-1/3 mt-2">
                        <a class="bg-blue-600 hover:bg-purple-500 text-white font-bold py-2 px-2 rounded-md" href="{{ route('pymes.ciiusearch') }}" target="_blank">Buscar código</a>
                    </div>
                </div>
                <!-- tipo Moneda -->
                <div class="form-group flex">
                    <label for="ciiuCs" class="w-1/5 control-label align-top pt-2">Tipo de moneda:</label>
                    <div class="w-2/5">
                        <select name="moneda" id="moneda" class="form-multiselect block rounded-md border-blue-300 shadow-sm mt-1 w-full" onchange = "validar3(this.form)">
                        <option value=""></option>
                        @foreach($dfmoney as $id => $mon)
                            <option value="{{ $id }}" {{ (old("moneda") == $mon ? "selected":"") }}>{{ $mon }}</option>
                        @endforeach
                        </select>
                        @error('moneda')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <!-- tipo de Cambio -->
                <div class="form-group flex pb-2">
                    <label for="tipodeCambio" class="w-1/5 control-label align-top pt-2">Tasa de cambio:</label>
                    <div class="w-2/5">
                        <input class="rounded-md h-11 border-blue-300 px-1 w-full" type="number" step="0,01" name="tipodeCambio" required autofocus onchange = "validar3(this.form)"/>
                    </div>
                </div>
        </div>
        <div class="bg-purple-200 w-full rounded-md px-1 mb-2" id="parte4" style="display:none;">
                <!-- descripcionProyecto -->
                <label for="descripcionProyecto" class="control-label">Descripcipón del proyecto</label>
                <textarea class="bg-white rounded-md h-28 w-full border-blue-300 px-1" name="descripcionProyecto" autofocus></textarea>
                <!-- antecentes -->
                <label for="antecedentes" class="control-label">Antecedentes - reseña histórica</label>
                <textarea class="bg-white rounded-md h-28 w-full border-blue-300 px-1" name="antecentes" autofocus></textarea>
                <!-- justificacion -->
                <label for="justificacion" class="control-label">Justificación o fundamentos del proyecto</label>
                <textarea class="bg-white rounded-md h-28 w-full border-blue-300 px-1" name="justificacion" autofocus></textarea>
                <!-- tasacion  -->
                <label for="tasacion" class="control-label">Tasación estimada del bien ofrecido en garantía</label>
                <input class="rounded-md h-11 border-blue-300 px-1" name="tasacion" autofocus>
                <!-- nroPartida -->
                <label for="nroPartida" class="control-label">Numero de partida</label>
                <input class="rounded-md h-11 border-blue-300 px-1" name="nroPartida" autofocus>
                <!-- nroMatricula -->
                <label for="nroMatricula" class="control-label">Número de matrícula</label>
                <input class="rounded-md h-11 border-blue-300 px-1" name="nroMatricula" autofocus>
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

            <div id="cancelar1" style="display:none;" class="pull-right py-2 px-4">
                    <a href="{{ route('pymes.cargaproyecto') }}" id="cancelar" class="btn btn-warning" onclick="cancelar1()">Borrar</a>
            </div>

        </form>
    </div>
</div>
</body>
<script src="{{ asset('/js/proyectos.js') }}"> </script>
<script>
    xcuit =  "<?php echo session('xcuit') ?>";
</script>


<footer class="row">
    @include('layouts.foo-ueperios')
</footer>
