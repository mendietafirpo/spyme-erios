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
    <div class="grid grid-cols-1 2xl:w-1/2 xl:w-3/5 lg:w-2/3 md:w-full rounded-md shadow-md overscroll-contain bg-gray-200  mx-2 my-2 px-2">
        <div class="bg-green-200">
                <div id="titulo01" style="display:block;" class="float-left font-semibold text-xl text-red-700 py-2 px-2 w-3/4">
                Carge los datos del expediente
                </div>

        </div>
        <!--formularios-->
        <div class="grid grid-cols-1">
            <form class="col-span-1" name="cargaexpte" action="{{ route('pymes.cargaexpte') }}" method="POST">
                @csrf
            <div class="bg-purple-200 w-full inline-block rounded-md px-2 py-2" id="parte1" style="display:block;">
                <!--primera parte-->
                    <!--ocultos-->
                    <input name="id" hidden value="{{ $idLast }}" class="form-control" readonly required />
                    <!-- idProy -->
                    <input id="idProy" hidden name="idProy" value="{{ $idProy }}" class="form-control" readonly required/>
                    <!-- entidad fuente de fondos -->
                    <div class="form-group inline-block" style="display:none">
                    <!--    <label for="entidadFuenteDeFondos" class="w-1/4 control-label align-top pt-1">Organismo:</label>
                        <div class="w-2/3"> COPIAR INPUT DE LIST !-->
                            <input name="entidadFuenteDeFondos" type="text" value="CFI"/>
                        <!--   <datalist id="entidadFuenteDeFondos">
                            @foreach($fuenteFds as $entidadFuenteDeFondos => $op)
                                <option value="{{ $op }}" {{ (old("entidadFuenteDeFondos") == $op ? "selected":"") }}>{{ $op }}</option>
                            @endforeach
                            </datalist>
                        </div>-->
                    </div>
                    <!-- operatoria programa -->
                    <div class="form-group flex mt-2">
                        <label for="operatoriaPrograma" class="w-1/4 control-label align-top pt-1">Operatoria:</label>
                        <div class="w-2/3">
                            <input name="operatoriaPrograma" list="operatoriaPrograma" class="form-multiselect rounded-md bg-white border-blue-300 px-1 w-full h-10" required onchange = "validar(this.form)"/>
                            <datalist id="operatoriaPrograma">
                            @foreach($operatoria as $operatoriaPrograma => $op)
                                <option value="{{ $op }}" {{ (old("operatoriaPrograma") == $op ? "selected":"") }}>{{ $op }}</option>
                            @endforeach
                            </datalist>
                        </div>
                    </div>
                    <!-- bancos  -->
                    <div class="form-group flex">
                        <label for="agenteFinanciero" class="w-1/4 control-label align-top pt-1">Banco:</label>
                        <div class="w-2/3">
                            <input name="agenteFinanciero" list="agenteFinanciero" class="form-multiselect rounded-md bg-white border-blue-300 px-1 w-full h-10" required onchange = "validar(this.form)"/>
                            <datalist id="agenteFinanciero">
                            @foreach($banco as $agenteFinanciero => $op)
                                <option value="{{ $op }}" {{ (old("agenteFinanciero") == $op ? "selected":"") }}>{{ $op }}</option>
                            @endforeach
                            </datalist>
                        </div>
                    </div>
                    <!-- sucursal ventanilla -->
                    <div class="form-group flex">
                        <label for="sucursalVentanilla" class="w-1/4 control-label align-top pt-1">Sucursal:</label>
                        <div class="w-2/3">
                            <input name="sucursalVentanilla" list="sucursalVentanilla" class="form-multiselect rounded-md bg-white border-blue-300 px-1 w-full h-10" required onchange = "validar(this.form)"/>
                            <datalist id="sucursalVentanilla">
                            @foreach($sucursal as $sucursalVentanilla => $op)
                                <option value="{{ $op }}" {{ (old("sucursalVentanilla") == $op ? "selected":"") }}>{{ $op }}</option>
                            @endforeach
                            </datalist>
                        </div>
                    </div>
                    <!-- evaluador tecnico -->
                    <div class="form-group flex">
                        <label for="evaluadorTecnico" class="w-1/4 control-label align-top pt-1">Evaluador:</label>
                        <div class="w-2/3">
                            <input name="evaluadorTecnico" list="evaluadorTecnico" class="form-multiselect rounded-md bg-white border-blue-300 px-1 w-full h-10" onchange = "validar(this.form)"/>
                            <datalist id="evaluadorTecnico">
                            @foreach($tecnico as $evaluadorTecnico => $op)
                                <option value="{{ $op }}" {{ (old("evaluadorTecnico") == $op ? "selected":"") }}>{{ $op }}</option>
                            @endforeach
                            </datalist>
                        </div>
                    </div>
            </div>
                <div id="enviar" style="display:none;" class="pull-right py-2 px-2">
                        <button  id="guardar" disabled="disabled" type="submit" class="bg-black hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-md">Guardar</button>
                </div>

            <!--botones siguiente / anterior -->
                <div id="cancelar1" style="display:none;" class="pull-right py-2 px-4">
                        <a href="{{ route('pymes.cargaexpte') }}" id="cancelar" class="btn btn-warning" onclick="cancelar1()">Borrar</a>
                </div>

            </form>
    </div>
</div>
</body>
<script src="{{ asset('/js/expte.js') }}"> </script>

<footer class="row">
    @include('layouts.foo-ueperios')
</footer>
