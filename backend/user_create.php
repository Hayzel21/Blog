<?php 
  
    include "dbconnect.php";

    
    $sql = "SELECT * FROM users";
    $stmt =$conn->prepare($sql);
    $stmt->execute();

    $users = $stmt->FetchAll();
    // var_dump ($users);

    if($_SERVER['REQUEST_METHOD'] == 'POST'){


        $name =$_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $profile_arr = $_FILES['profile'];

        // echo "$name and $email and $password";
        print_r ($profile_arr);

        
       

        if (isset($profile_arr) && $profile_arr['size'] >0) {
           $dir = 'images/';
           $photo = $dir.$profile['name'];
           $tmp_name = $profile ['tmp_name'];
           move_uploaded_file($tmp_name, $photo);

        };

        $sql = "INSERT INTO users (name,email,password,profile) VALUES (:name,:email,:password,:profile)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam (':name',$name);
        $stmt->bindParam (':email',$email);
        $stmt->bindParam (':password',$password);
        $stmt->bindParam (':profile',$photo);
        $stmt->execute();

        header ("location:user_create.php");

       


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

            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">

                   <label for="name" class="form-label">Name</label>
                   <input type="text" name="name" id="name" class="form-control">

                   
                   <label for="email" class="form-label my-3">Email</label>
                   <input type="email" name="email" id="email" class="form-control">

                   <label for="password" class="form-label my-3">Password</label>
                   <input type="password" name="password" id="password" class="form-control">

                   <label for="profile" class="form-label my-3">Profile</label>
                   <input type="file" name="profile" id="profile" class="form-control">

                   <button type="submit" class="btn btn-primary mt-5 mb-3 w-100">Submit</button>

            </form>
            </div>
            
        </div>


<?php 
    include "layouts/footer.php";
   
?>