<!DOCTYPE html>
<html>
<?php require_once 'head.php' ?>

<body>
    <?php require_once 'navbar.php' ?>
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Time Spent</h3>
                </div>
            </div>
            <hr />
            <div class="row">
                <div id="bar-example"></div>
            </div>
            <hr />
            <div class="row">
                <h3>Activities</h3>
                <ul class="list-group">
                    <?php foreach ($activities as $activity) : ?>
                    <li class="list-group-item">
                    <?php printf(
                        '%s %d seconds and burned %s calories on %s',
                        $activity->type,
                        $activity->time,
                        $activity->calories,
                        date('M j Y', strtotime($activity->date))
                    ) ?>
                    <a href="/activity/delete?id=<?php echo $activity->id ?>" class="need-confirmation btn btn-danger btn-xs pull-right">X</a>
                    <div class="clearfix"></div>
                    </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/assets/js/raphael-min.js"></script>
    <script type="text/javascript" src="/assets/js/morris.min.js"></script>
    <script>
        $(document).ready(function() {
            Morris.Bar({
                element: 'bar-example',
                data: [
                    <?php foreach ($statistics as $day => $burned) : ?>
                    {
                        day: '<?php echo $day ?>',
                        burned: <?php echo $burned ?>,
                    },
                    <?php endforeach ?>
                ],
                xkey: 'day',
                ykeys: ['burned'],
                labels: ['Burned Calories']
            });
        });
    </script>
</body>

</html>