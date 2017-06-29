<?php ob_start();
    session_start();
    $_SESSION["selected_page"] = "create-admin";
    include_once("../functions.php");
    include_once ("meta-admin.php");
    include_once ("header-admin.php");
    include_once ("aside-admin.php");
    include_once ("footer-admin.php");

    if(!check_login()){

        header("Location: http://www.kathmanduelectronics.com/admin");
        ob_end_flush();
        exit();
    }
    if($_SESSION["username"] !== "root"){
        header("Location: admin-dashboard.php");
        ob_end_flush();
        exit();
    }
?>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <?php display_message(); ?>
<form action="../process/process-create-admin.php" method="POST">
    <h1>Enter admin details</h1>
    <p>
        <label for="host" class="flt_left">Host</label>
        <input id="host" class="admin-form-field" type="text" name="host" value=""/>
    </p>

    <p>
        <label for="username" class="flt_left">Username</label>
        <input id="username" class="admin-form-field" type="text" name="username" value=""/>
    </p>

    <p>
        <label for="pwd" class="flt_left">Password</label>
        <input id="pwd" class="admin-form-field" type="text" name="pwd" value=""/>
    </p>

    <p>
        <label for="full_name" class="flt_left">Full Name</label>
        <input id="full_name" class="admin-form-field" type="text" name="full_name" value=""/>
    </p>

    <p>
        <label for="phone" class="flt_left">Phone</label>
        <input id="phone" class="admin-form-field" type="text" name="phone" value=""/>
    </p>

    <p>
        <label for="email" class="flt_left">Email</label>
        <input id="email" class="admin-form-field" type="text" name="email" value=""/>
    </p>

    <p>
        <label for="address" class="flt_left">Address</label>
        <input id="address" class="admin-form-field" type="text" name="address" value=""/>
    </p>

    <p>
        <label for="gender" class="flt_left">Gender</label>
        <input id="gender" class="admin-form-field" type="text" name="gender" value=""/>
    </p>

    <p>
        <label for="dob" class="flt_left">Date of Birth</label>
        <input id="dob" class="admin-form-field" type="text" name="dob" value=""/>
    </p>
    <h2>Tables &amp; Privileges</h2>
    <p>
        <label>Submitted Phones</label>
        <input id="insert" type="checkbox" name="privilege[0][insert]" value="INSERT"/><label for="insert">INSERT</label>
        <input id="update" type="checkbox" name="privilege[0][update]" value="UPDATE"/><label for="update">UPDATE</label>
    </p>

    <p>
        <label>Submitted Tablets</label>
        <input id="insert" type="checkbox" name="privilege[1][insert]" value="INSERT"/><label for="insert">INSERT</label>
        <input id="update" type="checkbox" name="privilege[1][update]" value="UPDATE"/><label for="update">UPDATE</label>
    </p>

    <p>
        <label>Submitted Laptops</label>
        <input id="insert" type="checkbox" name="privilege[2][insert]" value="INSERT"/><label for="insert">INSERT</label>
        <input id="update" type="checkbox" name="privilege[2][update]" value="UPDATE"/><label for="update">UPDATE</label>
    </p>
    <p>
        <input disabled id="submit" type="submit" name="submit" value="Submit"/>
    </p>
</form>
<script>
    $(document).ready(function() {
        $(".admin-form-field").keyup(function () {
            var count = 0, attr = "disabled", $sub = $("#submit"), $inputs = $(".admin-form-field");
            $inputs.each(function () {
                count += ($.trim($(this).val())) ? 1 : 0;
            });
            (count >= $inputs.length ) ? $sub.removeAttr(attr) : $sub.attr(attr,attr);
        });
    });
</script>