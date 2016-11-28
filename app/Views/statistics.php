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
                    <li class="list-group-item">
                    Running 4 minutes on Oct 25
                    <a href="" class="need-confirmation btn btn-danger btn-xs pull-right">X</a>
                    <div class="clearfix"></div>
                    </li>
                    <li class="list-group-item">
                    Running 10 minutes on Oct 23
                    <a href="" class="need-confirmation btn btn-danger btn-xs pull-right">X</a>
                    <div class="clearfix"></div>
                    </li>
                    <li class="list-group-item">
                    Cycling 40 minutes on Oct 12
                    <a href="" class="need-confirmation btn btn-danger btn-xs pull-right">X</a>
                    <div class="clearfix"></div>
                    </li>
                    <li class="list-group-item">
                    Sit Up 2 minutes on Oct 31
                    <a href="" class="need-confirmation btn btn-danger btn-xs pull-right">X</a>
                    <div class="clearfix"></div>
                    </li>
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
                data: [{
                    day: '2016-11-01',
                    burned: 20
                }, {
                    day: '2016-11-02',
                    burned: 10
                }, {
                    day: '2016-11-03',
                    burned: 5
                }, {
                    day: '2016-11-04',
                    burned: 2
                }, {
                    day: '2016-11-05',
                    burned: 2
                }, {
                    day: '2016-11-06',
                    burned: 2
                }, {
                    day: '2016-11-07',
                    burned: 2
                }, {
                    day: '2016-11-08',
                    burned: 20
                }],
                xkey: 'day',
                ykeys: ['burned'],
                labels: ['Burned Calories']
            });
        });
    </script>
</body>

</html>