<div class="container">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo __siteurl ?>">Home</a>
      <a class="navbar-brand" href="<?php echo __siteurl ?>/?r=tasks/list">Tasks</a>
      <a class="navbar-brand" href="<?php echo __siteurl ?>/?r=users/list">Users</a>
      <a class="navbar-brand" href="<?php echo __siteurl ?>/?r=settings/main">Settings</a>
      <a class="navbar-brand" href="<?php echo __siteurl ?>/?r=settings/servers">Servers</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><?php echo $_SESSION['user']['login'] ?></a></li>
        <li><a href="<?php echo __siteurl ?>/?r=logout">Log out</a></li>
      </ul>
    </div>
  </div>
</nav>
</div>