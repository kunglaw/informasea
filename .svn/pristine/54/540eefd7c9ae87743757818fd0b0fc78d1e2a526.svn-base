<?php
/**
 * Created by PhpStorm.
 * User: a
 * Date: 05/06/2015
 * Time: 9:59
 */
?>


<form name="login" method="post" action="<?php echo base_url("remember_me/login_auth"); ?>">

    <fieldset><legend>Authentication</legend>

        <?php
        if($login_error)
        {
            echo '<div id="error_notification">The submitted login info is incorrect.</div>';
        }
        ?>
        <?php
        echo "<div class='error_msg'>";
        if (isset($error_message)) {
            echo $error_message;
        }
        echo validation_errors();
        echo "</div>";?>

        <label>Username</label><input id="name" type="text" name="username"><br />

        <label>Password</label><input type="password" name="password"><br />

        <label>&nbsp;</label><input type="checkbox" name="autologin" value="<?= $remember_me ?>">Remember Me<br />

        <label>&nbsp;</label><input id="submit" type="submit" name="submit" value="Login"><br />

    </fieldset>

</form>
