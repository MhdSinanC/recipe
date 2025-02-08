<!-- Author: Lakshmi-->

<?php
include("../config/db_con.php");


$recipe_id = isset($_GET['id']) ? $_GET['id'] : '';
$recipe = null;

if ($recipe_id) {
    $query = "SELECT * FROM recipes WHERE recipe_id = ?";
    $stmt = mysqli_prepare($dbconnection, $query);
    mysqli_stmt_bind_param($stmt, 'i', $recipe_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $recipe = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Ai2Gi Admin is super flexible, powerful, clean & modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords"
        content="admin template, Ai2Gi Admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="Ai2Gi">
    <title>Edit Art</title>
    <link rel="apple-touch-icon" href="../app-assets/images/ico/logo.png">
    <link rel="shortcut icon" type="image/x-icon" href="../app-assets/images/ico/logo.png">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function validateUpdateForm() {
            var name = document.getElementById('name').value;
            document.getElementById('form_cuisine_edit').addEventListener('submit', function (event) {
                event.preventDefault(); // Prevent the default form submission
                Swal.fire({
                    title: 'Are you sure on Updating ' + name,
                    text: "Update Art Data!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Update!',
                    confirmButtonClass: 'btn btn-warning',
                    cancelButtonClass: 'btn btn-danger ml-1',
                    buttonsStyling: false,
                }).then(function (result) {
                    if (result.value) {
                        document.getElementById('form_cuisine_edit').submit(); // Submit the form using JavaScript
                    }
                    else {
                        return false;

                    }
                })
            });
        }

    </script>
</head>

<body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Header-->
    <?php include 'includes/header.php'; ?>
    <!-- END: Header-->

    <!-- BEGIN: Menu-->
    <?php include 'includes/menu.php'; ?>
    <!-- END: Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <section id="horizontal-form-layouts">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 style="margin-bottom:-20px">Edit Cuisine</h2>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collpase show">
                                    <div class="card-body">
                                        <?php
                                        include 'includes/message.php';
                                        ?>

                                        <form id="form_cuisine_edit" class="form form-horizontal"
                                            action="controllers/cuisine.php" method="post"
                                            enctype="multipart/form-data">
                                            <div class="form-body">
                                                <h4 class="form-section"></h4>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="title">Recipe
                                                                Title *</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" id="title" name="title"
                                                                    class="form-control border-primary"
                                                                    value="<?php echo isset($recipe['title']) ? $recipe['title'] : ''; ?>"
                                                                    required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control"
                                                                for="category_id">Category *</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <select class="select2-theme form-control"
                                                                    id="category_id" name="category_id" required>
                                                                    <option value="">-- Select Category --</option>
                                                                    <?php
                                                                    // Query to fetch categories
                                                                    $category_query = "SELECT category_id, name FROM categories";
                                                                    $category_result = mysqli_query($dbconnection, $category_query);

                                                                    // Populate categories
                                                                    while ($category_row = mysqli_fetch_assoc($category_result)) {
                                                                        $selected = ($category_row['category_id'] == $recipe['category_id']) ? 'selected' : '';
                                                                        echo '<option value="' . $category_row['category_id'] . '" ' . $selected . '>' . $category_row['name'] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control"
                                                                for="description">Description *</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <textarea id="description" name="description"
                                                                    class="form-control border-primary"
                                                                    required><?php echo isset($recipe['description']) ? $recipe['description'] : ''; ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control"
                                                                for="ingredients">Ingredients *</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <textarea id="ingredients" name="ingredients"
                                                                    class="form-control border-primary"
                                                                    required><?php echo isset($recipe['ingredients']) ? $recipe['ingredients'] : ''; ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="steps">Steps
                                                                *</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <textarea id="steps" name="steps"
                                                                    class="form-control border-primary"
                                                                    required><?php echo isset($recipe['steps']) ? $recipe['steps'] : ''; ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control"
                                                                for="calories">Calories</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="number" id="calories" name="calories"
                                                                    class="form-control border-primary"
                                                                    value="<?php echo isset($recipe['calories']) ? $recipe['calories'] : ''; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="image">Image
                                                                *</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="file" id="image" name="image"
                                                                    class="form-control border-primary">
                                                                <input type="hidden" name="existing_image"
                                                                    value="<?php echo isset($recipe['image']) ? $recipe['image'] : ''; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="status">Status
                                                                *</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <select id="status" name="status"
                                                                    class="form-control border-primary">
                                                                    <option value="active" <?php echo isset($recipe['status']) && $recipe['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                                                                    <option value="inactive" <?php echo isset($recipe['status']) && $recipe['status'] == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control"
                                                                for="cooking_time">Cooking Time *</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="number" id="cooking_time"
                                                                    name="cooking_time"
                                                                    class="form-control border-primary"
                                                                    value="<?php echo isset($recipe['cooking_time']) ? $recipe['cooking_time'] : ''; ?>"
                                                                    placeholder="Enter cooking time in minutes"
                                                                    required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-actions text-center">
                                                    <button type="button" class="btn btn-warning mr-1">
                                                        <i class="ft-x"></i> Cancel
                                                    </button>
                                                    <input type="hidden" id="recipe_id" name="recipe_id"
                                                        value="<?php echo $recipe['recipe_id']; ?>">
                                                    <input type="hidden" id="btnCuisineUpdate" name="btnCuisineUpdate"
                                                        value="btnCuisineUpdate">
                                                    <button type="submit" class="btn btn-primary"
                                                        onclick="return validateUpdateForm()">
                                                        <i class="la la-check-square-o"></i> Update
                                                    </button>

                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <?php
    include 'includes/footer.php';
    ?>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="../app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../app-assets/js/core/app-menu.js"></script>
    <script src="../app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="../app-assets/js/scripts/forms/select/form-select2.js"></script>
    <!-- END: Page JS-->

    <!-- BEGIN: sweetalert2-->
    <script src="../app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="../app-assets/js/scripts/extensions/ex-component-sweet-alerts.js"></script>
    <!-- END: sweetalert2-->

</body>
<!-- END: Body-->

</html>