<?php

    
    include "dbconnect.php";


    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $id = $_POST['id'];
        // var_dump ($id);


        $sql = "DELETE FROM posts WHERE id = :id";
        $stmt =$conn->prepare($sql);
        $stmt->bindParam(':id',$id);

        $stmt->execute();
        
        header("location:posts.php");



    }else{

        include "layouts/nav_sidebar.php";

    
 
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
                                            <button type="button" class="btn btn-danger delete"   data-id="<?= $post['id'] ?>">
                                                Delete
                                            </button>
                                            
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

                <!-- Delete Model -->

                    <div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Deleting....</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                   <h3>Are you sure delete?</h3>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                    <form action="" method="post">

                                        <input type="hidden" name="id" id="del_id">
                                        
                                        <button type="submit" class="btn btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                    
                                </div>
                                </div>
                            </div>
                    </div>


<?php

    include "layouts/footer.php";
                                        }

?>





