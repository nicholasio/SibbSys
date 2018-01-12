<div id="sidebar" class="sidebar pjax_links fixed">

	<div class="cog">+</div>

	<a href="index.php" class="logo display_none"><span>Adminica</span></a>

	<div class="user_box dark_box clearfix">

		<?php 
			$auth = Zend_Auth::getInstance();
	    	$data = $auth->getStorage()->read();
	    	$id = $data->idUsuario;

		?>
	
		<a href="<?php echo $this->url(array('module'=>'admin','controller'=>'index','action'=>'alterar-foto'),null,1);?>"><img src="/files/<?php echo $data->Foto; ?>" width="85" height="110"></img></a>
		
		<p style="font-size: 10px;"><strong>
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
		
		<h3 style="font-size: 11px; "><strong><a href="#"><?php echo $data->Nome; ?></a></strong></h3>
		
  		
  						

		<div style="margin: 15px 0 0 60px;">
			<ul>
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'index','action'=>'altera-senha'),null,1);?>" style="font-size: 11px; "><strong>Alterar Senha</strong></a><span class="divider">|</span></li>
				<li><a href="<?php echo $this->url(array('module'=>'default','controller'=>'index','action'=>'logout'),null,1);?>" style="font-size: 11px; "><strong>Sair</strong></a></li>
			</ul>
		</div>
	</div><!-- #user_box -->

	<ul class="side_accordion" id="nav_side"> <!-- add class 'open_multiple' to change to from accordion to toggles -->
		<li><a href="<?php echo $this->url(array('controller'=>'index'),null,1); ?>"><img src="/images/icons/small/grey/home_2.png"/><span>Home</span></a></li>
		<li><a href="#"><img src="/images/icons/small/grey/users_2.png"/><span>Usuários</span></a>
			<ul class="drawer">
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'usuario','action'=>'novo'),null,1); ?>"><span>Cadastrar</span></a></li>
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'usuario','action'=>'index'),null,1); ?>"><span>Listar</span></a></li>
			</ul> 
		</li>
		<li><a href="#"><img src="/images/icons/small/grey/v_card.png"/><span>Matrículas</span></a>
			<ul class="drawer">
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'matricula','action'=>'novo'),null,1); ?>"><span>Matricular</span></a></li>
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'matricula','action'=>'index'),null,1); ?>"><span>Listar Matrículas</span></a></li>
			</ul>
		</li>
		<li><a href="#"><img src="/images/icons/small/grey/companies.png" /><span>Igreja</span></a>
			<ul class="drawer">
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'igreja','action'=>'novo'),null,1); ?>"><span>Cadastrar</span></a></li>
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'igreja','action'=>'index'),null,1); ?>"><span>Listar</span></a></li>
			</ul>
		</li>
		<li><a href="#"><img src="/images/icons/small/grey/books.png"/><span>Curso</span></a>
			<ul class="drawer">
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'curso','action'=>'novo'),null,1); ?>"><span>Cadastrar</span></a></li>
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'curso','action'=>'index'),null,1); ?>"><span>Listar</span></a></li>
			</ul>
		</li>
		<li><a href="#"><img src="/images/icons/small/grey/delicious.png"/><span>Disciplina</span></a>
			<ul class="drawer">
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'disciplina','action'=>'novo'),null,1); ?>"><span>Cadastrar</span></a></li>
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'disciplina','action'=>'index'),null,1); ?>"><span>Listar</span></a></li>
			</ul>
		</li>
		<li><a href="#"><img src="/images/icons/small/grey/users.png"/><span>Turma</span></a>
			<ul class="drawer">
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'turma','action'=>'novo'),null,1); ?>"><span>Cadastrar</span></a></li>
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'turma','action'=>'index'),null,1); ?>"><span>Listar</span></a></li>
			</ul>
		</li>
		<li><a href="#"><img src="/images/icons/small/grey/cog_4.png"/><span>Serviços</span></a>
			<ul class="drawer">
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'servicos','action'=>'novo'),null,1);?>"><span>Cadastrar</span></a></li>
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'servicos','action'=>'index'),null,1);?>"><span>Listar</span></a></li>
			</ul>
		</li>
		<li><a href="#"><img src="/images/icons/small/grey/money_2.png"/><span>Financeiro</span></a>
			<ul class="drawer">
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'debitos','action'=>'index'),null,1);?>"><img src="/images/icons/small/white/money.png"><span>Debitos</span></a>
					<!--<ul class="drawer">
						<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'debitos','action'=>'novo'),null,1);?>"><span>Cadastrar</span></a></li>
						<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'debitos','action'=>'index'),null,1);?>"><span>Listar</span></a></li>
					</ul>-->
				</li>
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'faturas','action'=>'index'),null,1);?>"><img src="/images/icons/small/white/post_card.png"><span>Fatura</span></a></li>
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'faturas','action'=>'relatorio'),null,1); ?>"><img src="/images/icons/small/white/list.png"><span>Lista de Pendentes</span></a></li>
			</ul>
		</li>
		
		<li><a href="#"><img src="/images/icons/small/grey/admin_user_2.png"/><span>Professor</span></a>
			<ul class="drawer">
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'professor','action'=>'index'), null,1);?>"><img/><span>Turmas</span></a></li>
				<li><a href="#"><img src="/images/icons/small/white/list.png"/><span>Listagem</span></a>
					<ul class="drawer">
						<?php 
							$model = new Application_Model_DbTable_Turma();
							$rows = $model->turmas($id);
							foreach($rows as $turma){	?>
								<li><a href="#"><span><?php echo $turma->Nome; ?></span></a>
									<ul class="drawer">
										<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'professor','action'=>'lista-presenca','idTurma'=>$turma->idTurma),null,1); ?>"><span>Presença</span></a></li>
										<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'arquivo','action'=>'listar','idTurma'=>$turma->idTurma),null,1); ?>"><span>Arquivos</span></a></li>
									</ul>
								</li>
						<?php }?>
					</ul>
				</li>
			</ul>
		</li>		
		
		<li><a href="#"><img src="/images/icons/small/grey/list.png"/><span>Minhas Turmas</span></a>
			<ul class="drawer">
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'minhasturmas','action'=>'historico'),null,1);?>"><img src="/images/icons/small/white/pdf_document.png"><span>Histórico</span></a></li>
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'minhasturmas','action'=>'turma'),null,1);?>"><img src="/images/icons/small/white/folder.png"><span>Matérial de Aulas</span></a></li>
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'minhasturmas','action'=>'boletim'),null,1);?>"><img src="/images/icons/small/white/post_card.png"><span>Boletim</span></a></li>
			</ul>
		</li>
		<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'configs','action'=>'index'),null,1);?>"><img src="/images/icons/small/grey/cog_2.png"><span>Configurações</span></a></li>
	</ul>

	<!--<div id="search_side" class="dark_box"><form><input class="" type="text" placeholder="Search Adminica..."></form></div>

	<ul id="side_links" class="side_links" style="margin-bottom:0;">
		<li><a target="_blank" href="http://twitter.github.com/bootstrap/">Bootstrap</a>
		<li><a target="_blank" href="https://github.com/twitter/bootstrap/">Source</a></li>
		<li><a target="_blank" href="http://tricycle.ticksy.com/">Support</a></li>
	</ul>-->
</div><!-- #sidebar -->