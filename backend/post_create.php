<?php 
    include "layouts/nav_sidebar.php";
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

                           
                       

                            <form action="" method="post" class="m-2">

                                    <label for="name" class="form-label">Title</label>
                                    <input type="text" name="title" id="title" class="form-control">

                                    <div class="my-3">
                                        <label for="file" class="form-label">Photo</label>
                                        <input type="file" name="file" id="file" class="form-control">
                                    </div>

                                    <label for="" class="form-label "> Category</label>
                                    <br>

                                    <select name="category" id="category" class="form-select">
                                            <option value="">Select Category</option>
                                    </select>

                                    <label for="desc" class="form-label mt-2">Description</label>
                                    <textarea name="desc" id="desc" class="w-100"></textarea>
                                    

                            </form>

                        <div class="btn btn-primary m-2">Submit</div>
                    </div>
                </main>

<?php 

    include "layouts/footer.php";

?>