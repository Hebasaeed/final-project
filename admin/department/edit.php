<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';

# Logic ....... 
#############################################################################################

// Fetch data .... 
$id = $_GET['id']; 

$sql = "select * from department where id = $id"; 
$op  = mysqli_query($con,$sql);
$typeData = mysqli_fetch_assoc($op);

#############################################################################################


 if($_SERVER['REQUEST_METHOD'] == "POST"){
 
    // CODE ..... 
    $department = Clean($_POST['department']);

    # Validate Input ... 
    
    $errors = [];

    if(!validate($department,1)){
        $errors['department'] = " department Required"; 
    }

   # Check Errors 
   if(count($errors) > 0 ){
    $_SESSION['Message'] = $errors;
   }else{


    # logic .... 

    $sql = "update department set department =  '$department' where id = $id"; 
    $op  = mysqli_query($con,$sql); 

    if($op){
        $message = ["Raw Updated"];
        $_SESSION['Message'] = $message;

        header("Location: index.php");
        exit();


    }else{
        $message = ["Error Try Again"];
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
              
               displayMessages('Dashboard/Edit department');
            ?>



        </ol>



        <div class="container">


            <form action="edit.php?id=<?php echo  $typeData['id']; ?>" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="exampleInputName">Department</label>
                    <input type="text" class="form-control"  id="exampleInputName" aria-describedby="" name="department" value = "<?php echo $typeData['department'];?>" placeholder="Enter department">
                </div>


                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>




    </div>
</main>


<?php

require '../layouts/footer.php';

?>