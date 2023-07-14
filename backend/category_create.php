<?php 
   
    include "dbconnect.php";

    $sql = "SELECT * FROM categories";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $categories = $stmt->FetchAll();
    // var_dump ($categories);

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $name = $_POST['name'];
        // echo $name;

        $sql = "INSERT INTO categories (name) VALUES (:name)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name',$name);
        $stmt->execute();

        header ("location:category_create.php");
    }else{

        include "layouts/nav_sidebar.php";

    }
?>

    <div class="card m-4">
        <div class="card-header">
            <div class="row">
                <div class="col col-11">Category Create</div>
                <div class="col col-1 btn btn-danger">Cancel</div>
            </div>
        </div>

        <div class="card-body">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">

            <label for="name" class="form-label ">Category Name</label>
            <input type="text" name="name" id="name" class="form-control">

            <button type="submit" class="btn btn-primary w-100 mt-4 mb-2">Submit</button>
        </form>
        </div>

    </div>

<?php 
    include "layouts/footer.php";
?>