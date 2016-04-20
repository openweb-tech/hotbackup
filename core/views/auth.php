<?php echo $header ?>
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <h1><?php echo $_LANG['auth']['Authorize'] ?></h1>
            <form method="post">
            <input type="hidden" name="action" value="auth">
            <fieldset class="form-group">
              <label for="login"><?php echo $_LANG['auth']['Login'] ?></label><br><input type="text" id="login" name="login" class="form-control">
            </fieldset>
            <fieldset class="form-group">
              <label for="password"><?php echo $_LANG['auth']['Password'] ?></label><br><input type="password" id="password" name="password" class="form-control">
            </fieldset>
            <fieldset class="form-group pull-right">
              <input type="submit" value="<?php echo $_LANG['auth']['submit'] ?>" class="btn btn-primary">
            </fieldset>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
<?php echo $footer ?>