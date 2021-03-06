<?php
$page = "setting";
include "./server/include/header.php";
$sql = "SELECT * from user WHERE id='$id'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
?>

        <div id="page-wrapper">

            <div class="container-fluid">


                <!-- Update Account Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Account Settings
                            <small>ตั้งค่าต่างๆข้อมูล Account</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                <?php
                    if (empty($_GET)) {
                        echo "";
                    } else if($_GET["stage"] == "done"){
                        echo "<div class='alert alert-success alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <i class='fa fa-check'></i>  ข้อมูลบัญชีได้ถูกบันทึกเรียบร้อยแล้ว
                            </div>";
                    } else if($_GET["stage"] == "currentPassWrong"){
                        echo "<div class='alert alert-danger alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <i class='fa fa-exclamation'></i>  Current Password Wrong!
                            </div>";
                    } else if($_GET["stage"] == "newPassNotMatch"){
                        echo "<div class='alert alert-danger alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <i class='fa fa-exclamation'></i>  New Password and Confim Password doesn't match!
                            </div>";
                    }

                ?>
                    <form action="./server/settings/updAccount.php" method="Post" enctype="multipart/form-data">
                    <div class="col-md-6">
                        <div class="text-center">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Picture Preview</h3>
                                </div>
                                <div class="panel-body">
                                    <?php
                                        if($row['picture'] == ''){
                                            echo("<img src='./../assets/images/profileAvatar.png' id='previewImg' height='150px' accept='image/gif, image/jpeg, image/png'>");
                                        } else {
                                            echo("<img src='./upload/images/" . $row['picture'] . "' id='previewImg' height='150px' accept='image/gif, image/jpeg, image/png'>");
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="text-center btn btn-default file-upload">
                                <span>Upload Picture</span>
                                <input type="file" name="Picture" onchange="previewFile()" class="upload"/>
                            </div>                           
                            
                        </div>
                    </div>
                    <div class="col-md-6">

                            <div class="form-group">
                                <label for="disabledSelect">Email:</label>
                                <input class="form-control" id="disabledInput" type="text" placeholder="<?=$row["email"]?>" disabled>
                            </div>

                            <div class="form-group">
                                <label>Firstname Lastname:</label>
                                <input class="form-control" name="FSName" value="<?=$row["name"]?>">
                                <p class="help-block">Example: Thanapat Sorralump</p>
                            </div>

                            <div class="form-group">
                                <label>Sex:</label>
                                <select class="form-control" name="Sex">
                                    <option <?php echo($row['sex'] == '-' ? 'selected' : ''); ?> >-</option>
                                    <option <?php echo($row['sex'] == 'Male' ? 'selected' : ''); ?>>Male</option>
                                    <option <?php echo($row['sex'] == 'Female' ? 'selected' : ''); ?>>Female</option>
                                </select>
                            </div>


                             <div class="form-group">
                                <label>Job:</label>
                                <input class="form-control" name="Job" value="<?=$row["job"]?>">
                                <p class="help-block">Example: Student, Teacher, Engineer etc.</p>
                            </div>                           

                            <div class="form-group">
                                <label>Birthdate:</label>
                                <input class="form-control" name='date' data-provide="datepicker" data-date-format="yyyy-mm-dd" value="<?=$row["birthdate"]?>">
                                <p class="help-block">Example: yyyy-mm-dd Format</p>
                            </div>


                    </div>
                    <div class="col-lg-12 text-center btn-update">
                        <button class="btn btn-primary btn-lg">Update Your Profile </button>
                    </div>
                    </form>
                </div>


                <!-- Update Password Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Password Setting
                            <small>เปลี่ยนแปลงรหัสผ่าน</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
                <div class="row">
                    <form action="./server/settings/changePassword.php" method="post">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Current Password:</label>
                                <input class="form-control" type="password" name="currentPassword">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>New Password:</label>
                                <input class="form-control" type="password" name="newPassword">
                            </div>                        
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Confirm New Password:</label>
                                <input class="form-control" type="password" name="confirmPassword">
                            </div>                        
                        </div>

                       <div class="col-lg-3 text-center">
                            <button class="btn btn-primary btn-lg btn-update">Update Password</button>
                        </div>
                    </form>
                    
                </div>
                <!-- row -->

                <!-- Delete Account -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Delete Account
                            <small>ลบบัญชี</small>
                        </h1>
                    </div>
                </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h4>Once you delete your account, there is no going back. Please be certain.</h4>
                            <form action="./server/settings/deleteAccount.php" id="formDeleteAccount" method="post">
                                <input type="button" class="btn btn-danger btn-lg btn-update" data-toggle="modal" data-target="#deleteModal" value="Delete Your Account">
                            </form>
                        </div>
                    </div>
                <!-- /.row -->


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

        <!-- Modal Delete Account -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete Account Confirm</h4>
            </div>
            <div class="modal-body">
                <p>Do you want to <strong>Delete</strong> Alist account?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="confirmDelete" class="btn btn-danger">Yes, Delete my account</button>
            </div>
            </div>
        </div>
        </div>


<?php
include "./server/include/loopProject.php";
include "./server/include/footer.php";
?>


