<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Customer Email</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="image-container"><img src="img/elvislogo.gif" alt="Elvis Logo" id="elvislogo"></div>
<h1>Send Customer Email</h1>
<p>Insert a subject and the email body, you wish to send to your clients and click on submit, to send the email.</p>
<img src="img/blankface.jpg" alt="" id="elvisface">
<?php
if (isset($_POST['submit'])) {
    $from = 'elmer@makemeelvis.com';
    $subject = $_POST['subject'];
    $text = $_POST['elvismail'];
    $output_form = false;

    if (empty($subject) && empty($text)) {
        // We know both $subject AND $text are blank
        echo 'You forgot the email subject and body text.<br />';
        $output_form = true;
    }

    if (empty($subject) && (!empty($text))) {
        echo 'You forgot the email subject.<br />';
        $output_form = true;
    }

    if ((!empty($subject)) && empty($text)) {
        echo 'You forgot the email body text.<br />';
        $output_form = true;
    }
}
else {
    $output_form = true;
}

if ((!empty($subject)) && (!empty($text))) {
    $dbc = mysqli_connect('data.makemeelvis.com', 'user', 'password', 'elvis_store')
    or die('Error connecting to MySQL server.');

    $query = "SELECT * FROM email_list";
    $result = mysqli_query($dbc, $query)
    or die('Error querying database.');

    while ($row = mysqli_fetch_array($result)){
        $to = $row['email'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $msg = "Dear $first_name $last_name,\n$text";
        mail($to, $subject, $msg, 'From:' . $from);
        echo 'Email sent to: ' . $to . '<br />';
    }

    mysqli_close($dbc);
}

if ($output_form) {
    ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="subject">Subject of email:</label><br />
        <input id="subject" name="subject" type="text" value="<?php echo $subject; ?>" size="30" /><br />
        <label for="elvismail">Body of email:</label><br />
        <textarea id="elvismail" name="elvismail" rows="8" cols="40"><?php echo $text; ?></textarea><br />
        <button type="submit" name="submit" id="submit" value="Submit">Submit</button>
    </form>

    <?php
}
?>

</body>
</html>

