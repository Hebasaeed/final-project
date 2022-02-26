<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';


#############################################################################################

// Fetch data .... 
$id = $_GET['id'];
$sql = "select * from verified_chemist where id = $id";
$op = mysqli_query($con, $sql);
$UserData = mysqli_fetch_assoc($op);

##############################################################################################
// Fetch doc ..... 
$sql = "select * from users ";
$type_op  = mysqli_query($con, $sql);
#######################################
// Fetch analysis ..... 
$sql = "select * from analysis ";
$ana_op  = mysqli_query($con, $sql);



#############################################################################################


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // CODE ..... 

   
    $verified    = Clean($_POST['verified']);
    $id_analysis  = Clean($_POST['id_analysis']);
    $id_chemist = Clean($_POST['id_chemist']);


    # Validate Input ... 

    $errors = [];
    # Validate verified ... 
    if (!validate($verified, 1)) {
        $errors['verified'] = " verified Required";
    }


    # Validate id_analysis .... 
    if (!validate($id_analysis, 1)) {
        $errors['id_analysis'] = " id_analysis Required";
    } elseif (!validate($id_analysis, 4)) {
        $errors['id_analysis'] = " id_analysis Invalid Field";
    }

     # Validate id_chemist .... 
     if (!validate($id_chemist, 1)) {
        $errors['id_chemist'] = " id_chemist Required";
    } elseif (!validate($id_chemist, 4)) {
        $errors['id_chemist'] = " id_chemist Invalid Field";
    }



    # Check Errors 
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        

        $sql = "update verified_chemist  set id_chemist =  $id_chemist , id_analysis = $id_analysis, verified = '$verified'   where id = $id";
        $op = mysqli_query($con, $sql);

        if ($op) {// if true
            $message = ["Raw Updated"];
            $_SESSION['Message'] = $message;

            header("Location: index.php");
            exit();
        } else {
            $message = ["Error Try Again...".mysqli_error($con)];
            $_SESSION['Message'] = $message;
        }
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

            displayMessages('Dashboard/Edit verified');
            ?>



        </ol>



        <div class="container">


            <form action="edit.php?id=<?php echo  $UserData['id']; ?>" method="post" enctype="multipart/form-data">

                




                <div class="form-group">
                    <label for="exampleInputType">chemist name</label>
                    <select class="form-control" name="id_chemist">

                        <?php
                        while ($Type_data = mysqli_fetch_assoc($type_op)) {
                        ?>

                            <option value="<?php echo $Type_data['id']; ?>"   <?php if ($UserData['id_chemist'] == $Type_data['id']) {  echo 'selected';} ?>>
                                 <?php echo $Type_data['name']; ?>
                            </option>

                        <?php }  ?>

                    </select>
                </div>



                <div class="form-group">
                    <label for="exampleInputType">analysis</label>
                    <select class="form-control" name="id_analysis">

                        <?php
                        while ($ana_data = mysqli_fetch_assoc($ana_op)) {
                        ?>

                            <option value="<?php echo $ana_data['id']; ?>"   <?php if ($UserData['id_analysis'] == $ana_data['id']) {  echo 'selected';} ?>>
                                 <?php echo $ana_data['name']; ?>
                            </option>

                        <?php }  ?>

                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword"> verified</label>
                    
                    <select class="form-control" name="verified">
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