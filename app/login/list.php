<?php
$page = "list";
include "./server/include/header.php";

$id = $_SESSION['id'];
$sqlActiveList = "SELECT * FROM list WHERE id='$id' AND isDone='No'";
$resultActiveList = mysqli_query($con, $sqlActiveList);

$sqlDoneList = "SELECT * FROM list WHERE id='$id' AND isDone='Yes' ORDER BY doneDate";
$resultDoneList = mysqli_query($con, $sqlDoneList);

// check GET add list done
if (empty($_GET) || isset($_GET["filter"])) {
    $addListDone = "";
} else if($_GET["addList"] == "done"){
    $addListDone = "<div class='alert alert-success alert-dismissable'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <i class='fa fa-check'></i>  Your Process Done.
        </div>";
}

// check filter active and done list
if(isset($_GET['addList']) || empty($_GET)) {
    $filterList = "<li class='active'><a href='./list.php'>Active List</a></li>
    <li><a href='./list.php?filter=done'>Done List</a></li>";                                    
} else if(isset($_GET["filter"]) && $_GET["filter"] == "done"){
    $filterList = "<li><a href='./list.php'>Active List</a></li>
    <li class='active'><a href='./list.php?filter=done'>Done List</a></li>";
} 

?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            List <small>รายการสิ่งที่ต้องทำ</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <?= $addListDone ?>
                        <ul class="nav nav-pills nav-justified">
                            <?= $filterList ?>
                        </ul>
                    </div>
                    <?php if(isset($_GET["filter"]) && $_GET["filter"] == "done"){
                        // Done List
                        echo "<div class='col-lg-12'>
                        <div class='col-md-6'>
                            <h2>Done List Table <small>ตารางรายการที่ทำเสร็จแล้ว</small></h2>
                        </div>

                        <!-- Table List -->
                    <table class='table table-hover'>
                        <!-- head table-->
                        <tr>
                            <th class='col-md-1 text-center row-table'>List NO.</th>
                            <th class='col-md-2 text-center row-table'>List Name</th>
                            <th class='col-md-4 text-center row-table'>List Description</th>
                            <th class='col-md-1 text-center row-table'>End Date</th>
                            <th class='col-md-1 text-center row-table'>Done Date</th>
                            <th class='col-md-1 text-center row-table'>Delete</th>
                        </tr>";

                    $doneList = 1;
                    while($rowDoneList = mysqli_fetch_array($resultDoneList)){
                        echo "<tr><td class='text-center row-table'>$doneList</td>
                            <td class='text-center row-table'>" . $rowDoneList["listName"];
                                if($rowDoneList['isImportant'] == 'Yes'){
                                    echo " <span class='label label-danger label-tooltip' data-toggle='tooltip' data-placement='top' title='Important'><i class='fa fa-exclamation-triangle'></i></span>";                                    
                                }
                            echo "</td>
                            <td class='row-table'>" . $rowDoneList["listDescription"] . "</td>
                            <td class='text-center row-table'>" . $rowDoneList["endDate"] . "</td>
                            <td class='text-center row-table'>" . $rowDoneList["doneDate"] . "</td>
                            <td class='text-center row-table'><a class='btn btn-danger' href='./server/lists/deleteList.php?listID=" . $rowDoneList['listID'] . 
                                "'><i class='fa fa-trash'></i> Delete</a></td></tr>";
                        $doneList++;
                    }
                        
                    echo "</table>
                    </div>";;
                    } else if (isset($_GET['addList']) || empty($_GET)){
                        // Active List
                        echo "<div class='col-lg-12'>
                        <div class='col-md-6'>
                            <h2>List Table <small>ตารางรายการสิ่งที่ต้องทำ</small></h2>
                        </div>
                        <div class='col-md-2 text-right'>
                            <h2><h4>Orderd By:</h4></h2>
                        </div>
                        <div class='col-md-4'>
                            <h2> 
                            <div class='text-right'>
                                <div class='btn-group' data-toggle='buttons'>
                                    <label class='btn btn-warning active'>
                                        <input type='radio' name='orderList' id='orderList' value='dateCreated' checked> Date Created
                                    </label>
                                    <label class='btn btn-warning'>
                                        <input type='radio' name='orderList' id='orderList' value='deadline'> Deadline
                                    </label>
                                    <label class='btn btn-warning'>
                                        <input type='radio' name='orderList' id='orderList' value='important'> Important
                                    </label>
                                </div>
                            </div>

                            </h2>
                        </div>
                    <div class='change-table'>
                    <!-- Table List -->
                    <table class='table table-hover'>
                        <!-- head table-->
                        <tr>
                            <th class='text-center row-table'>List NO.</th>
                            <th class='text-center row-table'>List Name</th>
                            <th class='text-center row-table'>List Description</th>
                            <th class='text-center row-table'>End Date</th>
                            <th class='text-center row-table'>End Time</th>";
                                // check package id for add column Project Name
                                if($row['packageID'] == 2){
                                    echo "<th class='text-center row-table'>Project Name</th>";
                                }
                            echo "<th class='text-center row-table'>Control</th>
                        </tr>";

                            $listNumber = 1;

                            while($rowActiveList = mysqli_fetch_array($resultActiveList)){

                                    //query project name
                                    $sqlProjectName = "SELECT * FROM project WHERE id='$id' AND projectID='" . $rowActiveList['projectID'] . "'";
                                    $ProjectNameResult = mysqli_query($con, $sqlProjectName);
                                    $rowProjectName = mysqli_fetch_array($ProjectNameResult);

                                    if($rowProjectName['projectName'] == ''){
                                        $projectNameShow = "-";
                                    } else {
                                        $projectNameShow = $rowProjectName['projectName'];
                                    }

                                    echo "<tr";

                                    if($rowActiveList['endDate'] == $dateNow){
                                        echo " class='danger'";
                                    } else if($rowActiveList['endDate'] == $dateTomorrow){
                                        echo " class='warning'";
                                    } else if(strtotime($rowActiveList['endDate']) < time()){
                                        echo " class='active'";
                                    }

                                    echo ">
                                        <td class='col-md-1 text-center row-table'> $listNumber </td>
                                        <td class='col-md-2 row-table'>" . $rowActiveList['listName']; 
                                        
                                        if($rowActiveList['isImportant'] == 'Yes'){
                                            echo " <span class='label label-danger label-tooltip' data-toggle='tooltip' data-placement='top' title='Important'><i class='fa fa-exclamation-triangle'></i></span>";
                                        }
                                    
                                    echo "</td>
                                        <td class='col-md-4 row-table'>" . $rowActiveList['listDescription'] . "</td>
                                        <td class='col-md-2 text-center row-table'>";
                                         if($rowActiveList['endDate'] == $dateNow){
                                            echo "Today";
                                        } else if($rowActiveList['endDate'] == $dateTomorrow){
                                            echo "Tomorrow";
                                        } else {
                                            echo $rowActiveList['endDate'];
                                        }
                                         echo "</td>";
                                    
                                    echo "<td class='col-md-1 row-table text-center'>";
                                        if ( ($rowActiveList['endTime'] < $timeNow) && ($rowActiveList['endDate'] <= $dateNow) ) {
                                            echo "Time Out";
                                        } else {
                                            echo $rowActiveList['endTime'];
                                        }
                                      
                                     echo "</td>";
                                    
                                    if($row['packageID'] == 2){
                                        echo "<td class='col-md-2 text-center row-table'>" . $projectNameShow . "</td>";
                                    }
                                                    
                                    echo "
                                        <td class='col-md-1 text-center row-table'>
                                            <div class='btn-group dropup'>
                                                <button class='btn btn-primary btn-sm dropdown-toggle' type='button' id='MenuList' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    Menu
                                                    <span class='caret'></span>
                                                </button>
                                                <ul class='dropdown-menu dropdown-menu-right' aria-labelledby='MenuList'>
                                                    <li><a href='#' class='modalEditList' data-editList='" . $rowActiveList['listID'] . "' data-toggle='modal' data-target='#editListModal'><i class='fa fa-edit'></i> Edit</a></li>
                                                    <li><a href='./server/lists/doneList.php?listID=" . $rowActiveList['listID'];
                                                    echo "'><i class='fa fa-check-square-o'></i> Done</a></li>
                                                    <li><a href='./server/lists/deleteList.php?listID=" . $rowActiveList['listID'];
                                                    echo "'><i class='fa fa-trash'></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>";
                                    $listNumber++;
                            } 
                    echo "</table>

                    </div><!-- ChangeTable -->

                    </div>";
                    }
                    ?>



                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php
include "./server/include/loopProject.php";
include "./server/include/footer.php";
?>
