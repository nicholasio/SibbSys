<div id="sidebar" class="sidebar pjax_links fixed">

	<div class="cog">+</div>

	<!-- <a href="index.php" class="logo display_none"><span>Adminica</span></a>  -->

	<div class="user_box dark_box clearfix">

		<?php 
			$auth = Zend_Auth::getInstance();
	    	$data = $auth->getStorage()->read();
	    	$id = $data->idUsuario;
		?>
		
		<a href="<?php echo $this->url(array('module'=>'aluno','controller'=>'index','action'=>'alterar-foto'),null,1);?>"><img src="/files/<?php echo $data->Foto; ?>" width="85" height="110"></img></a>
		
			<strong>
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
			</strong>
		
		
		<h3 style="font-size: 11px; "><a href="#" style="color: "><strong><?php echo $data->Nome;?></strong></a></h3>
		
		
		<strong>Curso: </strong>
		<?php $id = $data->Curso_idCurso; ?>
		<?php $curso_model = new Application_Model_DbTable_Curso(); ?>
		<?php $nome_curso = $curso_model->editar($id); ?>
		<h3  style="font-size: 10px; "><a><strong><?php echo $nome_curso['Nome']; ?></strong></a></h3>
		
		
		
		
		<div style="margin: 15px 0 0 50px;">
			<ul>
				<li><a href="<?php echo $this->url(array('module'=>'aluno','controller'=>'index','action'=>'altera-senha'),null,1);?>" style="font-size: 11px;"><strong>Alterar Senha</strong></a><span class="divider"> |  </span></li>
				<li><a href="<?php echo $this->url(array('module'=>'default','controller'=>'index','action'=>'logout'),null,1); ?>"  style="font-size: 11px;"><strong>Sair</strong></a></li>
			</ul>
		</div>
		
	</div><!-- #user_box -->
		
	<ul class="side_accordion" id="nav_side"> <!-- add class 'open_multiple' to change to from accordion to toggles -->
	
		<li><a href="<?php echo $this->url(array('controller'=>'index'),null,1); ?>"><img src="/images/icons/small/grey/home_2.png"/><span>Home</span></a></li>
		<li><a href="<?php echo $this->url(array('module'=>'aluno','controller'=>'index','action'=>'turma'),null,1); ?>"><img src="/images/icons/small/grey/folder.png"/><span>Matérial de Aulas</span></a></li>
		<li><a href="<?php echo $this->url(array('module'=>'aluno','controller'=>'index','action'=>'historico'),null,1); ?>"><img src="/images/icons/small/grey/pdf_document.png"/><span>Histórico</span></a></li>
		<li><a href="<?php echo $this->url(array('module'=>'aluno','controller'=>'index','action'=>'boletim'),null,1); ?>"><img src="/images/icons/small/grey/post_card.png"/><span>Boletim</span></a></li>
		<li><a href="<?php echo $this->url(array('module'=>'aluno','controller'=>'index','action'=>'alterar-dados'),null,1); ?>"><img src="/images/icons/small/grey/v_card.png"/><span>Alterar Dados</span></a></li>
		
	</ul>
	
	<div class="grid_16">
		
	</div>
</div><!-- #sidebar -->
