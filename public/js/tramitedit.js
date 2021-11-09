
        function validar(edittramite) {
            var fecha = new Date(fechabanco);

            if (fecha.getFullYear()>0) {
              edittramite.notabanco.disabled = false;
            } else{
                edittramite.notabanco.disabled = true;
            }
        }

        function opennotas(){
            window.open('http://www.example.com?ReportID=1', '_blank');
        }
        function siguiente1(){
            document.getElementById("siguiente1").style.display = "none";
            document.getElementById("anterior1").style.display = "block";
            document.getElementById("titulo01").style.display = "none";
            document.getElementById("titulo02").style.display = "block";
            document.getElementById("parte1").style.display = "none";
            document.getElementById("parte2").style.display = "block";
        }

        function anterior1(){
            document.getElementById("titulo01").style.display = "block";
            document.getElementById("titulo02").style.display = "none";
            document.getElementById("siguiente1").style.display = "block";
            document.getElementById("anterior1").style.display = "none";
            document.getElementById("parte1").style.display = "block";
            document.getElementById("parte2").style.display = "none";
        }
        function changed(){
            document.getElementById("enviar").style.display = "block";
            edittramite.guardar.disabled = false;
        }
