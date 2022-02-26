<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';

# Logic ....... 
#############################################################################################
$sql = "select * from analysis";
$anaOp  = mysqli_query($con, $sql);
#######################################
$sql = "select * from new_patient";
$userOp  = mysqli_query($con, $sql);
######################################
$sql = "select * from usertypes";
$typeOp  = mysqli_query($con, $sql);

#############################################################################################


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // CODE ..... 

    
    $id_analysis  = Clean($_POST['id_analysis']);
    $id_patient   = Clean($_POST['id_patient']);
    $receive      = Clean($_POST['receive']);
    

    # Validate Input ... 

    $errors = [];
    # Validate id_analysis ... 
    if (!validate($id_analysis, 1)) {
        $errors['id_analysis'] = " id_analysis Required";
    } elseif (!validate($id_analysis, 4)) {
        $errors['id_analysis'] = " id_analysis Invalid Field";
    }


    # Validate id_patient .... 
    if (!validate($id_patient, 1)) {
        $errors['id_patient'] = " id_patient Required";
    } elseif (!validate($id_patient, 4)) {
        $errors['id_patient'] = " id_patient Invalid Field";
    }

    # Validate receive 
    if (!validate($receive, 1)) {
        $errors['receive'] = " receive Required";

    }
    



 


    # Check Errors 
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        # logic .... 


            $sql = "insert into analysis_patient (id_patient, id_analysis ,receive) values ($id_patient , $id_analysis ,'$receive')";
            $op  = mysqli_query($con, $sql);

            if ($op) {
                $message = ["Raw Inserted"];
            } else {
                $message = ["Error Try Again. ".mysqli_error($con)];
            }

            $_SESSION['Message'] = $message;
        }
    }




#############################################################################################

require '../layouts/header.php';
require '../layouts/nav.php';
require '../layouts/sidNav.php';
?>




<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">



            <?php

            displayMessages('Dashboard/Analysis & patient');

            ?>



        </ol>



        <div class="container">


            <form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

            

                <div class="form-group">
                    <label for="exampleInputPassword"> name analysis</label>
                    <select class="form-control" name="id_analysis">

                        <?php
                        while ($ana_data = mysqli_fetch_assoc($anaOp)) {
                        ?>

                            <option value="<?php echo $ana_data['id']; ?>"><?php echo $ana_data['name']; ?></option>

                        <?php }  ?>

                    </select>
                </div>


                <div class="form-group">
                    <label for="exampleInputPassword"> name patient</label>
                    <select class="form-control" name="id_patient">

                        <?php
                        while ($user_data = mysqli_fetch_assoc($userOp)) {
                        ?>

                            <option value="<?php echo $user_data['id']; ?>"><?php echo $user_data['name']; ?></option>

                        <?php }  ?>

                    </select>
                </div>

                
                <div class="form-group">
                    <label for="exampleInputPassword"> receive</label>
                    
                    <select class="form-control" name="receive">
                        <option>true</option>
                        <option>false</option>
                    </select>
                </div>





        

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>




    </div>
</main>


<?php

require '../layouts/footer.php';

?>