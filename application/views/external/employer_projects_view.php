<!-- Will transfer styling in a separate css file later -->

<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url()?>/assets/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url()?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url()?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
    $(function () {
        // To apply for a specific EP
        $('.apply_emp').click(function () {
            var ep_id = $(this).data('id');
            // Ask user for confirmation
            swal({
                    title: "Confirm application?",
                    text: "This application will be submitted to the employer.\nUpon reviewal, you will be contacted.",
                    icon: "info",
                    buttons: ['Cancel', 'Confirm']
                })
                // Send application into db once confirmed
                .then((send_application) => {
                    if (send_application) {
                        $.ajax({
                            url: 'Employer_projects/send_emp_application/',
                            type: 'post',
                            data: {ep_id: ep_id},
                            success: function() { 
                                swal({
                                    title: "Thank you!",
                                    text: "Your application has been submitted.",
                                    icon: "success",
                                })
                                .then((send_application) => {
                                    location.reload();
                                });
                            }
                        });
                    }
                });
        });
    });
</script>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" class="flex-fill">

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div style="background-color: green; display:block;">Navigation bar here<br><br><br></div> <!-- Remove this later -->
                    <!-- Page Heading -->
                    <h1 class="h3 mb-1 text-gray-800"><?= $title ?></h1>
                    <p class="mb-4">To provide students the opportunity to gain real, hands-on work experience while still studying, 
                    INTI has built close ties with the industry to develop employer projects – a programme that enables students to work 
                    on actual business case studies and industry-relevant problems.</p> <!-- Edit description later -->

                    <!-- Content Row. 1 row = 3 cards -->
                    <div class="row">

                    <!-- <php foreach ($eps as $ep): var_dump($ep); ?> hello <br><br> <php endforeach; die;?> -->

                        <?php foreach ($eps as $ep): ?>
                            <div class="col-lg-4 mb-4">
                                <div class="card mb-4 h-100"> <!-- h-100 to make cards same height despite some content being lesser than some-->
                                    <div class="card-header py-3" style="background-color: #40916c" >
                                        <h6 class="m-0 font-weight-bold" style="color: #edf2f4"><?= $ep['c_name']?></h6>
                                    </div>
                                    <div class="card-body" >
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item" style="text-align: center;">
                                            <img class="img-fluid" src="<?= base_url("assets/img/company_logos/{$ep['c_logo']}");?>" width="300" style="margin-bottom: 30px; "/>
                                                <h6><b>Project Title: <?= $ep['emp_title']?></b></h6>
                                            </li>
                                            <li class="list-group-item" >
                                                <table>
                                                    <tr>
                                                        <th style="vertical-align: top">Level: </th>
                                                        <td style="text-align: left;"><?= $ep['emp_level']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th style="vertical-align: top">Field: </th>
                                                        <td style="text-align: left;"><?= $ep['emp_area']?></td>
                                                    </tr>
                                                </table>
                                            </li>
                                            <li class="list-group-item">
                                                <span style="text-align: left"><?= $ep['emp_description'] ?></span>
                                            </li>
                                        </ul>
                                        <br>
                                        <div class="testing"></div>
                                        <!-- 2 Bottom Buttons -->
                                        <!-- *Check if session is established. If yes, show the buttons -->
                                        <div class="bottom_buttons" style="position: absolute; bottom: 0; right: 0; margin: 0px 10px 10px 0px">
                                            <button type="button" class="btn" style="background-color: #8993a3; color:#FFFFFF">View</button>
                                        <!-- **Check if student has already applied to this specific EP. If yes, disable the apply button -->
                                            <?php 
                                                $response = $this->emp_applicants_model->past_application($ep['emp_id'], '123'); // later replace with session's student_id
                                                if ($response == true) { ?>
                                                    <button type="button" class="btn apply_emp" style="background-color: #0077b6; color:#FFFFFF"  data-id="<?= $ep['emp_id'] ?>" disabled>Applied</button>
                                            <?php } else { ?>
                                                <button type="button" class="btn apply_emp" style="background-color: #67b99a; color:#FFFFFF"  data-id="<?= $ep['emp_id'] ?>">Apply Now</button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- /.content -->
