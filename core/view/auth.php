<?php echo $header ?>
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <h1>Authorize!</h1>
            <form method="post">
            <input type="hidden" name="action" value="auth">
            <p><label for="login">Login</label><br><input type="text" id="login" name="login" class="form-control"></p>
            <p><label for="password">Password</label><br><input type="password" id="password" name="password" class="form-control"></p>
            <p class="pull-right"><input type="submit" value="Authorize" class="btn btn-default"></p>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
<?php echo $footer ?>