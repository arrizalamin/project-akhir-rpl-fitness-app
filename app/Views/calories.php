<!DOCTYPE html>
<html>
<?php require_once 'head.php' ?>

<body>
    <?php require_once 'navbar.php' ?>
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Burned Calories</h3>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div id="line-example" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/assets/js/raphael-min.js"></script>
    <script type="text/javascript" src="/assets/js/morris.min.js"></script>
    <script>
        $(document).ready(function() {
            Morris.Line({
                element: 'line-example',
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