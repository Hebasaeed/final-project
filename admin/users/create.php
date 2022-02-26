<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';

# Logic ....... 
#############################################################################################
$sql = "select * from usertypes";
$typesOp  = mysqli_query($con, $sql);
####################################
// $sql = "select * from department";
// $depOp  = mysqli_query($con, $sql);

#############################################################################################

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // CODE ..... 

    $name     = Clean($_POST['name']);
    $password = Clean($_POST['password'], 1);
    $email    = Clean($_POST['email']);
    $id_usertypes  = Clean($_POST['id_usertypes']);
    


    # Validate Input ... 

    $errors = [];
    # Validate Name ... 
    if (!validate($name, 1)) {
        $errors['Name'] = " name Required";
    }


    # Validate Email .... 
    if (!validate($email, 1)) {
        $errors['Email'] = " Email Required";
    } elseif (!validate($email, 2)) {
        $errors['Email'] = " Email Invalid Field";
    }

    # Validate Password 
    if (!validate($password, 1)) {
        $errors['Password'] = " Password Required";
    } elseif (!validate($password, 3)) {
        $errors['Password'] = " Password Length Must be >= 6 Chars";
    }


    # Validate id_usertypes  ... 
    if (!validate($id_usertypes, 1)) {
        $errors['usertypes'] = " usertypes Required";
    } elseif (!validate($id_usertypes, 4)) {
        $errors['uasertypes'] = "usertypes Invalid";
    }

    


 


    # Check Errors 
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        

            $password = md5($password);

            $sql = "insert into users (name,email,password,id_usertypes) values ('$name' , '$email' ,'$password',$id_usertypes)";
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
                    <label for="exampleInputName"> User Name</label>
                    <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="name" placeholder="Enter Name">
                </div>



                <div class="form-group">
                    <label for="exampleInputEmail">Email </label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter email">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword"> Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
                </div>




                <div class="form-group">
                    <label for="exampleInputPassword">User Type</label>
                    <select class="form-control" name="id_usertypes">

                        <?php
                        while ($type_data = mysqli_fetch_assoc($typesOp)) {
                        ?>

                            <option value="<?php echo $type_data['id']; ?>">   <?php echo $type_data['title'];?>    </option>

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