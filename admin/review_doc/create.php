<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';

# Logic ....... 
#############################################################################################
$sql = "select * from users";
$typesOp  = mysqli_query($con, $sql);
####################################
$sql = "select * from analysis";
$anaOp  = mysqli_query($con, $sql);

#############################################################################################

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // CODE ..... 

    
    $review    = Clean($_POST['review']);
    $id_analysis  = Clean($_POST['id_analysis']);
    $id_doc = Clean($_POST['id_doc']);


    # Validate Input ... 

    $errors = [];
    # Validate review ... 
    if (!validate($review, 1)) {
        $errors['review'] = " review Required";
    }


    # Validate id_analysis .... 
    if (!validate($id_analysis, 1)) {
        $errors['id_analysis'] = " id_analysis Required";
    } elseif (!validate($id_analysis, 4)) {
        $errors['id_analysis'] = " id_analysis Invalid Field";
    }

     # Validate id_doc .... 
     if (!validate($id_doc, 1)) {
        $errors['id_doc'] = " id_doc Required";
    } elseif (!validate($id_doc, 4)) {
        $errors['id_doc'] = " id_doc Invalid Field";
    }



    

 


    # Check Errors 
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        

            $sql = "insert into review_doc (id_doc,id_analysis,review) values ($id_doc , $id_analysis ,'$review')";
            $op  = mysqli_query($con, $sql);

            if ($op) {
                $message = ["Raw Inserted"];
            } else {
                $message = ["Error Try Again .".mysqli_error($con)];
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

            displayMessages('Dashboard/Add review');

            ?>



        </ol>



        <div class="container">


            <form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

               
            <div class="form-group">
                    <label for="exampleInputPassword">doctor name</label>
                    <select class="form-control" name="id_doc">

                        <?php
                        while ($type_data = mysqli_fetch_assoc($typesOp)) {
                        ?>

                            <option value="<?php echo $type_data['id']; ?>">   <?php echo $type_data['name'];?>    </option>

                        <?php }  ?>

                    </select>
                </div>


                <div class="form-group">
                    <label for="exampleInputPassword">analysis name</label>
                    <select class="form-control" name="id_analysis">

                        <?php
                        while ($ana_data = mysqli_fetch_assoc($anaOp)) {
                        ?>

                            <option value="<?php echo $ana_data['id']; ?>">   <?php echo $ana_data['name'];?>    </option>

                        <?php }  ?>

                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword"> review</label>
                    
                    <select class="form-control" name="review">
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