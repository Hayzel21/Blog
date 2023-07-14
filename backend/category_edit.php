<?php 
   
    include "dbconnect.php";

    $id = $_GET ['id'];
    // echo $id;



    $sql = "SELECT * FROM categories WHERE categories.id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->execute();

    $category = $stmt->Fetch(PDO :: FETCH_ASSOC);
    // var_dump ($category);

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $id = $_POST['id'];
        $name = $_POST['name'];
        // echo $name;

        $sql = "UPDATE categories SET name=:name WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':name',$name);
        
        $stmt->execute();

        header ("location:categories.php");
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

            <input type="hidden" name="id" value="<?= $category['id']?>">

            <label for="name" class="form-label ">Category Name</label>
            <input type="text" name="name" id="name" class="form-control" value="<?= $category['name'] ?>">

            <button type="submit" class="btn btn-primary w-100 mt-4 mb-2">Submit</button>
        </form>
        </div>

    </div>

<?php 
    include "layouts/footer.php";
?>