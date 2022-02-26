<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';

require '../helpers/checkLogin.php';



#############################################################################################

// Fetch User data .... 
$id = $_GET['id'];
$sql = "select * from users where id = $id";
$op = mysqli_query($con, $sql);
$UserData = mysqli_fetch_assoc($op);

##############################################################################################
// Fetch Usertypes ..... 
$sql = "select * from usertypes ";
$type_op  = mysqli_query($con, $sql);
#######################################




#############################################################################################


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // CODE ..... 

    $name     = Clean($_POST['name']);
    $email    = Clean($_POST['email']);
   // $password = Clean($_POST['password'],1);
    $id_usertypes  = Clean($_POST['id_usertypes']);

    # Validate Input ... 

    $errors = [];
    # Validate Name ... 
    if (!validate($name, 1)) {
        $errors['Name'] = " Name Required";
    }


    # Validate Email .... 
    if (!validate($email, 1)) {
        $errors['Email'] = " Email Required";
    } elseif (!validate($email, 2)) {
        $errors['Email'] = " Email Invalid Field";
    }


    # Validate id_usertypes  ... 
    if (!validate($id_usertypes, 1)) {
        $errors['Types'] = " usertypes Required";
    } elseif (!validate($id_usertypes, 4)) {
        $errors['Types'] = " usertypes Invalid";
    }
    

    // # Validate Password 
    // if (!validate($password, 1)) {
    //     $errors['Password'] = " Password Required";
    // } elseif (!validate($password, 3)) {
    //     $errors['Password'] = " Password Length Must be >= 6 Chars";
    // }



    # Check Errors 
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        

        $sql = "update users  set name =  '$name' , email = '$email' , id_usertypes = $id_usertypes   where id = $id";
        $op = mysqli_query($con, $sql);

        if ($op) {// if true
            $message = ["Raw Updated"];
            $_SESSION['Message'] = $message;

            header("Location: index.php");
            exit();
        } else {
            $message = ["Error Try Again.................".mysqli_error($con)];
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

            displayMessages('Dashboard/Edit usertypes');
            ?>



        </ol>



        <div class="container">


            <form action="edit.php?id=<?php echo  $UserData['id']; ?>" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="exampleInputName">user Name</label>
                    <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="name" value="<?php echo $UserData['name'] ?>" placeholder="Enter Name">
                </div>



                <div class="form-group">
                    <label for="exampleInputEmail">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?php echo $UserData['email'] ?>" placeholder="Enter email">
                </div>

                <!-- <div class="form-group">
                    <label for="exampleInputPassword">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
                </div> -->




                <div class="form-group">
                    <label for="exampleInputType">User Type</label>
                    <select class="form-control" name="id_usertypes">

                        <?php
                        while ($Type_data = mysqli_fetch_assoc($type_op)) {
                        ?>

                            <option value="<?php echo $Type_data['id']; ?>"   <?php if ($UserData['id_usertypes'] == $Type_data['id']) {  echo 'selected';} ?>>
                                 <?php echo $Type_data['title']; ?>
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