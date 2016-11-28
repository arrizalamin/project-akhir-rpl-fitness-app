<!DOCTYPE html>
<html>
<?php require_once 'head.php' ?>

<body>
    <?php require_once 'navbar.php' ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad">

                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Arrizal Amin</h3>
                    </div>
                    <div class="panel-body">
                        <form action="">
                            <div class="form-group">
                                <label for="exampleInputEmail1">username</label>
                                <input type="username" class="form-control" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" placeholder="Password">
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer">
                        <span class="pull-right">
                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                            <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-check"></i></a>
                        </span>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>