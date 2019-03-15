<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--
/*
  Created on : {{created-date}}, {{created-time}}
  Author     : {{author-name}} - {{author-email}}
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


            <a href='<?= site_url($this->router->fetch_class() . '/export' . '?' . bz_app_parametros_url()); ?>' class='btn btn-sm btn-primary btn-show-modal-aguarde xmargin-left-15' name='btn-export' value='btn-export'>
                <span class='glyphicon glyphicon-print'></span> Imprimir
            </a>


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
                    
                    
                    <!-- BOTÕES AVULSOS -->
                    <a id="buttons-loose-before-inputsearch" class="pull-right"></a>
                    <!-- BOTÕES AVULSOS -->

                    {{grid-list-input-search}}
                    
                    <!-- BOTÕES AVULSOS -->
                    <a id="buttons-loose-after-inputsearch" class="pull-right"></a>
                    <!-- BOTÕES AVULSOS -->
                    

					<div class='input-group-btn {{grid-list-div-buttons}}'>

                        
                        <!-- BOTÕES AVULSOS -->
                        <a id="buttons-loose-before"></a>
                        <!-- BOTÕES AVULSOS -->
                        
                        
                        {{grid-list-button-search}}

                        {{grid-list-button-clear}}
                        
                        
                        
                        <!-- BOTÕES AVULSOS -->
                        <a id="buttons-loose-after"></a>
                        <!-- BOTÕES AVULSOS -->
                        
                        
                        
						<!-- BTN ATIVO/INATIVO -->
						<?php if(  '{{grid-list-show-status}}' == 'Y'  ):?>
							<!-- BTN ATIVO -->
							<a href='<?= site_url($this->router->fetch_class()); ?>?ativo=Y<?= (($this->input->get('search')) ? '&search=' . $this->input->get('search') : ''); ?>' class='btn btn-sm btn-success btn-show-modal-aguarde j-tooltip margin-left-10 <?= (strtoupper($this->input->get('ativo', TRUE)) == 'Y') ? 'disabled' : ''; ?>' data-placement='bottom' data-toggle='tooltip' data-original-title='ATIVADO'><i class='fa fa-check-circle-o'></i></a>
							<!-- BTN ATIVO -->

							<!-- BTN INATIVO -->
							<a href='<?= site_url($this->router->fetch_class()); ?>?ativo=N<?= (($this->input->get('search')) ? '&search=' . $this->input->get('search') : ''); ?>' class='btn btn-sm btn-danger btn-show-modal-aguarde j-tooltip <?= (strtoupper($this->input->get('ativo', TRUE)) == 'N') ? 'disabled' : ''; ?>' data-placement='bottom' data-toggle='tooltip' data-original-title='DESATIVADO'><i class='fa fa-circle-o'></i></a>
							<!-- BTN INATIVO -->
						<?php endif; ?>
						<!-- BTN ATIVO/INATIVO -->
                        
                        
                        
                        <!-- BTN FULL SCREEN -->
						<a class='btn btn-sm btn-flat j-btn-open-modal-fullscreen j-tooltip' data-placement='bottom' data-toggle='tooltip' data-original-title='Tela Cheia'><i class='fa fa-external-link'></i></a>
						<!-- BTN FULL SCREEN -->	

                        <!-- BTN CLOSE FULL SCREEN -->
                        <a style="display: none" class='btn btn-sm btn-flat j-btn-close-modal-fullscreen j-tooltip' data-placement='bottom' data-toggle='tooltip' data-original-title='Fechar Tela'><i class='fa fa-close'></i></a>
                        <!-- BTN CLOSE FULL SCREEN -->	
                        
                        

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

						{{grid-list-header-table}}

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
                        {{grid-list-on-record}}
                        ?>

                        <tr id="<?=$_row['{{primary_key_field}}'];?>" style="<?=$_style_tr;?>" class="ClTableGridListTbodyTr <?=$_class_tr;?>">
							<!-- MARCA REGISTRO PARA SER DELETADO -->
							<td class="text-center" style='width:3%;'><input class="checkbox checkbox-unit flat-red text-center" type="checkbox" name="btn-delete[]" value="<?= $_row['{{primary_key_field}}']; ?>"></td>
							<!-- END MARCA REGISTRO PARA SER DELETADO -->

							<td class='text-center'  ><?= $_c; ?></td>

							<!-- CAMPOS DA TABLE -->
							{{grid-list-fields-table}}
							<!-- CAMPOS DA TABLE -->

							<!-- BTN ACTION'S -->
							<td class="tdBtnAction">
                                <!-- BTN EDITA REGISTRO -->
								<?php $_edit = site_url($this->router->fetch_class() . '/edit/' . $_row['{{primary_key_field}}'] . '?' . bz_app_parametros_url()); ?>
								<a href="<?= $_edit; ?>" class="btn btn-xs btn-primary btn-show-modal-aguarde ">
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


{{grid-list-scripts-css}}

{{grid-list-scripts-js}}