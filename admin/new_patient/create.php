<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';

# Logic ....... 
// #############################################################################################
// $sql   = "select * from analysis_patient";
// $apOp  = mysqli_query($con, $sql);
// ####################################
$sql    = "select * from analysis";
$anaOp  = mysqli_query($con, $sql);

#############################################################################################

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // CODE ..... 

    $name     = Clean($_POST['name']);
    $password = Clean($_POST['password'], 1);
    $email    = Clean($_POST['email']);
    $age     = Clean($_POST['age']);
    $weight = Clean($_POST['weight']);
    $phone   = Clean($_POST['phone']);
    $id_analysis = Clean($_POST['id_analysis']);

    # Validate Input ... 

    $errors = [];
   
# Validate Name ... 
if (!validate($name, 1)) {
    $errors['Name'] = " Title Required";
} elseif (!validate($name, 8)) {
    $errors['name'] = " name Invalid Field";
}


    # Validate age

    if (!validate($age, 1)) {
        $errors['age'] = " age Required";
    }elseif (!validate($age, 9)) {
        $errors['age'] = " age invalid";
    }


    # Validate weight .... 
    if (!validate($weight, 1)) {
        $errors['weight'] = " weight Required";
    } elseif (!validate($weight, 9)) {
        $errors['weight'] = " weight Invalid Field";
    }

    # Validate phone 
    if (!validate($phone, 1)) {
        $errors['phone'] = " phone Required";
    } elseif (!validate($phone, 10)) {
        $errors['phone'] = " phone invalid";
    }


    # Validate id_analysis  ... 
    if (!validate($id_analysis, 1)) {
        $errors['id_analysis'] = " id_analysis Required ";
    } elseif (!validate($id_analysis, 4)) {
        $errors['id_analysis'] = "id_analysis Invalid";
    }

    

 

 


    # Check Errors 
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        

            $password = md5($password);

            $sql = "insert into new_patient (name , age , weight , phone , id_analysis) values ('$name' ,$age,'$weight', '$phone',  $id_analysis)";
            $op  = mysqli_query($con, $sql);

            if ($op) {
                $message = ["Raw Inserted"];
            } else {
                $message = ["Error Try Again"];
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

            displayMessages('Dashboard/Add patient');

            ?>



        </ol>



        <div class="container">


            <form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="name" placeholder="Enter Name">
                </div>



                <div class="form-group">
                    <label for="exampleInputName">age</label>
                    <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="age" placeholder="Enter age">
                </div>



                <div class="form-group">
                    <label for="exampleInputEmail">weight </label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="weight" placeholder="Enter weight">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword"> phone</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="phone" placeholder="phone">
                </div>




                <div class="form-group">
                    <label for="exampleInputPassword">Analysis</label>
                    <select class="form-control" name="id_analysis">

                        <?php
                        while ($ana_data = mysqli_fetch_assoc($anaOp)) {
                        ?>

                            <option value="<?php echo $ana_data['id']; ?>">   <?php echo $ana_data['name'];?>    </option>
                             
                        <?php }  ?>

                    </select>
                </div>


<!-- gggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg -->



<!-- ggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg -->
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>




    </div>
</main>


<?php

require '../layouts/footer.php';

?>