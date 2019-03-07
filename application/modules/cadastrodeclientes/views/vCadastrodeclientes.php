<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--
/*
  Created on : 07/03/2019, 14:53PM
  Author     : Enio Marcelo - eniomarcelo@gmail.com
 */
-->


<section class='content-header header-dashboard' style='margin-top: 0px; margin-left: -15px; margin-bottom: 20px;'>
	<h1>
		<i class='<?= $_font_icon; ?>'></i>
		<?= $_titulo_app; ?>
		<small class='input-group-btn margin-left-10'>


			<a href='<?= site_url($this->router->fetch_class() . '/add' . '?' . bz_app_parametros_url()); ?>' class='btn btn-sm btn-info btn-show-modal-aguarde' name='btn-add' value='btn-add'>
				<span class='glyphicon glyphicon-plus'></span> Novo
			</a>

			<button type='button' id='btn-delete' class='btn btn-sm btn-danger disabled' name='btn-del' value='btn-del'>
				<span class='glyphicon glyphicon-trash'></span> Deleta
			</button>


		</small>
	</h1>
	<ol class='breadcrumb'>
		<li><a href='<?= site_url('dashboard'); ?>' target='_top' class='active btn-show-modal-aguarde'><i class='fa fa-dashboard'></i>Dashboard</a></li>
		<li class='active'><i class='<?= $_font_icon; ?> margin-right-5'></i><?= $_titulo_app; ?></li>
	</ol>
</section>


<!-- MENSAGEM DO SISTEM -->
<div class="message-toastr"></div>
<?= get_mensagem(); ?>
<!-- END MENSAGEM DO SISTEM -->


<div class='row hide-reload-screen'>

	<div class='box'>

		<!-- HEADER -->
		<div class='box-header'>
			<h3 class='box-title'></h3>
			<div class='box-tools'>

				<!-- FORM DE PESQUISA -->
				<?= form_open('', 'id="IdFormSearch_'.$this->router->fetch_class().'" role="form" method="GET"'); ?>
				<div class='input-group margin-top-10'>

                    <!-- INPUT SEARCH -->
                            <input type='text' name='search' value='<?= $this->input->get('search'); ?>' class='form-control input-sm pull-right' style ='width: 150px;' placeholder='Pesquisar' autofocus>
                            <!-- INPUT SEARCH -->

					<div class='input-group-btn '>

                        <!-- BTN SEARCH -->
                            <button class='btn btn-sm btn-primary btn-show-modal-aguarde j-tooltip' data-placement='bottom' data-toggle='tooltip' data-original-title='Pesquisa'><i class='fa fa-search'></i></button>
                            <!-- BTN SEARCH -->

                        <!-- BTN LIMPAR -->
                            <a href='<?= site_url($this->router->fetch_class()); ?>' class='btn btn-sm btn-default btn-show-modal-aguarde j-tooltip' data-placement='bottom' data-toggle='tooltip' data-original-title='Limpar'><i class='fa fa-refresh'></i></a>
                            <!-- BTN LIMPAR -->

                        <!-- BTN FULL SCREEN -->
						<a class='btn btn-sm btn-flat j-btn-open-modal-fullscreen j-tooltip' data-placement='bottom' data-toggle='tooltip' data-original-title='Tela Cheia'><i class='fa fa-external-link'></i></a>
						<!-- BTN FULL SCREEN -->	

                        <!-- BTN CLOSE FULL SCREEN -->
                        <a style="display: none" class='btn btn-sm btn-flat j-btn-close-modal-fullscreen j-tooltip' data-placement='bottom' data-toggle='tooltip' data-original-title='Fechar Tela'><i class='fa fa-close'></i></a>
                        <!-- BTN CLOSE FULL SCREEN -->	
                        
						<!-- BTN ATIVO/INATIVO -->
						<?php if(  'N' == 'Y'  ):?>
							<!-- BTN ATIVO -->
							<a href='<?= site_url($this->router->fetch_class()); ?>?ativo=Y<?= (($this->input->get('search')) ? '&search=' . $this->input->get('search') : ''); ?>' class='btn btn-sm btn-success btn-show-modal-aguarde j-tooltip margin-left-10 <?= (strtoupper($this->input->get('ativo', TRUE)) == 'Y') ? 'disabled' : ''; ?>' data-placement='bottom' data-toggle='tooltip' data-original-title='ATIVADO'><i class='fa fa-check-circle-o'></i></a>
							<!-- BTN ATIVO -->

							<!-- BTN INATIVO -->
							<a href='<?= site_url($this->router->fetch_class()); ?>?ativo=N<?= (($this->input->get('search')) ? '&search=' . $this->input->get('search') : ''); ?>' class='btn btn-sm btn-danger btn-show-modal-aguarde j-tooltip <?= (strtoupper($this->input->get('ativo', TRUE)) == 'N') ? 'disabled' : ''; ?>' data-placement='bottom' data-toggle='tooltip' data-original-title='DESATIVADO'><i class='fa fa-circle-o'></i></a>
							<!-- BTN INATIVO -->
						<?php endif; ?>
						<!-- BTN ATIVO/INATIVO -->

					</div>

				</div>
				<?= form_close(); ?>
				<!-- END FORM DE PESQUISA -->

			</div>
		</div><!-- /.box-header -->
		<!-- END HEADER -->



		<!-- CONTEÚDO DA TABLE -->
		<div class='box-body table-responsive no-padding margin-top-20'>


			<!-- TABLE -->
			<table id="IdTableGridList_<?=$this->router->fetch_class();?>" class='table table-hover table-striped table-bordered table-mark-row'>

				<!-- HEADER DA TABLE -->
				<thead class='thead-inverse bg-<?= ___BZ_LAYOUT_SKINCOLOR___; ?>'>
					<tr id="IdTableGridListTheadTr">
						<th class='text-center' style='width:3%;'><input class='checkbox-all flat-red' type='checkbox'></th>
						<th class='text-center' style='width:3%;'>#</th>

						<th class="thClId" class="text-center" style="width:6%; text-align:center">ID</th>
<th class="thClNome" class="text-left" style="text-align:left">Nome</th>
<th class="thClEndereco" class="text-left" style="text-align:left">Endereço</th>
<th class="thClGenero_id" class="text-left" style="text-align:left">Gênero</th>


						<th class='col-md-1 text-center'>Ação</th>
					</tr>
				</thead>
				<!-- END HEADER DA TABLE -->

				<!-- DADOS DA TABLE -->
				<tbody>

					<?php $_c = 0; ?>
                    <?php $_class_tr = '';?>
                    <?php $_style_tr = '';?>

					<?php foreach ($_result['results_paginacao_array'] as $_key => $_row): ?> 
                    
                        <?php $_row['btn-action'] = ''; ?>
                    
						<?php $_c++; ?>
                    
                        <?php
                        /* ON RECORD */
if( $_row['genero_id'] ):
     $_r = $this->read->ExecRead('cad_genero', 'WHERE id = ' . $_row['genero_id'])->row();
     $_row['genero_id'] = '<spam style="color:red">' . $_r->genero . '</spam>';
endif;     

?>

<script>

console.log('<?=$_row["id"];?>');

</script>


<?php


/* END ON RECORD */


                        ?>

                        <tr id="<?=$_row['id'];?>" style="<?=$_style_tr;?>" class="ClTableGridListTbodyTr <?=$_class_tr;?>">
							<!-- MARCA REGISTRO PARA SER DELETADO -->
							<td class="text-center" style='width:3%;'><input class="checkbox checkbox-unit flat-red text-center" type="checkbox" name="btn-delete[]" value="<?= $_row['id']; ?>"></td>
							<!-- END MARCA REGISTRO PARA SER DELETADO -->

							<td class='text-center'  ><?= $_c; ?></td>

							<!-- CAMPOS DA TABLE -->
							<td class="tdClId" class="text-center" style="width:6%; text-align:center"><?= $_row["id"]; ?></td>
<td class="tdClNome" class="text-left" style="text-align:left"><?= $_row["nome"]; ?></td>
<td class="tdClEndereco" class="text-left" style="text-align:left"><?= $_row["endereco"]; ?></td>
<td class="tdClGenero_id" class="text-left" style="text-align:left"><?= $_row["genero_id"]; ?></td>

							<!-- CAMPOS DA TABLE -->

							<!-- BTN ACTION'S -->
							<td class="tdBtnAction">
                                <!-- BTN EDITA REGISTRO -->
								<?php $_edit = site_url($this->router->fetch_class() . '/edit/' . $_row['id'] . '?' . bz_app_parametros_url()); ?>
								<a href="<?= $_edit; ?>" class="btn btn-xs btn-primary ">
									<span class="glyphicon glyphicon-edit j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Editar"></span>
								</a>
                                <!-- END BTN EDITA REGISTRO -->
                                
                                <!-- BTN ACTION CUSTOM -->
                                <?php
                                if( !empty($_row['btn-action']) ):
                                    echo $_row['btn-action'] ;
                                endif;
                                ?>
                                <!-- BTN ACTION CUSTOM -->
							</td>
                            <!-- END BTN ACTION'S -->
							
						</tr>

					<?php endforeach; ?>


				</tbody>
				<!-- END DADOS DA TABLE -->


			</table>
			<!-- END TABLE -->



			<!-- PAGINAÇÃO -->
			<div class="box-footer clearfix">
				<div class="text-center paginacao-links pagination pagination-sm no-margin pull-right">
					<?= $_result['links_paginacao']; ?>
				</div>
				<div class="text-left paginacao-links pagination pagination-sm no-margin text-primary">
					<div class="padding-top-5">
						<?= $_result['dados_paginacao']; ?>
					</div>
				</div>
			</div>
			<!-- END PAGINAÇÃO -->



		</div><!-- /.box-body -->
		<!-- END CONTEÚDO DA TABLE -->



	</div><!-- /.box -->

    <!--MODAL bzModal() GRID LIST-->
    <?php
    if( !empty($_modalGridList) ){
        echo $_modalGridList;
    }
    ?>
    <!--END MODAL bzModal() GRID LIST-->

</div>




