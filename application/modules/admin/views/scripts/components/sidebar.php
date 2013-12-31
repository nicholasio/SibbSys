<div id="sidebar" class="sidebar pjax_links fixed">
	<div class="cog">+</div>

	<a href="index.php" class="logo display_none"><span>Adminica</span></a>

	<div class="user_box dark_box clearfix">

		<?php 
			$auth = Zend_Auth::getInstance();
	    	$data = $auth->getStorage()->read()
			/*$model = new Application_Model_DbTable_Usuario();
			$query = $model->selecionar();
			if(substr($query->DataNascimento,0,5) == date('d/m')){
				echo 'Feliz Aniversário, ';
			}
			else{ 
				echo 'Olá, ';
			}
		
		echo $this->data->Nome . '!';*/

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
		<h3><a href="#"><?php echo $data->Nome; ?></a></h3>
		<ul>
			<li><a href="#">settings</a><span class="divider">|</span></li>
			<li><a href="<?php echo $this->url(array('module'=>'default','controller'=>'index','action'=>'logout'),null,1); ?>" class="dialog_button" data-dialog="dialog_logout">Logout</a></li>
		</ul>
	</div><!-- #user_box -->

	<ul class="side_accordion" id="nav_side"> <!-- add class 'open_multiple' to change to from accordion to toggles -->
		<li><a href="<?php echo $this->url(array('controller'=>'index'),null,1); ?>"><img src="images/icons/small/grey/laptop.png"/><span>Home</span></a></li>
		<li><a href="<?php echo $this->url(array('module'=>'admin','controller'=>'matricula','action'=>'index'),null,1); ?>"><img src="images/icons/small/grey/frames.png"/><span>Matrícula</span></a></li>
		<li><a href="#"><img src="images/icons/small/grey/list.png"/><span>Base</span></a>
			<ul class="drawer">
				<li><a href="typography.php"><span>Typography</span></a></li>
				<li><a href="tables.php"><span>Tables</span></a></li>
				<li><a href="forms.php"><span>Forms</span></a></li>
				<li><a href="buttons.php"><span>Buttons</span></a></li>
				<li><a href="icons.php"><span>Icons</span></a></li>
			</ul>
		</li>
		<li><a target="_blank" href="http://twitter.github.com/bootstrap/components.html"><img src="images/icons/small/grey/blocks_images.png"/><span>Components</span></a></li>
		<li><a target="_blank" href="http://twitter.github.com/bootstrap/javascript.html"><img src="images/icons/small/grey/coverflow.png"/><span>Plugins</span></a></li>
	</ul>

	<div id="search_side" class="dark_box"><form><input class="" type="text" placeholder="Search Adminica..."></form></div>

	<ul id="side_links" class="side_links" style="margin-bottom:0;">
		<li><a target="_blank" href="http://twitter.github.com/bootstrap/">Bootstrap</a>
		<li><a target="_blank" href="https://github.com/twitter/bootstrap/">Source</a></li>
		<li><a target="_blank" href="http://tricycle.ticksy.com/">Support</a></li>
	</ul>
</div><!-- #sidebar -->
