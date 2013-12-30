  <div class="navbar">
	<div class="navbar-inner">
	  <div class="container-fluid">
		  <ul class="nav">
        <li class="">
          <a href="/">Home</a>
        </li>
        <li class="divider-vertical"></li>
        <li class="">
          <a href="<?php echo $this->url(array('module'=>'admin','controller'=>'matricula','action'=>'index'),null,1); ?>">Matrícula</a>
        </li>
        <li class="divider-vertical"></li>
        <li>
          <a href="<?php echo $this->url(array('module'=>'admin','controller'=>'usuario','action'=>'index'),null,1); ?>">Cadastrar Usuário</a>
        </li>
        <li class="divider-vertical"></li>
        <li class="">
          <a href="<?php echo $this->url(array('module'=>'admin','controller'=>'curso','action'=>'index'),null,1); ?>">Cadastrar Curso</a>
        </li>
        <li class="divider-vertical"></li>
        <li class="">
          <a href="<?php echo $this->url(array('module'=>'admin','controller'=>'disciplina','action'=>'index'),null,1); ?>">Cadastrar Disciplina</a>
        </li>
        <li class="divider-vertical"></li>
        <li class="">
          <a href="<?php echo $this->url(array('module'=>'admin','controller'=>'turma','action'=>'index'),null,1); ?>">Cadastrar Turma</a>
        </li>
        <li class="divider-vertical"></li>
        <li class="">
          <a href="<?php echo $this->url(array('module'=>'admin','controller'=>'igreja','action'=>'index'),null,1); ?>">Cadastrar Igreja</a>
        </li>
        <li class="divider-vertical"></li>
        <li class="">
          <a href="<?php echo $this->url(array('module'=>'admin','controller'=>'minhasturmas','action'=>'index'),null,1); ?>">Minhas turmas</a>
        </li>
        <li class="">
          <a href="<?php echo $this->url(array('module'=>'admin','controller'=>'financeiro','action'=>'index'),null,1); ?>">Financeiro</a>
        </li>
      </ul>
	  </div>
	</div>
</div>