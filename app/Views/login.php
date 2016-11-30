<!DOCTYPE html>
<html>
    <?php require_once 'head.php' ?>
<body>
    <div class="container">
        <?php if (isset($req['error'])) : ?>
            <div class="alert alert-danger text-center" role="alert">
                <?php echo $req['error'] ?>
            </div>
        <?php endif ?>
        <form method="post" class="absolute-center col-sm-12 col-md-4 well">
            <div class="form-group">
                <label for="exampleInputEmail1">username</label>
                <input type="username" name="username" class="form-control" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
            <a href="/register" class="btn-block btn-transparent text-center">Register</a>
        </form>
    </div>
</body>
</html>