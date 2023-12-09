<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('includes-regform/headassets.php') ?>

    <title>Repair/Fix Request</title>
</head>

<body>
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-body">
                    <form method="POST">

                    <div class="form-row">
                            <div class="name">Email:</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="email">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name">Password:</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="password">
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <button class="btn btn--radius-2 btn--red" type="submit">Log in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include('includes-regform/bodyassets.php') ?>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->