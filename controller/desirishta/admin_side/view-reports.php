<?php
include 'header.php';
include 'config.php';

// रिपोर्ट्स डेटा फेच करें
// हम registration टेबल को दो बार JOIN कर रहे हैं ताकि रिपोर्टर और आरोपी दोनों का नाम मिल सके
$sql = "SELECT r.*, 
               u1.name as reporter_name, u1.userid as reporter_id, u1.phone as reporter_phone,
               u2.name as reported_name, u2.userid as reported_id, u2.phone as reported_phone
        FROM report_ids r 
        LEFT JOIN registration u1 ON r.by_who = u1.userid 
        LEFT JOIN registration u2 ON r.against = u2.userid 
        ORDER BY r.id DESC";

$result = mysqli_query($con, $sql);
?>

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <h2 class="content-header-title float-left mb-0">Reported Profiles</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Reported Profiles</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="content-body">
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header border-bottom p-1">
                                <h4 class="card-title">All Reports / Misuse Requests</h4>
                            </div>
                            <div class="table-responsive p-1">
                                <table class="table table-striped table-hover" id="dt">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Reported User (Against)</th>
                                            <th>Reported By (Reporter)</th>
                                            <th>Violation Type</th>
                                            <th>Subject & Complaint</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    if(mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            // Violation // se separated hai, use comma me badal rahe hain
                                            $violation_list = str_replace("//", ", ", $row['violation']);
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        
                                        <td>
                                            <?php if($row['reported_name']) { ?>
                                                <span class="font-weight-bold text-danger"><?php echo $row['reported_name']; ?></span><br>
                                                <small>ID: <a href="userprofile-view.php?uid=<?php echo $row['reported_id']; ?>" target="_blank"><?php echo $row['reported_id']; ?></a></small><br>
                                                <small class="text-muted"><?php echo $row['reported_phone']; ?></small>
                                            <?php } else { echo "<span class='text-muted'>User Not Found (ID: ".$row['against'].")</span>"; } ?>
                                        </td>

                                        <td>
                                            <?php if($row['reporter_name']) { ?>
                                                <span class="font-weight-bold text-primary"><?php echo $row['reporter_name']; ?></span><br>
                                                <small>ID: <a href="userprofile-view.php?uid=<?php echo $row['reporter_id']; ?>" target="_blank"><?php echo $row['reporter_id']; ?></a></small>
                                            <?php } else { echo "<span class='text-muted'>User Not Found (ID: ".$row['by_who'].")</span>"; } ?>
                                        </td>

                                        <td>
                                            <span class="badge badge-light-warning" style="white-space: normal; text-align:left;">
                                                <?php echo htmlspecialchars($violation_list); ?>
                                            </span>
                                        </td>

                                        <td>
                                            <span class="font-weight-bold">Sub:</span> <?php echo htmlspecialchars($row['subject']); ?><br>
                                            <span class="font-weight-bold">Msg:</span> <small><?php echo htmlspecialchars($row['complaint']); ?></small>
                                        </td>

                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="userprofile-view.php?uid=<?php echo $row['against']; ?>" target="_blank">
                                                        <i data-feather="eye" class="mr-50"></i> View Profile
                                                    </a>
                                                    
                                                    <a class="dropdown-item text-warning" href="userprofile-update.php?uid=<?php echo $row['against']; ?>&status=2" onclick="return confirm('Are you sure you want to Deactivate this user?');">
                                                        <i data-feather="slash" class="mr-50"></i> Deactivate User
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='6' class='text-center'>No Reports Found</td></tr>";
                                    }
                                    ?>
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