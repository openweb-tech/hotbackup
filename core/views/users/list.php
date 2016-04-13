<?php echo $header ?>
<?php echo $topMenu ?>
<div class="container">
<h1><?php echo $_LANG['users']['Users list'] ?></h1>
<!-- actions menu -->
<div class="row">
  <div class="col-md-6"></div>
  <div class="col-md-6 align-right">
    <a href="<?php echo __siteurl ?>/?r=users/add" class="btn btn-primary"><?php echo $_LANG['users']['Add new'] ?></a>
  </div>
</div>
<!-- actions menu -->
<!-- users list -->
<div class="row">
  <div class="col-md-12">
    <table class="table">
      <thead>
       <tr>
         <th><?php echo $_LANG['users']['ID'] ?></th>
         <th><?php echo $_LANG['users']['Login'] ?></th>
         <th><?php echo $_LANG['users']['Email'] ?></th>
         <th><?php echo $_LANG['users']['Access group'] ?></th>
         <th><?php echo $_LANG['users']['Alerts'] ?></th>
         <th></th>
       </tr>
      </thead>
      <tbody>
      <?php 
      foreach($usersList as $key=>$user)
        {
        ?>
        <tr>
          <td><?php echo $user['id'] ?></td>
          <td><a href="<?php echo __siteurl ?>/?r=users/edit&id=<?php echo $user['id'] ?>"><?php echo $user['login'] ?></a></td>
          <td><?php echo $user['email'] ?></td>
          <td><?php echo $user['accessGroup'] ?></td>
          <td><?php echo $user['alerts'] ?></td>
          <td class="align-right">
            <form method="post">
              <input type="hidden" name="action" value="users/delete">
              <input type="hidden" name="id" value="<?php echo $user['id']  ?>">
              <input type="submit" class="btn btn-xs btn-danger" value="<?php echo $_LANG['actions']['Delete'] ?>" onclick="return confirm('<?php echo $_LANG['users']['delete confirmation'] ?>') ? true : false;">
            </form>
          </td>
        </tr>
        <?php
        }      
      ?>
      </tbody>
    </table>
  </div>
</div>
<!-- users list -->
</div>
<?php echo $footer ?>