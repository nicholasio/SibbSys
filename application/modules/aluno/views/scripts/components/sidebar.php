<div id="sidebar" class="sidebar pjax_links fixed">

	<div class="cog">+</div>

	<a href="index.php" class="logo display_none"><span>Adminica</span></a>

	<div class="user_box dark_box clearfix">

		<?php 
			$auth = Zend_Auth::getInstance();
	    	$data = $auth->getStorage()->read();
		?>
		
		
		
		<img src="/files/<?php echo $data->Foto; ?>" width="70" height="90"></img>
		
		<h3><a href="#"><?php echo $data->Nome;?></a></h3>
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
		
		<br />
		<ul>
			<li><a href="<?php echo $this->url(array('module'=>'aluno','controller'=>'index','action'=>'altera-senha'),null,1);?>">Alterar Senha</a><span class="divider"> |  </span></li>
			<li><a href="<?php echo $this->url(array('module'=>'default','controller'=>'index','action'=>'logout'),null,1); ?>">Sair</a></li>
		</ul>
	</div><!-- #user_box -->

	<ul class="side_accordion" id="nav_side"> <!-- add class 'open_multiple' to change to from accordion to toggles -->
	
		<li><a href="<?= $this->url(array('controller'=>'index'),null,1); ?>"><img src="/images/icons/small/grey/home_2.png"/><span>Home</span></a></li>
		<li><a href="<?= $this->url(array('module'=>'aluno','controller'=>'index','action'=>'turma'),null,1); ?>"><img src="/images/icons/small/grey/folder.png"/><span>Matérial de Aulas</span></a></li>
		<li><a href="<?= $this->url(array('module'=>'aluno','controller'=>'index','action'=>'historico'),null,1); ?>"><img src="/images/icons/small/grey/pdf_document.png"/><span>Histórico</span></a></li>
		<li><a href="<?= $this->url(array('module'=>'aluno','controller'=>'index','action'=>'boletim'),null,1); ?>"><img src="/images/icons/small/grey/post_card.png"/><span>Boletim</span></a></li>
		
	</ul>

	<!-- <div id="search_side" class="dark_box"><form><input class="" type="text" placeholder="Search Adminica..."></form></div>

	<ul id="side_links" class="side_links" style="margin-bottom:0;">
		<li><a target="_blank" href="http://twitter.github.com/bootstrap/">Bootstrap</a>
		<li><a target="_blank" href="https://github.com/twitter/bootstrap/">Source</a></li>
		<li><a target="_blank" href="http://tricycle.ticksy.com/">Support</a></li>
	</ul> -->
</div><!-- #sidebar -->
