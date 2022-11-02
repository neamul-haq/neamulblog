<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
$userid = Session::get('userId');
$userrole = Session::get('userRole');
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Change Password</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST['oldpassword']) || empty($_POST['newpassword'])) {
                echo "<span class='error'>Field Must Not Be Empty</span>";
            } else {
                $oldpassword = $fm->validation(md5($_POST['oldpassword']));
                $newpassword = $fm->validation(md5($_POST['newpassword']));
    
                $oldpassword = mysqli_real_escape_string($db->link, $oldpassword);
                $newpassword = mysqli_real_escape_string($db->link, $newpassword);
                $squery = "select * from tbl_user where id='$userid' and role='$userrole'";
                $getuser = $db->select($squery);
                if ($getuser) {
                    while ($result = $getuser->fetch_assoc()) {
                        if ($result['password'] != $oldpassword) {
                            echo "<span class='error'>Wrong Old Password</span>";
                        } else {
                            $query = "update tbl_user set password='$newpassword' where id='$userid' and role='$userrole'";
                            $updated_row = $db->update($query);
                            if ($updated_row) {
                                echo "<span class='success'>Password Updated Successfully.
                </span>";
                            } else {
                                echo "<span class='error'>Password Not Updated</span>";
                            }
                        }
                    }
                }
            }
        }
        ?>
        <div class="block">
            <form action="" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <label>Old Password</label>
                        </td>
                        <td>
                            <input type="password" name="oldpassword" placeholder="Enter Old Password..." name="title" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>New Password</label>
                        </td>
                        <td>
                            <input type="password" name="newpassword" placeholder="Enter New Password..." name="slogan" class="medium" />
                        </td>
                    </tr>


                    <tr>
                        <td>
                        </td>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>