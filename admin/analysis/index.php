<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';

# Fetch Data ... 
$sql = "select analysis.*,department.department from analysis  join department on analysis.id_dep = department.id";
$op  = mysqli_query($con, $sql);

####################################################################################################

require '../layouts/header.php';
require '../layouts/nav.php';
require '../layouts/sidNav.php';
?>




<main>
    <div class="container-fluid">
    <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <?php

           
            displayMessages('Dashboard/Display analysis');

            ?>
        </ol>





        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                DataTable Example
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Price</th>
                                <th>Requirement</th>
                                <th>image</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <th>ID</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Price</th>
                                <th>Requirement</th>
                                <th>image</th>
                                <th>Action</th>


                            </tr>
                        </tfoot>

                        <tbody>

                            <?php

                            while ($data = mysqli_fetch_assoc($op)) {

                            ?>
                                <tr>
                                    <td><?php echo $data['id']; ?></td>
                                    <td><?php echo $data['name']; ?></td>
                                    <td> <?php echo $data['department']; ?> </td>
                                    <td> <?php echo $data['price']; ?> </td>
                                    <td><p><?php echo  substr($data['requirement'],0,50);?></p> </td>
                                    <td> <img src="./uploads/<?php echo $data['image']; ?>" height="50" width="50"> </td>

                                    <td>
                                        <a href='delete.php?id=<?php echo $data['id'];  ?>' class='btn btn-danger m-r-1em'>Delete</a>
                                        <a href='edit.php?id=<?php echo $data['id'];  ?>' class='btn btn-primary m-r-1em'>Edit</a>

                                    </td>

                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>


<?php

require '../layouts/footer.php';

?>