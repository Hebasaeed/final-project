<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';

# Logic ....... 
#############################################################################################
$sql = "select * from department";
$depOp  = mysqli_query($con, $sql);

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
        $errors['Name'] = " Title Required";
    
    }


    # Validate id_dep .... 
    if (!validate($id_dep, 1)) {
        $errors['id_dep'] = " id_dep Required";
    } elseif (!validate($id_dep, 4)) {
        $errors['id_dep'] = " id_dep Invalid Field";
    }

    # Validate Price 
    if (!validate($price, 1)) {
        $errors['price'] = " price Required";
    } 

    # Validate Requirement... 
    if (!validate($requirement, 1)) {
        $errors['requirement'] = " requirement Required";

    }
    
    


    #Validate Image ... 
    if (!validate($_FILES['image']['name'], 1)) {
        $errors['Image']  = "Image Required";
    } elseif (!validate($_FILES['image']['name'], 5)) {
        $errors['Image']  = "Image : Invalid Extension";
    }


 


    # Check Errors 
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        # logic .... 

        $image = uploadFile($_FILES);

        if (empty($image)) {
            $_SESSION['Message'] = ["Error In Uploading File Try Again"];
        } else {

            $sql = "insert into analysis (name, id_dep ,price,requirement,image) values ('$name' , $id_dep ,'$price','$requirement','$image')";
            $op  = mysqli_query($con, $sql);

            if ($op) {
                $message = ["Raw Inserted"];
            } else {
                $message = ["Error Try Again"];
            }

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

            displayMessages('Dashboard/Analysis');

            ?>



        </ol>



        <div class="container">


            <form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="name" placeholder="Enter Name">
                </div>



                <div class="form-group">
                    <label for="exampleInputEmail">Requirement</label>
                    <input type="text" class="form-control" id="exampleInputReq" name="requirement" placeholder="Requirement">
                    <!-- <textarea name="content" class="form-control" id="" cols="30" rows="10"></textarea> -->
                </div>

                <div class="form-group">
                    <label for="exampleInputPrice">price</label>
                    <input type="text" class="form-control" id="exampleInputPrice" name="price" placeholder="Price">
                </div>




                <div class="form-group">
                    <label for="exampleInputPassword"> department</label>
                    <select class="form-control" name="id_dep">

                        <?php
                        while ($Dep_data = mysqli_fetch_assoc($depOp)) {
                        ?>

                            <option value="<?php echo $Dep_data['id']; ?>"><?php echo $Dep_data['department']; ?></option>

                        <?php }  ?>

                    </select>
                </div>


                <div class="form-group">
                    <label for="exampleInputPassword">Image</label>
                    <input type="file" name="image">
                </div>




                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>




    </div>
</main>


<?php

require '../layouts/footer.php';

?>