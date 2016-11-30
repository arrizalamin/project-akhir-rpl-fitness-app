<!DOCTYPE html>
<html>
<?php require_once 'head.php' ?>

<body>
    <?php require_once 'navbar.php' ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad">

                <form method="post" class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $profile->username ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">username</label>
                            <input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo $profile->username ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <span class="pull-right">
                            <a href="/profile" data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                            <button data-original-title="Edit this user" data-toggle="tooltip" type="submit" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-check"></i></button>
                        </span>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>