<?php

    include "dbconnect.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){


        $id = $_POST ['id'];

        $sql = "DELETE FROM users WHERE id=:id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id',$id);

        $stmt->execute();

        header("location:users.php");


    }else{

        include "layouts/nav_sidebar.php";

    $sql = "SELECT * FROM users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $users = $stmt->FetchAll();
    // var_dump ($users);

?>
            
                <main>
                    <div class="container-fluid px-4 my-4">
                        <div class="card mb-4">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col col-10">User List</div>
                                    <div class="col col-2 pe-1">
                                        <a href="user_create.php" class="btn btn-primary">User Create</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Profile</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Profile</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                   
                                    <tbody>

                                        <?php 
                                        
                                            foreach ($users as $user) {
                                      
                                        ?>

                                        <tr>
                                            <td><?= $user['id']?></td>
                                            <td><?= $user['name']?></td>
                                            <td><?= $user['email']?></td>
                                            <td><?= $user['password']?></td>
                                            <td><?= $user['profile']?></td>
                                            <td>
                                                <a href="user_edit.php?id=<?= $user['id']?>" class="btn btn-warning" 
                                                >Edit</a>
                                          
                                                <button type="button" class="btn btn-danger delete" data-id = "<?= $user['id'] ?>" >
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


                <!--Delete Modal -->
                    <div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Deleting...</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h3>Are yopu sure delete?</h3>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                    <form action="" method="post">
                                            <input type="hidden" name="id" id="del_id">
                                        <button type="submit" class="btn btn-danger" >
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
