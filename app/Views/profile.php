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
                        <div class="row">
                            <div class="col-xs-12 ">
                                <table class="table table-user-information">
                                    <tbody>
                                        <tr>
                                            <td>username:</td>
                                            <td>johndoe</td>
                                        </tr>
                                        <tr>
                                            <td>total activities:</td>
                                            <td>17</td>
                                        </tr>
                                        <tr>
                                            <td>Total time spent:</td>
                                            <td>96 hours</td>
                                        </tr>

                                        <tr>
                                            <td>Total calories burned:</td>
                                            <td>243</td>
                                        </tr>

                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-sm-6 col-xs12">
                                        <a href="/bmi" class="btn btn-primary btn-block">BMI Calculator</a>
                                    </div>
                                    <div class="col-sm-6 col-xs12">
                                        <a href="/color_scheme" class="btn btn-primary btn-block">Change Color Scheme</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <span class="pull-right">
                            <a href="/profile/edit" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="need-confirmation btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                        </span>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>