<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand <?php echo $mainToggle ?>" href="<?php echo __siteurl ?>"><?php echo $_LANG['menu']['home'] ?></a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="<?php echo $tasksToggle ?>"><a class="navbar-brand" href="<?php echo __siteurl ?>/?r=tasks/list"><?php echo $_LANG['menu']['Tasks'] ?></a></li>
        <li class="<?php echo $usersToggle ?>"><a class="navbar-brand" href="<?php echo __siteurl ?>/?r=users/list"><?php echo $_LANG['menu']['Users'] ?></a></li>
        <li class="<?php echo $serversToggle ?>"><a class="navbar-brand" href="<?php echo __siteurl ?>/?r=servers/servers"><?php echo $_LANG['menu']['Servers'] ?></a></li>
        <li class="<?php echo $storeToggle ?>"><a class="navbar-brand" href="<?php echo __siteurl ?>/?r=store/files"><?php echo $_LANG['menu']['Store'] ?></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="<?php echo $settingsToggle ?>"><a href="<?php echo __siteurl ?>/?r=settings/main"><?php echo $_LANG['menu']['Settings'] ?></a></li>
        <li><a href="<?php echo __siteurl ?>/?r=logout"><?php echo $_LANG['menu']['logout'] ?></a></li>
      </ul>
    </div>
  </div>
</nav>
<?php echo $notification ?>
