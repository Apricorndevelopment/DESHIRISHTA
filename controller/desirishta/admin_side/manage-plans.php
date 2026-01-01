<?php include 'header.php'; include 'config.php'; ?>
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="col-12"><h2>Subscription Management</h2></div>
        </div>
        <div class="content-body">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Plan Name</th>
                                    <th>Price</th>
                                    <th>Contacts/Day</th>
                                    <th>Validity (Days)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM tbl_plans";
                                $res = mysqli_query($con, $sql);
                                while($row = mysqli_fetch_assoc($res)) {
                                    echo "<tr>
                                        <td>{$row['plan_name']}</td>
                                        <td>{$row['price']}</td>
                                        <td>{$row['contacts_per_day']}</td>
                                        <td>{$row['validity_days']}</td>
                                        <td><a href='edit-plan.php?id={$row['id']}' class='btn btn-primary btn-sm'>Edit</a></td>
                                    </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
