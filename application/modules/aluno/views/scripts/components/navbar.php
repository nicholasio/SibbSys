  <div class="navbar">
	<div class="navbar-inner">
	  <div class="container-fluid">
	  <ul class="nav">
        <li class="">
          <a href="/">Home</a>
        </li>
        <li class="divider-vertical"></li>
        <li class="">
          <a href="<?php echo $this->url(array('module'=>'professor','controller'=>'index','action'=>'turmas'),null,1); ?>">Turmas que Leciona</a>
        </li>
        <li class="divider-vertical"></li>
        <li>
          <a href="<?php echo $this->url(array('module'=>'professor','controller'=>'minhasturmas','action'=>'index'),null,1); ?>">Minhas Turmas</a>
        </li>
        <li class="divider-vertical"></li>
        <li class="">
          <a href="<?php echo $this->url(array('module'=>'professor','controller'=>'index','action'=>'altera-senha'),null,1); ?>">Alterar Senha</a>
        </li>
      </ul>
	  </div>
	</div>
</div>