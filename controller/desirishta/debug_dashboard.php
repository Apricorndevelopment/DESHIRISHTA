<?php
include 'config.php';

// 1. Create user_search_logs table
$sql1 = "CREATE TABLE IF NOT EXISTS `user_search_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) NOT NULL,
  `search_date` date NOT NULL,
  `search_time` time NOT NULL,
  `criteria` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if(mysqli_query($con, $sql1)) {
    echo "Table 'user_search_logs' created successfully.<br>";
} else {
    echo "Error creating table 'user_search_logs': " . mysqli_error($con) . "<br>";
}

// 2. Create user_edit_logs table
$sql2 = "CREATE TABLE IF NOT EXISTS `user_edit_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) NOT NULL,
  `edit_date` date NOT NULL,
  `section_edited` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if(mysqli_query($con, $sql2)) {
    echo "Table 'user_edit_logs' created successfully.<br>";
} else {
    echo "Error creating table 'user_edit_logs': " . mysqli_error($con) . "<br>";
}

echo "<h3>Database Setup Complete. Delete this file after running.</h3>";
?>