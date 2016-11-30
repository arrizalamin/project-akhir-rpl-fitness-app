<!DOCTYPE html>
<html>
    <?php require_once 'head.php' ?>
<body>
    <?php require_once 'navbar.php' ?>
    <div class="container">
        <form method="post" class="absolute-center col-sm-12 col-md-4">
            <?php if (isset($req['result'])) : ?>
                <div class="alert alert-info" role="alert">
                    BMI : <?php echo $req['result'] ?>
                </div>
            <?php endif ?>
            <div class="well">
                <div class="form-group">
                    <label for="exampleInputEmail1">Height</label>
                    <input type="number" name="height" class="form-control" placeholder="Height">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Weight</label>
                    <input type="number" name="weight" class="form-control" placeholder="Weight">
                </div>
                <div class="form-group">
                    <select class="form-control">
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Calculate</button>
            </div>
        </form>
    </div>
</body>
</html>