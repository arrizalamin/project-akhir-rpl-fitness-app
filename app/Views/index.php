<!DOCTYPE html>
<html>
<?php require_once 'head.php' ?>
<body>
<?php require_once 'navbar.php' ?>
<div class="container">
    <?php if (isset($req['error'])) : ?>
        <div class="alert alert-danger text-center" role="alert">
            <?php echo $req['error'] ?>
        </div>
    <?php endif ?>
</div>
<form method="post" action="/store" class="absolute-center form-tracking">
    <div class="form-group">
        <select name="type" class="form-control" required>
            <option value="">Select Activity</option>
            <option value="Running">Running</option>
            <option value="Cycling">Cycling</option>
            <option value="Walking">Walking</option>
        </select>
    </div>
    <input type="hidden" name="time" id="time" required>
    <button type="submit" id="btn-tracking" class="btn-tracking btn btn-default">
        Start
    </button>    
</form>

<script type="text/javascript" src="/assets/js/timer.js"></script>
<script>
    var started = false;
    var btnTracking = document.getElementById('btn-tracking');
    var timer = new Timer(btnTracking);
    btnTracking.addEventListener('click', function(e) {
        if (started) {
            var time = timer.stop('Start Again');
            document.getElementById('time').setAttribute('value', time);
            started = !started;
        } else {
            e.preventDefault();
            timer.start();
            started = !started;
        }
    });
</script>
</body>
</html>
