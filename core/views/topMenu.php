<div class="container">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo __siteurl ?>"><?php echo $_LANG['menu']['home'] ?></a>
      <a class="navbar-brand" href="<?php echo __siteurl ?>/?r=tasks/list"><?php echo $_LANG['menu']['Tasks'] ?></a>
      <a class="navbar-brand" href="<?php echo __siteurl ?>/?r=users/list"><?php echo $_LANG['menu']['Users'] ?></a>
      <a class="navbar-brand" href="<?php echo __siteurl ?>/?r=servers/servers"><?php echo $_LANG['menu']['Servers'] ?></a>
      <a class="navbar-brand" href="<?php echo __siteurl ?>/?r=store/files"><?php echo $_LANG['menu']['Store'] ?></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo __siteurl ?>/?r=settings/main"><?php echo $_LANG['menu']['Settings'] ?></a></li>
        <li><a href="<?php echo __siteurl ?>/?r=users/edit&id=<?php echo $userId ?>"><?php echo $userName ?></a></li>
        <li><a href="<?php echo __siteurl ?>/?r=logout"><?php echo $_LANG['menu']['logout'] ?></a></li>
      </ul>
    </div>
  </div>
</nav>
</div>