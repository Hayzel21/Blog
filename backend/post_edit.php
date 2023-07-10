<?php 
    
    include "dbconnect.php";

    $sql = "SELECT * FROM categories";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $categories = $stmt->fetchAll();

    $id = $_GET['id'];
    // echo "$id";
    // Not avaliable see because of navbar 

    $sql = "SELECT posts.*, categories.name as c_name, users.name as u_name FROM posts INNER JOIN categories ON posts.category_id = categories.id INNER JOIN users ON posts.user_id = users.id WHERE posts.id =:id";

    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam (':id',$id);
    $stmt->execute();

    $post = $stmt->Fetch(PDO::FETCH_ASSOC);



    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){



        $id =$_POST['id'];
        $title = $_POST['title'];
        $category_id = $_POST['category_id'];
        $user_id = 2;
        $desc =$_POST['desc'];

        
        $photo_arr = $_FILES['new_photo'];

        $old_photo = $_POST ['photo'];

        // echo "$title and $category_id and $user_id and $desc";

        // print_r ($photo_arr);


        if (isset($photo_arr) && $photo_arr ['size'] >0) {
            $dir = 'images/';
            $photo = $dir.$photo_arr['name'];

            $tmp_name = $photo_arr ['tmp_name'];
            move_uploaded_file($tmp_name , $photo);
        }else{

                $photo = $old_photo;

        }


        // $sql = "INSERT INTO posts (title,category_id,user_id,photo,description) VALUES (:title,:category,:user,:photo,:description)";

        $sql = "UPDATE posts SET title=:title,category_id=:category,user_id=:user,photo=:photo,description=:description WHERE id=:id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam (':id', $id);

        $stmt->bindParam(':title',$title);
        $stmt->bindParam(':category',$category_id);
        $stmt->bindParam(':user',$user_id);
        $stmt->bindParam(':photo',$photo);
        $stmt->bindParam(':description',$desc);


        $stmt->execute();

        header ("location:posts.php");
        exit;

    }else{

        include "layouts/nav_sidebar.php";
        
        // var_dump ($post);
    }



        


?>

<main>
                    <div class="container-fluid px-4 py-4">
                        <div class="card mb-4">
                            <div class="card-header">
                              <div class="row">

                                <div class="col col-11">Post Create</div>
                                <div class = "col col-1 ps-1  ">
                                    <button class="btn btn-danger">Cancel</button>
                              </div>  
                            </div>
                            </div>

                           
                       

                            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post"  enctype="multipart/form-data"    class="m-2">

                            <input type="hidden" name="id" value = "<?= $post['id'] ?>">

                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" value = "<?= $post['title'] ?>">

                                    <div class="my-3">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-photo-tab" data-bs-toggle="tab" data-bs-target="#nav-photo" type="button" role="tab" aria-controls="nav-photo" aria-selected="true">Photo</button>
                                            <button class="nav-link" id="nav-new_photo-tab" data-bs-toggle="tab" data-bs-target="#nav-new_photo" type="button" role="tab" aria-controls="nav-new_photo" aria-selected="false">New Photo</button>
                                        </div>
                                    </nav>
                                        <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-photo" role="tabpanel" aria-labelledby="nav-photo-tab" tabindex="0">
                                            <img src="<?= $post['photo'] ?>" alt="" class="img-fluid w-75 h-50 py-5">

                                            <input type="hidden" name="photo" value="<?= $post['photo'] ?>">
                                        </div>
                                        <div class="tab-pane fade" id="nav-new_photo" role="tabpanel" aria-labelledby="nav-new_photo-tab" tabindex="0">

                                            <input type="file" name="new_photo" id="photo" class="form-control my-5">
                                        </div>
                                        </div>


                                      
                                    </div>

                                    <label for="category_id" class="form-label "> Category</label>
                                    <br>

                                    <select name="category_id" id="category_id" class="form-select">
                                            <option value="">Select Category</option>

                                            <?php 
                                    
                                    foreach ($categories as $category) {
                                    
                                    
                                
                                ?>

                                <option value="<?= $category['id'] ?>"
                                <?php  if($category['id'] == $post['category_id']){
                                    echo "selected";
                                } ?>
                                ><?= $category['name'] ?>
                                </option>

                                <?php 
                                
                                    }
                                ?>
                                    </select>

                                  

                                    <label for="desc" class="form-label mt-2">Description</label>
                                    <textarea name="desc" id="desc" class="w-100">
                                        <?= $post['description'] ?>
                                    </textarea>


                                    <button class="btn btn-primary w-100" type="submit" >Update</button>
                                    

                            </form>

                        
                    </div>
                </main>

<?php 

    include "layouts/footer.php";

?>