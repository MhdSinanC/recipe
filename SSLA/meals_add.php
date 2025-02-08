<!-- Author: Lakshmi-->

<!DOCTYPE html>
<?php
include("../config/db_con.php");

?>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Ai2Gi Admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords"
        content="admin template, Ai2Gi Admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="Ai2Gi">
    <title>Chalo Events</title>
    <link rel="apple-touch-icon" href="../app-assets/images/ico/logo_chalo.png">
    <link rel="shortcut icon" type="image/x-icon" href="../app-assets/images/ico/logo_chalo.png">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/forms/selects/select2.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/extensions/sweetalert2.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/components.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/core/colors/palette-gradient.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <!-- END: Custom CSS-->

    <!-- BEGIN: toastr CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- END: toastr CSS-->

    <script>
        function validateForm() {

            Swal.fire({
                title: 'Are you sure?',
                text: "Save Art Data!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Save!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger ml-1',
                buttonsStyling: false,
            }).then(function (result) {
                if (result.value) {
                    document.getElementById('form_meal_add').submit(); // Submit the form using JavaScript
                }
                else {
                    return false;

                }
            })

        }

    </script>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Header-->
    <?php
    include 'includes/header.php';
    ?>
    <!-- END: Header-->

    <!-- BEGIN: Menu-->
    <?php
    include 'includes/menu.php';
    ?>
    <!-- END: Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="horizontal-form-layouts">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 style="margin-bottom:-20px">Fill the form</h2>
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
                                        <div class="card-text" style="margin-top:-20px;">
                                            <br>
                                            <ul>
                                                <li> <span style="color:red">*</span> Fields are Mandatory</li>
                                            </ul>
                                            <div id="dataTable"></div>
                                        </div>
                                        <?php
                                        include 'includes/message.php';
                                        ?>
                                        <form id="form_meal_add" class="form form-horizontal"
                                            action="controllers/meal.php" method="post" enctype="multipart/form-data">
                                            <div class="form-body">
                                                <h4 class="form-section"></h4>
                                                <div class="row">
                                                    <!-- Ingredients -->
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="name">
                                                                Name</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" id="name" name="name"
                                                                    class="form-control border-primary" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Meal Type -->
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control"
                                                                for="meal_type_id">Meal Type</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <select class="select2-theme form-control"
                                                                    id="meal_type_id" name="meal_type_id">
                                                                    <option value="">-- Select Meal Type --</option>
                                                                    <?php
                                                                    // Query to fetch meal types from the 'meal_types' table
                                                                    $meal_type_query = "SELECT id, name FROM meal_types WHERE status = 'active'";
                                                                    $meal_type_result = mysqli_query($dbconnection, $meal_type_query);

                                                                    // Populate the meal type dropdown
                                                                    while ($meal_type_row = mysqli_fetch_assoc($meal_type_result)) {
                                                                        echo '<option value="' . $meal_type_row['id'] . '">' . $meal_type_row['name'] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                        <div class="row">

                                                        <!-- Equipment -->
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <label class="col-md-3 label-control"
                                                                    for="preparation_method">Preparation Method</label>
                                                                <div class="col-md-9 mx-auto">
                                                                    <textarea id="preparation_method" name="preparation_method"
                                                                        class="form-control border-primary"
                                                                        rows="6"></textarea>
                                                                    <small class="form-text text-muted"></small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <label class="col-md-3 label-control"
                                                                    for="status">Status</label>
                                                                <div class="col-md-9 mx-auto">
                                                                    <select id="status" name="status"
                                                                        class="form-control border-primary">
                                                                        <option value="active">Active</option>
                                                                        <option value="inactive">Inactive</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                 

                                                    <div class="form-actions text-center">
                                                        <button type="reset" class="btn btn-warning mr-1">
                                                            <i class="ft-x"></i> Cancel
                                                        </button>
                                                        <input type="hidden" id="btnAddMeal" name="btnAddMeal"
                                                            value="btnAddMeal">
                                                        <button type="button" class="btn btn-primary" id="btn_meal_Add"
                                                            name="btn_meal_Add" onclick="return validateForm()">
                                                            <i class="la la-check-square-o"></i> Save
                                                        </button>
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