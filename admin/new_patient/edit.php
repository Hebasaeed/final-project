<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';


#############################################################################################

// Fetch details .... 
$id = $_GET['id'];
$sql = "select * from new_patient   where id = $id";
$op = mysqli_query($con, $sql);
$del = mysqli_fetch_assoc($op);

##############################################################################################
// Fetch Users ..... 
$sql = "select * from analysis ";
$type_op  = mysqli_query($con, $sql);



#############################################################################################


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // CODE ..... 
    $name     = Clean($_POST['name']);
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


    
    # Validate age ... 
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
        $errors['id_analysis'] = " id_analysis Required";
    } elseif (!validate($id_analysis, 4)) {
        $errors['id_analysis'] = "id_analysis Invalid";
    }

    

 


    # Check Errors 
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        

        
            $sql = "update  new_patient set  name = '$name'  , age = '$age' ,weight = '$weight' , phone = '$phone' , id_analysis = $id_analysis  where id = $id";
            $op  = mysqli_query($con, $sql);

            if ($op) {
                $message = ["Raw updated"];
                
            header("Location: index.php");
            exit();
            } else {
                $message = ["Error Try Again".mysqli_error($con)];
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

            displayMessages('Dashboard/Edit details');
            ?>



        </ol>



        <div class="container">


            <form action="edit.php?id=<?php echo  $del['id']; ?>" method="post" enctype="multipart/form-data">

            

                <div class="form-group">
                    <label for="exampleInputName">name</label>
                    <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="name" value="<?php echo $del['name'] ?>" placeholder="Enter name">
                </div>


                <div class="form-group">
                    <label for="exampleInputName">age</label>
                    <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="age" value="<?php echo $del['age'] ?>" placeholder="Enter age">
                </div>



                <div class="form-group">
                    <label for="exampleInputEmail">weight</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="weight" value="<?php echo $del['weight'] ?>" placeholder="Enter weight">
                </div>

                
                <div class="form-group">
                    <label for="exampleInputEmail">phone</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="phone" value="<?php echo $del['phone'] ?>" placeholder="Enter phone">
                </div>
                

                <div class="form-group">
                    <label for="exampleInputType">Analysis name</label>
                    <select class="form-control" name="id_analysis">

                        <?php
                        while ($Type_data = mysqli_fetch_assoc($type_op)) {
                        ?>

                            <option value="<?php echo $Type_data['id']; ?>"   <?php if ($Type_data['id']==$del['id_analysis'] ) {  echo 'selected';} ?>>
                                 <?php echo $Type_data['name']; ?>
                            </option>

                        <?php }  ?>

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