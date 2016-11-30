<!DOCTYPE html>
<html>
<?php require_once 'head.php' ?>
<body>
    <?php require_once 'navbar.php' ?>
    <div class="container">
        <div class="col-sm-12 col-md-6 col-md-offset-3 well">
            <ul class="list-group">
                <?php foreach ($goals as $goal) : ?>
                    <li class="list-group-item"><?php echo $goal ?></li>
                <?php endforeach ?>
            </ul>
            <hr />
            <form method="post">
                <div class="form-group">
                    <select class="form-control" name="type" required>
                        <option value="complete">Complete ... fitnesses</option>
                        <option value="track">Track ... minutes fitness</option>
                        <option value="burn">Burn ... calories in single activity</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="number" name="total" class="form-control" placeholder="Total">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Add Goal</button>
            </form>
        </div>
    </div>
</body>

</html>