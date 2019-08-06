<?php
/*
  Created on : 06/08/2019, 16:18PM
  Author     : Enio Marcelo - eniomarcelo@gmail.com
 */


defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!-- BLANK CODE - blank -->
<script>

     $(function(){
     
          /*$('h1').css('color','green');*/
     
     });

</script>

<div class="jumbotron text-center">
  <h1>Entrou na INDEX</h1>
  <p>Resize this responsive page to see the effect!</p> 
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-4">
      <h3>Column 1</h3>
      <p><?=$this->m->fcn_get_genero( ['genero'=>'MASCULINO'] );?></p>
    </div>
    <div class="col-sm-4">
      <h3>Column 2</h3>
      <p><?=$this->m->fcn_get_genero( ['genero'=>'FEMININO']) ;?></p>
    </div>
    <div class="col-sm-4">
      <h3>Column 3</h3> 
      <p><?=$this->m->fcn_get_genero( ['genero'=>'INDEFINIDO']) ;?></p>
    </div>
  </div>
</div>

<!-- END BLANK CODE - blank -->





<!-- FUNÇÕES JQUERY -->
<script>

  /**
   * DESLIGA O MODAL DE AGUARDE DEPOIS QUE CARREGA TODO O CONTEÚDO
   */
  $(function () {
      parent.$('#modal-aguarde').modal('hide');
  });

</script>  
<!-- END FUNÇÕES JQUERY -->




