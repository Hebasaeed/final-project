<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';

# Logic ....... 
#############################################################################################

// Fetch analysis & pat data .... 
$id = $_GET['id'];
$sql = "select * from analysis_patient where id = $id";
$op = mysqli_query($con, $sql);
$analysispatient = mysqli_fetch_assoc($op);

##############################################################################################
// Fetch users ..... 
$sql = "select * from new_patient";
$user_op  = mysqli_query($con, $sql);
#####################################
// Fetch analysis ..... 
$sql = "select * from analysis";
$ana_op  = mysqli_query($con, $sql);


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


            $sql = "update  analysis_patient set id_patient = $id_patient  , id_analysis =  $id_analysis ,receive = '$receive' where id = '$id";
            $op  = mysqli_query($con, $sql);

            if ($op) {
                $message = ["Raw updated"];
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

            displayMessages('Dashboard/Edit analysis & patient');
            ?>



        </ol>



        <div class="container">


            <form action="edit.php?id=<?php echo  $analysispatient['id']; ?>" method="post" enctype="multipart/form-data">



                <div class="form-group">
                    <label for="exampleInputPassword">analysis</label>
                    <select class="form-control" name="id_analysis">

                        <?php
                        while ($ana_data = mysqli_fetch_assoc($ana_op)) {
                        ?>

                            <option value="<?php echo $ana_data['id']; ?>" <?php if ($analysispatient['id_analysis'] == $ana_data['id']) {
                                                                                echo 'selected';
                                                                            } ?>><?php echo $ana_data['name']; ?></option>

                        <?php }  ?>

                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword">patient</label>
                    <select class="form-control" name="id_patient">

                        <?php
                        while ($user_data = mysqli_fetch_assoc($user_op)) {
                        ?>

                            <option value="<?php echo $user_data['id']; ?>" <?php if ($analysispatient['id_patient'] == $user_data['id']) { echo 'selected'; } ?>>
                            <?php echo $user_data['name']; ?>
                            </option>

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



                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>




    </div>
</main>


<?php

require '../layouts/footer.php';

?>