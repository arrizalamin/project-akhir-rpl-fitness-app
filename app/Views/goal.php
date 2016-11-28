<!DOCTYPE html>
<html>
<?php require_once 'head.php' ?>
<body>
    <?php require_once 'navbar.php' ?>
    <div class="container">
        <div class="col-sm-12 col-md-6 col-md-offset-3 well">
            <ul class="list-group">
                <li class="list-group-item">Complete 5 fitness</li>
                <li class="list-group-item">Track 20 minutes fitness</li>
                <li class="list-group-item">Burn 200 calories in single activity</li>
            </ul>
            <hr />
            <div class="form-group">
                <select class="form-control">
                    <option>Complete ... fitnesses</option>
                    <option>Track ... minutes fitness</option>
                    <option>Burn ... calories in single activity</option>
                </select>
            </div>
            <div class="form-group">
                <input type="int" class="form-control" placeholder="Total">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Add Goal</button>
        </div>
    </div>
</body>

</html>