<div id="sidebar" class="sidebar pjax_links fixed">

	<div class="cog">+</div>

	<a href="index.php" class="logo display_none"><span>Adminica</span></a>

	<div class="user_box dark_box clearfix">

		<?php 
			$auth = Zend_Auth::getInstance();
	    	$data = $auth->getStorage()->read();

		?>
	
		<img src="/files/<?php echo $data->Foto; ?>" width="70" height="90"></img>
		<h3>
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
		</h3>
		<h3><a href="#"><?php echo $data->Nome;?></a></h3>
		<br /><br />
		<ul>
			<li><a href="#">settings</a><span class="divider">|</span></li>
			<li><a href="<?= $this->url(array('module'=>'default','controller'=>'index','action'=>'logout'),null,1); ?>" class="dialog_button" data-dialog="dialog_logout">Logout</a></li>
		</ul>
	</div><!-- #user_box -->

	<ul class="side_accordion" id="nav_side"> <!-- add class 'open_multiple' to change to from accordion to toggles -->
		<li><a href="<?= $this->url(array('controller'=>'index'),null,1); ?>"><img src="/images/icons/small/grey/home_2.png"/><span>Home</span></a></li>
		<li><a href="#"><img src="/images/icons/small/grey/users_2.png"/><span>Usuários</span></a>
			<ul class="drawer">
				<li><a href="<?= $this->url(array('module'=>'admin','controller'=>'usuario','action'=>'novo'),null,1); ?>"><span>Cadastrar</span></a></li>
				<li><a href="<?= $this->url(array('module'=>'admin','controller'=>'usuario','action'=>'index'),null,1); ?>"><span>Listar</span></a></li>
			</ul> 
		</li>
		<li><a href="#"><img src="/images/icons/small/grey/v_card.png"/><span>Matrículas</span></a>
			<ul class="drawer">
				<li><a href="<?= $this->url(array('module'=>'admin','controller'=>'matricula','action'=>'novo'),null,1); ?>"><span>Matricular</span></a></li>
				<li><a href="<?= $this->url(array('module'=>'admin','controller'=>'matricula','action'=>'index'),null,1); ?>"><span>Listar Matrículas</span></a></li>

			</ul>
		</li>
		<li><a href="#"><img src="/images/icons/small/grey/companies.png" /><span>Igreja</span></a>
			<ul class="drawer">
				<li><a href="<?= $this->url(array('module'=>'admin','controller'=>'igreja','action'=>'novo'),null,1); ?>"><span>Cadastrar</span></a></li>
				<li><a href="<?= $this->url(array('module'=>'admin','controller'=>'igreja','action'=>'index'),null,1); ?>"><span>Listar</span></a></li>

			</ul>
		</li>
		<li><a href="#"><img src="/images/icons/small/grey/books.png"/><span>Curso</span></a>
			<ul class="drawer">
				<li><a href="<?= $this->url(array('module'=>'admin','controller'=>'curso','action'=>'novo'),null,1); ?>"><span>Cadastrar</span></a></li>
				<li><a href="<?= $this->url(array('module'=>'admin','controller'=>'curso','action'=>'index'),null,1); ?>"><span>Listar</span></a></li>

			</ul>
		</li>
		<li><a href="#"><img src="/images/icons/small/grey/delicious.png"/><span>Disciplina</span></a>
			<ul class="drawer">
				<li><a href="<?= $this->url(array('module'=>'admin','controller'=>'disciplina','action'=>'novo'),null,1); ?>"><span>Cadastrar</span></a></li>
				<li><a href="<?= $this->url(array('module'=>'admin','controller'=>'disciplina','action'=>'index'),null,1); ?>"><span>Listar</span></a></li>

			</ul>
		</li>
		<li><a href="#"><img src="/images/icons/small/grey/users.png"/><span>Turma</span></a>
			<ul class="drawer">
				<li><a href="<?= $this->url(array('module'=>'admin','controller'=>'turma','action'=>'novo'),null,1); ?>"><span>Cadastrar</span></a></li>
				<li><a href="<?= $this->url(array('module'=>'admin','controller'=>'turma','action'=>'index'),null,1); ?>"><span>Listar</span></a></li>

			</ul>
		</li>
		<li><a href="#"><img src="/images/icons/small/grey/cog_4.png"/><span>Serviços</span></a>
			<ul class="drawer">
				<li><a href="<?= $this->url(array('module'=>'admin','controller'=>'servicos','action'=>'novo'),null,1);?>"><span>Cadastrar</span></a></li>
				<li><a href="<?= $this->url(array('module'=>'admin','controller'=>'servicos','action'=>'index'),null,1);?>"><span>Listar</span></a></li>
			</ul>
		</li>
		<li><a href="#"><img src="/images/icons/small/grey/money_2.png"/><span>Financeiro</span></a>
			<ul class="drawer">
			
				<li><a href="<?= $this->url(array('module'=>'admin', 'controller'=>'credito', 'action'=>'index'),null,1);?>"><span>Alterar valor do crédito</span></a>
				<li><a href="#"><img src="/images/icons/small/white/money.png"><span>Debitos</span></a>
					<ul class="drawer">
						<li><a href="<?= $this->url(array('module'=>'admin','controller'=>'debitos','action'=>'novo'),null,1);?>"><span>Cadastrar</span></a></li>
						<li><a href="<?= $this->url(array('module'=>'admin','controller'=>'debitos','action'=>'index'),null,1);?>"><span>Listar</span></a></li>
					</ul>
				</li>
				<li><a href="<?= $this->url(array('module'=>'admin','controller'=>'faturas','action'=>'index'),null,1);?>"><img src="/images/icons/small/white/post_card.png"><span>Fatura</span></a></li>
				<li><a href="<?= $this->url(array('module'=>'admin','controller'=>'pagamento','action'=>'index'),null,1); ?>"><img src="/images/icons/small/white/cash_register.png"><span>Pagamento</span></a></li>
			</ul>
		</li>
		<li><a href="#"><img src="/images/icons/small/grey/list.png"/><span>Minhas Turmas</span></a>
			<ul class="drawer">
				<li><a href="<?= $this->url(array('module'=>'admin','controller'=>'minhasturmas','action'=>'historico'),null,1);?>"><img src="/images/icons/small/white/pdf_document.png"><span>Histórico</span></a></li>
				<li><a href="<?= $this->url(array('module'=>'admin','controller'=>'minhasturmas','action'=>'turma'),null,1);?>"><img src="/images/icons/small/white/folder.png"><span>Matérial de Aulas</span></a></li>
				<li><a href="<?= $this->url(array('module'=>'admin','controller'=>'minhasturmas','action'=>'boletim'),null,1);?>"><img src="/images/icons/small/white/post_card.png"><span>Boletim</span></a></li>
			</ul>
		</li>
		<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'index','action'=>'altera-senha'),null,1);?>"><img src="/images/icons/small/grey/key_2.png"><span>Alterar Senha</span></a></li>
	</ul>

	<!--<div id="search_side" class="dark_box"><form><input class="" type="text" placeholder="Search Adminica..."></form></div>

	<ul id="side_links" class="side_links" style="margin-bottom:0;">
		<li><a target="_blank" href="http://twitter.github.com/bootstrap/">Bootstrap</a>
		<li><a target="_blank" href="https://github.com/twitter/bootstrap/">Source</a></li>
		<li><a target="_blank" href="http://tricycle.ticksy.com/">Support</a></li>
	</ul>-->
</div><!-- #sidebar -->
