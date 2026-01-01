<?php
include 'header.php';
include '../config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Send Web Push</title>
    <style>
        body{font-family:Arial;background:#f5f5f5}
        .box{width:450px;margin:60px auto;background:#fff;padding:25px;border-radius:8px}
        input,textarea,button{width:100%;padding:10px;margin:8px 0}
        button{background:#28a745;color:#fff;border:none;cursor:pointer}
    </style>
</head>
<body>

<div class="box">
    <h2>🔔 Send Web Push Notification</h2>

    <form method="post" action="push-action.php">
        <input type="text" name="title" placeholder="Notification Title" required>
        <textarea name="message" placeholder="Notification Message" required></textarea>
        <input type="text" name="link" placeholder="Redirect Link (https://...)" required>
        <button type="submit" name="send_push">Send Push</button>
    </form>
</div>

</body>
</html>
<?php include 'footer.php'; ?>
