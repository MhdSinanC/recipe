									<!-- Round Alerts with icons & Arrow start -->
									<?php
                                        // Check if the 'message' parameter is present in the URL
                                        if(isset($_GET['msg'])) {
                                            // The 'message' parameter is present
                                            $message = $_GET['msg'];
                                            $msgtype = $_GET['msg_type'];
                                            if($msgtype == 'Success') {
                                                // The 'message' parameter is present
                                                echo "<div class='alert round bg-success alert-icon-left alert-arrow-left alert-dismissible mb-2' role='alert'>
                                                        <span class='alert-icon'><i class='la la-thumbs-o-up'></i></span>
                                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                            <span aria-hidden='true'>&times;</span>
                                                        </button>
                                                        <strong>$message</strong>
                                                    </div>
                                                    <script>
                                                        toastr.success('$message', 'Progress Bar', { 'progressBar': true });
                                                    </script>";
                                            }
                                            else if($msgtype == 'Error') {
                                                // The 'message' parameter is present
                                                echo "<div class='alert round bg-danger alert-icon-left alert-arrow-left alert-dismissible mb-2' role='alert'>
                                                        <span class='alert-icon'><i class='la la-thumbs-o-down'></i></span>
                                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                            <span aria-hidden='true'>&times;</span>
                                                        </button>
                                                        <strong>$message</strong>
                                                    </div>
                                                    <script>
                                                        toastr.error('$message', 'Progress Bar', { 'progressBar': true });
                                                    </script>";
                                            }
                                            else if($msgtype == 'Warning') {
                                                // The 'message' parameter is present
                                                echo "<div class='alert round bg-warning alert-icon-right alert-arrow-right alert-dismissible mb-2' role='alert'>
                                                        <span class='alert-icon'><i class='la la-warning'></i></span>
                                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                            <span aria-hidden='true'>&times;</span>
                                                        </button>
                                                        <strong>$message</strong>
                                                    </div>
                                                    <script>
                                                        toastr.warning('$message', 'Progress Bar', { 'progressBar': true });
                                                    </script>";
                                            }
                                            else if($msgtype == 'Info') {
                                                // The 'message' parameter is present
                                                echo "<div class='alert round bg-info alert-icon-right alert-arrow-right alert-dismissible mb-2' role='alert'>
                                                        <span class='alert-icon'><i class='la la-info-circle'></i></span>
                                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                            <span aria-hidden='true'>&times;</span>
                                                        </button>
                                                        <strong>$message</strong>
                                                    </div>
                                                    <script>
                                                        toastr.info('$message', 'Progress Bar', { 'progressBar': true });
                                                    </script>";
                                            } else {
                                                // The 'message' parameter is present
                                                echo "<div class='alert round bg-primary alert-icon-left alert-arrow-left alert-dismissible mb-2' role='alert'>
                                                        <span class='alert-icon'><i class='la la-heart'></i></span>
                                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                            <span aria-hidden='true'>&times;</span>
                                                        </button>
                                                        <strong>$message</strong>
                                                    </div>
                                                    <script>
                                                        toastr.info('$message', 'Progress Bar', { 'progressBar': true });
                                                    </script>";
                                            }
                                        }
                                    ?>