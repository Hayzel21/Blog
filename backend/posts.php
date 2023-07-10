<?php

    include "layouts/nav_sidebar.php";
    include "dbconnect.php";
 
    $sql = "SELECT posts.*, categories.name as c_name, users.name as u_name FROM posts INNER JOIN categories ON posts.category_id = categories.id INNER JOIN users ON posts.user_id = users.id";


   

   

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
                                <a href="post_create.php"><button class="btn btn-primary">Post Create</button></a>
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

                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Created By</th>
                                        <th>Action</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                        <?php 
                                            foreach($posts as $post){
                                        ?>

                                        <tr>
                                            <td><?=$post ["id"] ?></td>
                                            <td><?= $post ["title"]?></td>
                                            <td><?= $post ["c_name"]?></td>
                                            <td><?= $post ["u_name"]?></td>
                                            <td>
                                            <a href="post_edit.php?id=<?= $post['id']  ?>" class="btn btn-warning">Edit</a> 
                                            <a href="" class="btn btn-danger">Delete</a>
                                            
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





