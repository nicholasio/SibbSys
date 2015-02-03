<div id="sidebar" class="sidebar pjax_links fixed">
	<div class="cog">+</div>

	<!-- <a href="index.php" class="logo display_none"><span>Adminica</span></a>  -->

	<div class="user_box dark_box clearfix">

		<?php 
			$auth = Zend_Auth::getInstance();
	    	$data = $auth->getStorage()->read();
	    	$id = $data->idUsuario;

		?>
				
		<a href="<?php echo $this->url(array('module'=>'professor','controller'=>'index','action'=>'alterar-foto'),null,1);?>"><img src="/files/<?php echo $data->Foto; ?>" width="85" height="110"></img></a>
		
		<p style="font-size: 12px;"><strong>
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
		</strong></p>
		
		<h3 style="font-size: 11px; "><a href="#"><strong><?php echo $data->Nome;?></strong></a></h3>
		
		
		<div style="margin: 15px 0 0 55px;">
			<ul>
				<li><a href="<?php echo $this->url(array('module'=>'professor','controller'=>'index','action'=>'altera-senha'),null,1);?>" style="font-size: 11px;" ><strong>Alterar Senha</strong></a><span class="divider">|</span></li>
				<li><a href="<?php echo $this->url(array('module'=>'default','controller'=>'index','action'=>'logout'),null,1); ?>" style="font-size: 11px;" ><strong>Sair</strong></a></li>
			</ul>
		</div>
	</div><!-- #user_box -->

	<ul class="side_accordion" id="nav_side"> <!-- add class 'open_multiple' to change to from accordion to toggles -->
	
		<li><a href="<?php echo $this->url(array('controller'=>'index'),null,1); ?>"><img src="/images/icons/small/grey/home_2.png"/><span>Home</span></a></li>
		<li><a href="<?php echo $this->url(array('module'=>'professor','controller'=>'index','action'=>'turmas'),null,1); ?>"><img src="/images/icons/small/grey/admin_user_2.png"/><span>Turmas que Leciono</span></a></li>
		<li><a href="#"><img src="/images/icons/small/grey/list.png"/><span>Listas</span></a>
			<ul class="drawer">
				<?php $model = new Application_Model_DbTable_Turma(); 
					$rows = $model->turmas($id);
					foreach($rows as $turma){ ?>
						<li><a href="#"><span><?php echo $turma->Nome; ?></span></a>
							<ul class="drawer">
								<li><a href="<?php echo $this->url(array('module'=>'professor','controller'=>'presenca','action'=>'listar','idTurma'=>$turma->idTurma),null,1); ?>"><span>Lista de alunos com faltas</span></a></li>
								<li><a href="<?php echo $this->url(array('module'=>'professor','controller'=>'arquivo','action'=>'listar','idTurma'=>$turma->idTurma),null,1); ?>"><span>Lista de arquivos</span></a></li>
							</ul>
						</li>
				<?php }?>
			</ul>
		</li>
		<li><a href="#"><img src="/images/icons/small/grey/books.png"><span>Minhas Turmas</span></a>
			<ul class="drawer">
				<li><a href="<?php echo $this->url(array('module'=>'professor','controller'=>'minhasturmas','action'=>'historico'),null,1);?>"><img src="/images/icons/small/white/pdf_document.png"><span>Histórico</span></a></li>
				<li><a href="<?php echo $this->url(array('module'=>'professor','controller'=>'minhasturmas','action'=>'turma'),null,1);?>"><img src="/images/icons/small/white/folder.png"><span>Matérial de Aulas</span></a></li>
				<li><a href="<?php echo $this->url(array('module'=>'professor','controller'=>'minhasturmas','action'=>'boletim'),null,1);?>"><img src="/images/icons/small/white/post_card.png"><span>Boletim</span></a></li>
			</ul>
		</li>
		<li><a href="<?php echo $this->url(array('module'=>'professor','controller'=>'index','action'=>'alterar-dados'),null,1);?>"><img src="/images/icons/small/grey/v_card.png"><span>Alterar Dados</span></a></li>
	</ul>
</div><!-- #sidebar -->
