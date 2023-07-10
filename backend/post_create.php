<?php 
    
    include "dbconnect.php";

    $sql = "SELECT * FROM categories";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $categories = $stmt->fetchAll();


    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
   
        $title = $_POST['title'];
        $category_id = $_POST['category_id'];
        $user_id = 2;
        $desc =$_POST['desc'];

        
        $photo_arr = $_FILES['photo'];

        // echo "$title and $category_id and $user_id and $desc";

        // print_r ($photo_arr);


        if (isset($photo_arr) && $photo_arr ['size'] >0) {
            $dir = 'images/';
            $photo = $dir.$photo_arr['name'];

            $tmp_name = $photo_arr ['tmp_name'];
            move_uploaded_file($tmp_name , $photo);
        };


        $sql = "INSERT INTO posts (title,category_id,user_id,photo,description) VALUES (:title,:category,:user,:photo,:description)";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':title',$title);
        $stmt->bindParam(':category',$category_id);
        $stmt->bindParam(':user',$user_id);
        $stmt->bindParam(':photo',$photo);
        $stmt->bindParam(':description',$desc);


        $stmt->execute();

        header ("location:post_create.php");
        exit;

    }else{

        include "layouts/nav_sidebar.php";
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

                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" id="title" class="form-control">

                                    <div class="my-3">
                                        <label for="photo" class="form-label">Photo</label>
                                        <input type="file" name="photo" id="photo" class="form-control">
                                    </div>

                                    <label for="category_id" class="form-label "> Category</label>
                                    <br>

                                    <select name="category_id" id="category_id" class="form-select">
                                            <option value="">Select Category</option>

                                            <?php 
                                    
                                    foreach ($categories as $category) {
                                    
                                    
                                
                                ?>

                                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>

                                <?php 
                                
                                    }
                                ?>
                                    </select>

                                  

                                    <label for="desc" class="form-label mt-2">Description</label>
                                    <textarea name="desc" id="desc" class="w-100"></textarea>


                                    <button class="btn btn-primary w-100" type="submit" >Submit</button>
                                    

                            </form>

                        
                    </div>
                </main>

<?php 

    include "layouts/footer.php";

?>