<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Remove Customer from Mailing List</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="image-container"><img src="img/elvislogo.gif" alt="Elvis Logo" id="elvislogo" /></div>
<h1>Remove Customer from Mailing List</h1>
<p>Insert the email address of the customer you wish to remove from the mailing list.</p>
<img src="img/blankface.jpg" alt="" id="elvisface" />
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<?php
// Connect to the database
$dbc = mysqli_connect('localhost', 'bbuske', 'intrepid', 'elvis_store')
or die('Error connecting to MySQL server.');

// Delete the customer rows (only if the form has been submitted)
if (isset($_POST['submit'])) {
    foreach ($_POST['todelete'] as $delete_id) {
        $query = "DELETE FROM email_list WHERE id = $delete_id";
        mysqli_query($dbc, $query)
        or die('Error querying database.');
    }

    echo 'Customer(s) removed.<br />';
}

// Display the customer rows with checkboxes for deleting
$query = "SELECT * FROM email_list";
$result = mysqli_query($dbc, $query);
while ($row = mysqli_fetch_array($result)) {
    echo '<input type="checkbox" value="' . $row['id'] . '" name="todelete[]" />';
    echo $row['first_name'];
    echo ' ' . $row['last_name'];
    echo ' ' . $row['email'];
    echo '<br />';
}

mysqli_close($dbc);
?>

    <button type="submit" name="submit" id="submit" value="Remove">Remove</button>
</form>
</body>
</html>