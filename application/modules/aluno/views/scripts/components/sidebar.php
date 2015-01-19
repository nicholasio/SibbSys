<div id="sidebar" class="sidebar pjax_links fixed">

	<div class="cog">+</div>

	<!-- <a href="index.php" class="logo display_none"><span>Adminica</span></a>  -->

	<div class="user_box dark_box clearfix">

		<?php 
			$auth = Zend_Auth::getInstance();
	    	$data = $auth->getStorage()->read();
		?>
		
		
		
		<img src="/files/<?php echo $data->Foto; ?>" width="78" height="110"></img>
		
	
			<?php switch($data->Tipo){
				case 1:
					echo "Administrador";
					break;
				case 2:
					echo "Professor";
					break;
				case 3:
					echo "Aluno";
					break;
			} ?>
		
		
		
		<h3 style="font-size: 11px; "><a href="#" style="color: "><?php echo $data->Nome;?></a></h3>
		
		
		Curso:
		<?php $id = $data->Curso_idCurso; ?>
		<?php $curso_model = new Application_Model_DbTable_Curso(); ?>
		<?php $nome_curso = $curso_model->editar($id); ?>
		<h3  style="font-size: 11px; "><a><?php echo $nome_curso['Nome']; ?></a></h3>
		
		
		
		
		<div style="margin: 10px 0 0 55px;">
			<ul>
				<li><a href="<?php echo $this->url(array('module'=>'aluno','controller'=>'index','action'=>'altera-senha'),null,1);?>" style="font-size: 12px;">Alterar Senha</a><span class="divider"> |  </span></li>
				<li><a href="<?php echo $this->url(array('module'=>'default','controller'=>'index','action'=>'logout'),null,1); ?>"  style="font-size: 12px;">Sair</a></li>
			</ul>
		</div>
		
	</div><!-- #user_box -->
		
	<ul class="side_accordion" id="nav_side"> <!-- add class 'open_multiple' to change to from accordion to toggles -->
	
		<li><a href="<?php echo $this->url(array('controller'=>'index'),null,1); ?>"><img src="/images/icons/small/grey/home_2.png"/><span>Home</span></a></li>
		<li><a href="<?php echo $this->url(array('module'=>'aluno','controller'=>'index','action'=>'turma'),null,1); ?>"><img src="/images/icons/small/grey/folder.png"/><span>Matérial de Aulas</span></a></li>
		<li><a href="<?php echo $this->url(array('module'=>'aluno','controller'=>'index','action'=>'historico'),null,1); ?>"><img src="/images/icons/small/grey/pdf_document.png"/><span>Histórico</span></a></li>
		<!-- <li><a data-toggle="modal" href="#myModal-<?php // echo $data->idUsuario; ?>"><img src="/images/icons/small/grey/pdf_document.png"/><span>Histórico</span></a></li> -->
		<li><a href="<?php echo $this->url(array('module'=>'aluno','controller'=>'index','action'=>'boletim'),null,1); ?>"><img src="/images/icons/small/grey/post_card.png"/><span>Boletim</span></a></li>
		
	</ul>
	
	<div class="grid_16">
		
	</div>
</div><!-- #sidebar -->
