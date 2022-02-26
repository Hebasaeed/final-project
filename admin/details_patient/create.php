<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';

# Logic ....... 
#############################################################################################
$sql = "select * from users";
$typesOp  = mysqli_query($con, $sql);


#############################################################################################

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // CODE ..... 

    $age     = Clean($_POST['age']);
    $weight = Clean($_POST['weight']);
    $phone   = Clean($_POST['phone']);
    $id_patient = Clean($_POST['id_patient']);
    


    # Validate Input ... 

    $errors = [];
    # Validate age ... 
    if (!validate($age, 1)) {
        $errors['age'] = " age Required";
    }elseif (!validate($age, 10)) {
        $errors['age'] = " age invalid";
    }


    # Validate weight .... 
    if (!validate($weight, 1)) {
        $errors['weight'] = " weight Required";
    } elseif (!validate($weight, 10)) {
        $errors['weight'] = " weight Invalid Field";
    }

    # Validate phone 
    if (!validate($phone, 1)) {
        $errors['phone'] = " phone Required";
    } elseif (!validate($phone, 9)) {
        $errors['phone'] = " phone invalid";
    }


    # Validate id_patient  ... 
    if (!validate($id_patient, 1)) {
        $errors['id_patient'] = " id_patient Required : this is not patient";
    } elseif (!validate($id_patient, 4)) {
        $errors['id_patient'] = "id_patient Invalid";
    }

    

 


    # Check Errors 
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        

        
            $sql = "insert into details_patient (age,weight,phone,id_patient) values ('$age' , '$weight' ,'$phone',$id_patient)";
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

            displayMessages('Dashboard/Add User');

            ?>



        </ol>



        <div class="container">


            <form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

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
                    <label for="exampleInputPassword">patient name</label>
                    <select class="form-control" name="id_patient">

                        <?php
                        while ($type_data = mysqli_fetch_assoc($typesOp)) {
                        ?>

                            <option value="<?php echo $type_data['id']; ?>">   <?php echo $type_data['name'];?>    </option>

                        <?php }  ?>

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