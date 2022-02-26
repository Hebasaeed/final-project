<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';

# Fetch Data ... 
$sql = "select analysis_patient.*, analysis.name as analysisname, new_patient.name as patientname , analysis_patient.receive from analysis_patient  join  analysis on analysis_patient.id_patient=analysis.id
join new_patient on  analysis_patient.id_patient =  new_patient.id ";
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
                                <th>Name patient</th>
                                <th>Name analysis</th>
                                <th>recieve</th>
                                
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                 <th>ID</th>
                                <th>Name patient</th>
                                <th>Name analysis</th>
                                <th>recieve</th>
                                <th>Action</th>

                            </tr>
                        </tfoot>

                        <tbody>

                        <?php

while ($data = mysqli_fetch_assoc($op)) {

?>
    <tr>
        <td><?php echo $data['id']; ?></td>
        <td><?php echo $data['patientname']; ?></td>
        <td> <?php echo $data['analysisname']; ?> </td>
        <td> <?php echo $data['receive']; ?> </td>
        


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