<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';

# Logic ....... 
#############################################################################################

// Fetch analysis data .... 
$id = $_GET['id'];
$sql = "select * from analysis where id = $id";
$op = mysqli_query($con, $sql);
$analysisData = mysqli_fetch_assoc($op);

##############################################################################################
// Fetch dep ..... 
$sql = "select * from department";
$dep_op  = mysqli_query($con, $sql);


#############################################################################################


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // CODE ..... 

    $name     = Clean($_POST['name']);
    $id_dep = Clean($_POST['id_dep']);
    $price   = Clean($_POST['price']);
    $requirement = Clean($_POST['requirement']);


# Validate Input ... 

$errors = [];
# Validate Name ... 
if (!validate($name, 1)) {
    $errors['Name'] = " name Required";
}


# Validate id_dep .... 
if (!validate($id_dep, 1)) {
    $errors['id_dep'] = " id_dep Required";
} elseif (!validate($id_dep, 4)) {
     $errors['id_dep'] = " id_dep Invalid Field ";
 }

# Validate Price 
if (!validate($price, 1)) {
    $errors['price'] = " price Required";
} 

# Validate Requirement... 
if (!validate($requirement, 1)) {
    $errors['requirement'] = " requirement Required";

}
  # Validate Image
    if (Validate($_FILES['image']['name'], 1)) {
        $ImgTempPath = $_FILES['image']['tmp_name'];
        $ImgName = $_FILES['image']['name'];

        $extArray = explode('.', $ImgName);
        $ImageExtension = strtolower(end($extArray));

        if (!Validate($ImageExtension, 5)) {
            $errors['Image'] = 'Invalid Extension';
        } else {
            $FinalName = time() . rand() . '.' . $ImageExtension;
        }
    } 
    if (count($errors) > 0) {
                $Message = $errors;
            } else {
                // DB CODE .....
        
                if (Validate($_FILES['image']['name'], 1)) {
                    $disPath = './uploads/' . $FinalName;
        
                    if (!move_uploaded_file($ImgTempPath, $disPath)) {
                        $Message = ['Message' => 'Error  in uploading Image  Try Again '];
                    } else {
                        unlink('./uploads/' . $analysisData['image']);
                    }
                } else {
                    $FinalName = $analysisData['image'];
                }
        
                if (count($Message) == 0) {
                    $date = strtotime($date);
                    $sql = "update analysis set  name = '$name', id_dep =  $id_dep, price = '$price', requirement = '$requirement'image ='$FinalName' where id = $id";
        
                    $op = mysqli_query($con, $sql);
        
                    if ($op) {
                        $Message = ['Message' => 'Raw Updated'];
                    } else {
                        $Message = ['Message' => 'Error Try Again ' . mysqli_error($con)];
                    }
          }
                 # Set Session ......
               $_SESSION['Message'] = $Message;
                header('Location: index.php');
                exit();
            }
            $_SESSION['Message'] = $Message;
         }
        
    // # Check Errors 
    // if (count($errors) > 0) {
        
    //     $_SESSION['Message'] = $errors;
    // } else {
    //     # logic .... 


    //         $sql = "update analysis set  name = '$name', id_dep =  $id_dep, price = '$price', requirement = '$requirement'image ='$FinalName' where id = $id";
    //         $op  = mysqli_query($con, $sql);

    //         if ($op) {// if true
    //             $message = ["Raw Updated"];
    //             $_SESSION['Message'] = $message;
    
    //             header("Location: index.php");
    //             exit();
    //         } else {
    //             $message = ["Error Try Again.................".mysqli_error($con)];
    //             $_SESSION['Message'] = $message;
    //         }
    //     }
    // }
    


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

            displayMessages('Dashboard/Edit analysis');
            ?>



        </ol>



        <div class="container">


            <form action="edit.php?id=<?php echo  $analysisData['id']; ?>" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="name" value="<?php echo $analysisData['name'] ?>" placeholder="Enter Name">
                </div>



                <div class="form-group">
                    <label for="exampleInputEmail">Price</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="price" value="<?php echo $analysisData['price'] ?>" placeholder="Enter price">
                </div>

                
                <div class="form-group">
                    <label for="exampleInputEmail">Requirement</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="requirement" value="<?php echo $analysisData['requirement'] ?>" placeholder="Enter requirement">
                </div>

                




                <div class="form-group">
                    <label for="exampleInputPassword">department</label>
                    <select class="form-control" name="id_dep">

                        <?php
                        while ($dep_data = mysqli_fetch_assoc($dep_op)) {
                        ?>

                            <option value="<?php echo $dep_data['id']; ?>" <?php if ($analysisData['id_dep'] == $dep_data['id']) {
                                                                                echo 'selected';
                                                                            } ?>><?php echo $dep_data['department']; ?></option>

                        <?php }  ?>

                    </select>
                </div>




                <div class="form-group">
                        <label for="exampleInputName">Image</label>
                        <input type="file" name="image">
                    </div>

                    <img src="./uploads/<?php echo $analysisData['image']; ?>" alt="" height="50px" width="50px"> <br>



                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>




    </div>
</main>


<?php

require '../layouts/footer.php';

?>