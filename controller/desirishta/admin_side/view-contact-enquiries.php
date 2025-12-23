<?php
include 'header.php';
include 'config.php';
?>
 <STYLE>
    table.dataTable thead .sorting:after,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_desc:after,
table.dataTable thead .sorting_asc_disabled:after,
table.dataTable thead .sorting_desc_disabled:after {
    content: "" !important;


}
 table.dataTable thead .sorting:before,
table.dataTable thead .sorting_asc:before,
table.dataTable thead .sorting_desc:before,
table.dataTable thead .sorting_asc_disabled:before,
table.dataTable thead .sorting_desc_disabled:before {
    content: "" !important;
}
table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:after, table.dataTable thead .sorting_asc_disabled:after, table.dataTable thead .sorting_desc_disabled:after {
    right:12PX;
    /* content: "\2193"; */
    FONT-SIZE: 23PX;
    TOP: 30PX;
}
table.dataTable thead .sorting:before, table.dataTable thead .sorting_asc:before, table.dataTable thead .sorting_desc:before, table.dataTable thead .sorting_asc_disabled:before, table.dataTable thead .sorting_desc_disabled:before {
    right: 1em;
    content: "\2191";
    TOP: 14PX;
}





  </STYLE>
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>

    <div class="content-wrapper">

        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <h2 class="content-header-title float-left mb-0">Contact Enquiries</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Contact Enquiries</a></li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="content-body">

            <section id="basic-table">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Messages List</h4>
                            </div>

                            <div class="table-responsive col-md-12">
                                <table class="table table-striped" id="dt">
                                    <thead>
                                        <tr>
                                            <th>Sr <br>no</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $query = "SELECT * FROM contact_us ORDER BY status DESC, submission_date DESC";
                                        $result = mysqli_query($con, $query);

                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $status = $row['status'];
                                        ?>

                                        <tr>
                                            <td><?php echo $row['id']; ?></td>

                                            <td><?php echo $row['name']; ?></td>

                                            <td><?php echo $row['category']; ?></td>

                                            <td><?php echo date('d M Y, H:i', strtotime($row['submission_date'])); ?></td>

                                            <td>
                                                <?php
                                                if ($status == "New") {
                                                    echo "<span class='text-danger'>New</span>";
                                                } else {
                                                    echo "<span class='text-success'>Seen</span>";
                                                }
                                                ?>
                                            </td>

                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="view-contact-detail.php?id=<?php echo $row['id']; ?>">
                                                            <i data-feather='eye' class='mr-50'></i>
                                                            <span>View / Mark Seen</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <?php } ?>
                                    </tbody>

                                </table>
                            </div>

                        </div>

                    </div>
                </div>
            </section>

        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
