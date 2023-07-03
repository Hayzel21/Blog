<?php

    include "layouts/nav_sidebar.php";
    include "dbconnect.php";

    $sql = "SELECT * from posts";

    $stmt = $conn->prepare($sql);

    $stmt->execute();

    $posts = $stmt->FetchAll();

    

?>

    
            
                <main>
                    <div class="container-fluid px-4 my-3">
                        <div class="card mb-4">
                            <div class="card-header">
                              <div class="row">

                              <div class="col col-10">Post Lists</div>
                              <div class = "col col-2 me-0">
                                <button class="btn btn-primary">Post Create</button>
                              </div>
                              </div>

                                
                            </div>
                            <div class="card-body">
                                <table  id="datatablesSimple" class="table ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Created By</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                            foreach($posts as $post){
                                        ?>

                                        <tr>
                                            <td><?= $post ["#"]?></td>
                                            <td><?= $post ["Title"]?></td>
                                            <td><?= $post ["Category"]?></td>
                                            <td><?= $post ["Created By"]?></td>
                                            <td>
                                            <button class="btn btn-warning">Edit</button> 
                                            <button class="btn btn-danger">Delete</button>
                                            
                                            </td>
                                        </tr>


                                        <?php 
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>


<?php

    include "layouts/footer.php";

?>





