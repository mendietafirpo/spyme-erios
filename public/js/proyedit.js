    function carga(){
        document.getElementById("parte1").style.display = "block";
        document.getElementById("titulo01").style.display = "block";

        var fecha = new Date(editProyecto['fechaReferencia'].value);

        if (fecha.getFullYear()>0
        && editProyecto['nombreProyecto'].value !==''
        && editProyecto['garantiasOfrecidas'].value !=='') {
            document.getElementById("siguiente1").style.display = "block";
        }else{
            document.getElementById("siguiente1").style.display = "none";
        }

    }

    function validar(editProyecto) {
            var fecha = new Date(editProyecto['fechaReferencia'].value);

            if (fecha.getFullYear()>0
            && editProyecto['nombreProyecto'].value !==''
            //&& editProyecto['bienesQueProduce'].value !==''
            && editProyecto['garantiasOfrecidas'].value !=='') {
                document.getElementById("siguiente1").style.display = "block";
            }else{
                document.getElementById("siguiente1").style.display = "none";
            }
        }

    function validar2(editProyecto) {
        const texMonInv = "ver que da";
        if (editProyecto['destinoFondos'].value !==''
        && editProyecto['montoTotal'].value !==''
        && editProyecto['inversionTotal'].value !=='') {
            document.getElementById("siguiente2").style.display = "block";
        }else{
            document.getElementById("siguiente2").style.display = "none";
        }
    }

    function monInversion(editProyecto){
        var monInv =  editProyecto['montoTotal'].value / editProyecto['inversionTotal'].value;
        if (monInv >= 0.8){
            editProyecto['relMonInv'].hidden=false;
            editProyecto['relMonInv'].value = 'relación monto -  inversión: ' + parseFloat(monInv * 100).toFixed(2) + "%";
        }else {
            editProyecto['relMonInv'].value = null;
            editProyecto['relMonInv'].hidden=true;
        }
    }

    function validar3(editProyecto) {
        if (//editProyecto['ciiuCs'].options[editProyecto['ciiuCs'].selectedIndex].value !== null
        editProyecto['moneda'].options[editProyecto['moneda'].selectedIndex].value !== null
        && editProyecto['tipodeCambio'].value > 0) {
            document.getElementById("siguiente3").style.display = "block";
            document.getElementById("enviar").style.display = "block";
            editProyecto.guardar.disabled = false;
        }
    }

    function siguiente1(){
        document.getElementById("siguiente1").style.display = "none";
        document.getElementById("anterior1").style.display = "block";
        document.getElementById("titulo01").style.display = "none";
        document.getElementById("titulo02").style.display = "block";
        document.getElementById("parte1").style.display = "none";
        document.getElementById("parte2").style.display = "block";
        if (editProyecto['destinoFondos'].value !==''
        && editProyecto['montoTotal'].value !==''
        && editProyecto['inversionTotal'].value !=='') {
            document.getElementById("siguiente2").style.display = "block";
        }

    }

    function siguiente2(){
        document.getElementById("siguiente2").style.display = "none";
        document.getElementById("anterior1").style.display = "none";
        document.getElementById("anterior2").style.display = "block";
        document.getElementById("titulo02").style.display = "none";
        document.getElementById("titulo03").style.display = "block";
        document.getElementById("parte2").style.display = "none";
        document.getElementById("parte3").style.display = "block";
        if (//editProyecto['ciiuCs'].options[editProyecto['ciiuCs'].selectedIndex].value !== null
        editProyecto['moneda'].options[editProyecto['moneda'].selectedIndex].value !== null
        && editProyecto['tipodeCambio'].value > 0) {
            document.getElementById("enviar").style.display = "block";
            document.getElementById("siguiente3").style.display = "block";
            editProyecto.guardar.disabled = false;
        }
    }

    function siguiente3(){
        document.getElementById("siguiente3").style.display = "none";
        document.getElementById("anterior2").style.display = "none";
        document.getElementById("anterior3").style.display = "block";
        document.getElementById("titulo03").style.display = "none";
        document.getElementById("titulo04").style.display = "block";
        document.getElementById("parte3").style.display = "none";
        document.getElementById("parte4").style.display = "block";

    }

    function anterior1(){
        document.getElementById("titulo01").style.display = "block";
        document.getElementById("titulo02").style.display = "none";
        document.getElementById("siguiente1").style.display = "block";
        document.getElementById("siguiente2").style.display = "none";
        document.getElementById("anterior1").style.display = "none";
        document.getElementById("parte1").style.display = "block";
        document.getElementById("parte2").style.display = "none";

    }
    function anterior2(){
        document.getElementById("titulo02").style.display = "block";
        document.getElementById("titulo03").style.display = "none";
        document.getElementById("siguiente2").style.display = "block";
        document.getElementById("anterior2").style.display = "none";
        document.getElementById("anterior1").style.display = "block";
        document.getElementById("parte2").style.display = "block";
        document.getElementById("parte3").style.display = "none";
        document.getElementById("enviar").style.display = "none";
        editProyecto.guardar.disabled = true;
        document.getElementById("siguiente3").style.display = "none";
    }
    function anterior3(){
        document.getElementById("titulo03").style.display = "block";
        document.getElementById("titulo04").style.display = "none";
        document.getElementById("siguiente3").style.display = "block";
        document.getElementById("anterior3").style.display = "none";
        document.getElementById("anterior2").style.display = "block";
        document.getElementById("parte3").style.display = "block";
        document.getElementById("parte4").style.display = "none";
    }


function pegarciiu(){
    editProyecto['ciiuCs'].value = localStorage.getItem("miciiu");
}
