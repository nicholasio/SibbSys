<div id="sidebar" class="sidebar pjax_links fixed">
	<div class="cog">+</div>

	<a href="index.php" class="logo display_none"><span>Adminica</span></a>

	<div class="user_box dark_box clearfix">

		<?php 
			$auth = Zend_Auth::getInstance();
	    	$data = $auth->getStorage()->read();

		?>
	
		<img src="/files/<?php echo $data->Foto; ?>" width="60" height="90"></img>
		<h2>
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
		</h2>
		<h3><a href="#"><?php echo $data->Nome;?></a></h3>
		<ul>
			<li><a href="#">settings</a><span class="divider">|</span></li>
			<li><a href="<?php echo $this->url(array('module'=>'default','controller'=>'index','action'=>'logout'),null,1); ?>" class="dialog_button" data-dialog="dialog_logout">Logout</a></li>
		</ul>
	</div><!-- #user_box -->

	<ul class="side_accordion" id="nav_side"> <!-- add class 'open_multiple' to change to from accordion to toggles -->
		<li><a href="<?php echo $this->url(array('controller'=>'index'),null,1); ?>"><img src="/images/icons/small/grey/laptop.png"/><span>Home</span></a></li>
		<li><a href="#"><img src="/images/icons/small/grey/list.png"/><span>Usuários</span></a>
			<ul class="drawer">
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'usuario','action'=>'novo'),null,1); ?>"><span>Cadastrar</span></a></li>
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'usuario','action'=>'index'),null,1); ?>"><span>Listar</span></a></li>
			</ul> 
		</li>
		<li><a href="#"><img src="/images/icons/small/grey/frames.png"/><span>Matrículas</span></a>
			<ul class="drawer">
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'matricula','action'=>'index'),null,1); ?>"><span>Matricular</span></a></li>
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'matricula','action'=>'index'),null,1); ?>"><span>Listar Matrículas</span></a></li>

			</ul>
		</li>
		<li><a href="#"><img src="/images/icons/small/grey/list.png" /><span>Igreja</span></a>
			<ul class="drawer">
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'igreja','action'=>'index'),null,1); ?>"><span>Cadastrar</span></a></li>
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'igreja','action'=>'index'),null,1); ?>"><span>Listar</span></a></li>

			</ul>
		</li>
		<li><a href="#"><img src="/images/icons/small/grey/frames.png"/><span>Curso</span></a>
			<ul class="drawer">
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'igreja','action'=>'index'),null,1); ?>"><span>Cadastrar</span></a></li>
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'igreja','action'=>'index'),null,1); ?>"><span>Listar</span></a></li>

			</ul>
		</li>
		<li><a href="#"><img src="/images/icons/small/grey/list.png"/><span>Disciplina</span></a>
			<ul class="drawer">
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'igreja','action'=>'index'),null,1); ?>"><span>Cadastrar</span></a></li>
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'igreja','action'=>'index'),null,1); ?>"><span>Listar</span></a></li>

			</ul>
		</li>
		<li><a href="#"><img src="/images/icons/small/grey/frames.png"/><span>Turma</span></a>
			<ul class="drawer">
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'igreja','action'=>'index'),null,1); ?>"><span>Cadastrar</span></a></li>
				<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'igreja','action'=>'index'),null,1); ?>"><span>Listar</span></a></li>

			</ul>
		</li>
	</ul>

	<div id="search_side" class="dark_box"><form><input class="" type="text" placeholder="Search Adminica..."></form></div>

	<ul id="side_links" class="side_links" style="margin-bottom:0;">
		<li><a target="_blank" href="http://twitter.github.com/bootstrap/">Bootstrap</a>
		<li><a target="_blank" href="https://github.com/twitter/bootstrap/">Source</a></li>
		<li><a target="_blank" href="http://tricycle.ticksy.com/">Support</a></li>
	</ul>
</div><!-- #sidebar -->
