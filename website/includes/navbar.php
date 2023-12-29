<?php

session_start();


if(isset($_POST['submit_logout'])){
    $_SESSION = [];
    session_destroy();
    header("Location: login_admins.php");
    exit();
}

?>

<nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                     
                        <ul class="navbar-nav ml-auto">
 
                            <li class="nav-item">
                                <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">

                                    <button class="nav-link logout-btn" type="submit" name="submit_logout" value="submit_logout">
                                        <span class="no-icon">Log out</span>
                                    </button>
                                    
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

<style>
    .logout-btn{
        border-width: 0;
    }
</style>