<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <button type="button"class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="brand" href="#" style="">Sistema Acadêmico - SibbSys</a>
      <ul class="nav pull-right">

        <li class="divider-vertical"></li>
        <li>
          <a target="_blank" href="#">Sobre</a>
        </li>
        <li class="divider-vertical"></li>
        <li>
          <a href="<?php echo $this->url(array('module'=>'default','controller'=>'index','action'=>'logout'),null,1); ?>">Logout</a>
        </li>
      </ul>
     </div>
  </div>
</div>