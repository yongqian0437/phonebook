<!-- Content Wrapper -->
<div id="content-wrapper" >

<!-- Main Content -->
<div id="content">    
    
    <!-- Begin Page Content -->
    <div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Education Agents</h6>
        </div>
        <div class="card-body">
        <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>User ID</th>
                            <th>Contact Number</th>
                            <th>Business email</th>
                            <th>Nationality</th>
                            <th>Gender</th>
                            <th>DOB</th>
                            <th>Document</th>
                            <th>Submit Date</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                    <?php
                        foreach($ealist->result() as $ea)
                            echo "<tr>"
                                ."<td>$ea->ea_id</td>"
                                ."<td>$ea->user_id</td>"
                                ."<td>$ea->ea_phonenumber</td>"
                                ."<td>$ea->ea_businessemail</td>"
                                ."<td>$ea->ea_nationality</td>"
                                ."<td>$ea->ea_gender</td>"
                                ."<td>$ea->ea_dob</td>"
                                ."<td><a class='btn btn-primary btn-block' href='"
                                .base_url()
                                ."assets/uploads/education_agents/$ea->ea_document' role='button' target='_blank'>View</a></td>" 
                                ."<td>$ea->ea_submitdate</td>" 
                                ."</tr>" 
                    ?>
                    </tbody>
                </table>
        </div>
    </div>
</div>
</div>

