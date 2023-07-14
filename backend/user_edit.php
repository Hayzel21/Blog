<?php 
  
    include "dbconnect.php";

    $id = $_GET ['id'];
    // echo $id;

    $sql = "SELECT * FROM users  WHERE users.id =:id";

    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam (':id',$id);
    $stmt->execute();

    $user = $stmt->Fetch(PDO::FETCH_ASSOC);

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $id = $_POST['id'];
        $name =$_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $profile_arr = $_FILES['profile'];

        // echo "$name and $email and $password";
        // print_r ($profile_arr);

        if (isset($profile_arr) && $profile_arr['size'] >0) {
           $dir = 'images/';
           $photo = $dir.$profile['name'];
           $tmp_name = $profile ['tmp_name'];
           move_uploaded_file($tmp_name, $photo);

        };

        // $sql = "INSERT INTO users (name,email,password,profile) VALUES (:name,:email,:password,:profile)";

        $sql = "UPDATE users SET name=:name,email=:email,password=:password,profile=:profile WHERE id=:id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->bindParam (':name',$name);
        $stmt->bindParam (':email',$email);
        $stmt->bindParam (':password',$password);
        $stmt->bindParam (':profile',$photo);
        $stmt->execute();

        

        header ("location:users.php");

       


    }else{

        include "layouts/nav_sidebar.php";
       
    }

?>


        <div class="card m-3">
            <div class="card-header">
                <div class="row">
                    <div class="col col-11">User Create</div>
                    <div class="col col-1" >
                        <button class="btn btn-danger ">Cancel</button>
                    </div>
                </div>
            </div>


            <div class="card-body">

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">

           
            


                    <input type="hidden" name="id" value="<?= $user['id']?>">

                   <label for="name" class="form-label">Name</label>
                   <input type="text" name="name" id="name" class="form-control" value="<?= $user['name'] ?>">

                   
                   <label for="email" class="form-label my-3">Email</label>
                   <input type="email" name="email" id="email" class="form-control" value="<?= $user['email'] ?>">

                   <label for="password" class="form-label my-3">Password</label>
                   <input type="password" name="password" id="password" class="form-control" value="<?= $user['password'] ?>">

                   <nav class="my-3">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-photo-tab" data-bs-toggle="tab" data-bs-target="#nav-photo" type="button" role="tab" aria-controls="nav-photo" aria-selected="true">Photo</button>

                            <button class="nav-link" id="nav-new_photo-tab" data-bs-toggle="tab" data-bs-target="#nav-new_photo" type="button" role="tab" aria-controls="nav-new_photo" aria-selected="false">New Photo</button>

                            
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">

                        <div class="tab-pane fade show active" id="nav-photo" role="tabpanel" aria-labelledby="nav-photo-tab" tabindex="0">
                            <img src="<?= $users['profile'] ?>" alt="">
                        </div>

                        <div class="tab-pane fade" id="nav-new_photo" role="tabpanel" aria-labelledby="nav-new_photo-tab" tabindex="0">
                            <input type="file" name="profile" id="profile" class="form-control mt-3" value="<?=  $user['profile']?>">
                        </div>


                    </div>
                   

                   <button type="submit" class="btn btn-primary mt-5 mb-3 w-100">Update</button>

            </form>
            </div>
            
        </div>


<?php 
    include "layouts/footer.php";
   
?>