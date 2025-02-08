<!-- Author: Lakshmi-->

<?php
include("../config/db_con.php");

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
    <title>Local Art Data</title>
    <link rel="apple-touch-icon" href="../app-assets/images/ico/logo.png">
    <link rel="shortcut icon" type="image/x-icon" href="../app-assets/images/ico/logo.png">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css"
        href="../app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css">

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
        function validateForm(reference_id, ref_name) {
            var category_form_view_ = "category_form_view_" + reference_id;
            Swal.fire({
                title: "Are you sure on Deleting the  " + ref_name + "?",
                text: "Once you deleted, cannot revert",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete!',
                confirmButtonClass: 'btn btn-warning',
                cancelButtonClass: 'btn btn-danger ml-1',
                buttonsStyling: false,
            }).then(function (result) {
                if (result.value) {
                    document.getElementById(category_form_view_).submit(); // Submit the form using JavaScript
                }
                else {
                    return false;
                }
            })
        }
    </script>


<body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">
    <!-- BEGIN: Header-->
    <?php include 'includes/header.php'; ?>
    <!-- END: Header-->

    <!-- BEGIN: Menu-->
    <?php include 'includes/menu.php'; ?>
    <!-- END: Menu-->

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Category Data</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="cuisine_category.php">Cuisine Category</a></li>
                                <li class="breadcrumb-item active">Category Data</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BEGIN: Content-->
            <div class="content-body">
                <!-- Configuration option table -->
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Cuisine View</h4>
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
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <?php
                                        include 'includes/message.php';
                                        ?>


                                        <table class="table table-striped table-bordered dataex-res-configuration">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Image</th>
                                                    <th>Created On</th>
                                                    <th>Updated On</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                   // Query to fetch categories data
                                        $query = "SELECT * FROM categories";
                                        $result = mysqli_query($dbconnection, $query);
                                                if ($result) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "<tr>
                    <td>{$row['category_id']}</td>
                    <td>{$row['name']}</td>
                    <td>
                        <a href='../uploads/{$row['image']}' download>
                            <img src='../uploads/{$row['image']}' alt='Category Image' style='width:50px;height:50px;'>
                        </a>
                    </td>
                    <td>{$row['created_at']}</td>
                    <td>{$row['updated_at']}</td>
                    <td>" . ($row['status'] === 'active' ? 'Active' : 'Inactive') . "</td>
                    <td class='d-flex align-items-center'>
                        <a class='btn btn-primary mr-1' href='category_edit.php?id={$row['category_id']}'>
                            <i class='la la-edit'></i>
                        </a>
                        <form id='category_form_view_{$row['category_id']}' method='post' action='controllers/category.php' class='mb-0'>
                            <input type='hidden' id='btn_category_delete' name='btn_category_delete' value='btn_category_delete'>
                            <input type='hidden' id='id_ref' name='id_ref' value='{$row['category_id']}'>
                            <button type='button' id='delete_button_{$row['category_id']}' class='btn btn-danger mr-1' onclick='return validateForm({$row['category_id']}, `{$row['name']}`)'>
                                <i class='la la-trash'></i>
                            </button>
                        </form>
                    </td>
                </tr>";
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Configuration option table -->
            </div>
        </div>
    </div>

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <?php include 'includes/footer.php'; ?>
    <!-- END: Footer-->

    <script src="../app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="../app-assets/vendors/js/tables/buttons.colVis.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>


    <script src="../app-assets/vendors/js/tables/jszip.min.js"></script>
    <script src="../app-assets/vendors/js/tables/pdfmake.min.js"></script>
    <script src="../app-assets/vendors/js/tables/vfs_fonts.js"></script>
    <script src="../app-assets/vendors/js/tables/buttons.html5.min.js"></script>
    <script src="../app-assets/vendors/js/tables/buttons.print.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../app-assets/js/core/app-menu.js"></script>
    <script src="../app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="../app-assets/js/scripts/forms/select/form-select2.js"></script>
    <!-- END: Page JS-->

    <!-- BEGIN: Page JS-->
    <script src="../app-assets/js/scripts/tables/datatables-extensions/datatable-responsive.js"></script>
    <!-- END: Page JS-->

    <!-- BEGIN: sweetalert2-->
    <script src="../app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="../app-assets/js/scripts/extensions/ex-component-sweet-alerts.js"></script>
    <!-- END: sweetalert2-->

</body>
<!-- END: Body-->

</html>