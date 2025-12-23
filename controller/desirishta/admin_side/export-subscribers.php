<?php
include 'config.php';

$filename = "Newsletter_Subscribers_" . date('Y-m-d') . ".xls";

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");

$flag = false;
$result = mysqli_query($con, "SELECT id, email, created_at FROM tbl_newsletter ORDER BY id DESC");

while ($row = mysqli_fetch_assoc($result)) {
    if (!$flag) {
        // Column Headers (Excel ki pehli line)
        echo implode("\t", array_keys($row)) . "\r\n";
        $flag = true;
    }
    // Data Rows
    echo implode("\t", array_values($row)) . "\r\n";
}
?>