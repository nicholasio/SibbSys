<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <button type="button"class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="brand" href="#" style="">SIBB Acadêmico</a>
      <ul class="nav pull-right">

        <li class="divider-vertical"></li>
        <li>
          <a href="<?php echo $this->url(array('module'=>'professor','controller'=>'index','action'=>'sobre'),null,1); ?>" style="font-size: 12px;">Sobre</a>
        </li>
        <li class="divider-vertical"></li>
        <li>
          <a href="<?php echo $this->url(array('module'=>'default','controller'=>'index','action'=>'logout'),null,1); ?>" style="font-size: 12px;">Sair</a>
        </li>
      </ul>
     </div>
  </div>
</div>