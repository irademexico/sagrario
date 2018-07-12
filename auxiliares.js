<script type="text/javascript">

    function myVisible(){
      document.getElementById("fBautismo").style.visibility = 'visible';
      document.getElementById("fNombre").style.visibility = 'visible';
      document.getElementById("fEsposos").style.visibility = 'hidden';
      document.getElementById("fConfirma").style.visibility = 'hidden';
      document.getElementById("fMatrimonio").style.visibility = 'hidden';
      document.getElementById("fMatri").style.visibility = 'visible';
      document.getElementById("fPadres").style.visibility = 'visible';
      document.getElementById("fNacimiento").style.visibility = 'visible';
      document.getElementById("fPadrinos").style.visibility = 'visible';
      document.getElementById("fMadrina").style.visibility = 'visible';
    }
    function myVisible2(){
      document.getElementById("fBautismo").style.visibility = 'hidden';
        document.getElementById("fConfirma").style.visibility = 'visible';
        document.getElementById("fMatrimonio").style.visibility = 'hidden';
        document.getElementById("fMatri").style.visibility = 'hidden';
      document.getElementById("fNombre").style.visibility = 'visible';
      document.getElementById("fEsposos").style.visibility = 'hidden';
      document.getElementById("fPadres").style.visibility = 'visible';
      document.getElementById("fNacimiento").style.visibility = 'hidden';
      document.getElementById("fPadrinos").style.visibility = 'visible';
      document.getElementById("fMadrina").style.visibility = 'hidden';
    }
    function myVisible3(){
      document.getElementById("fBautismo").style.visibility = 'hidden';
        document.getElementById("fConfirma").style.visibility = 'hidden';
        document.getElementById("fMatrimonio").style.visibility = 'visible';
        document.getElementById("fMatri").style.visibility = 'hidden';
        document.getElementById("fNombre").style.visibility = 'hidden';
      document.getElementById("fEsposos").style.visibility = 'visible';
      document.getElementById("fPadres").style.visibility = 'hidden';
      document.getElementById("fPadrinos").style.visibility = 'hidden';
      document.getElementById("fNacimiento").style.visibility = 'hidden';
    }
    function verAprox(){
      if(document.getElementById("original").checked){
        document.getElementById("hasta").style.visibility = 'hidden'
      }
      else{
        document.getElementById("hasta").style.visibility = 'visible'
      }
    }

function enviab(pag){
  document.form.action= pag
  document.form.submit()
}

    $(document).ready(function () {
      $("#input1").keyup(function () {
          var value = $(this).val();
          $("#input2").val(value);
      });
  });

        $(document).ready(function () {
      $("#input3").keyup(function () {
          var value = $(this).val();
          $("#input4").val(value);
      });
  });

    function validar() {
          var inicio = document.getElementById('fecha_inicio').value;
          var finalq  = document.getElementById('fecha_fin').value;
          inicio= new Date(inicio);
          finalq= new Date(finalq);
          if(inicio>finalq)
          alert('La fecha de inicio puede ser mayor que la fecha fin');
          }

  </script>
