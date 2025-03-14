<?php
$dbc = mysqli_connect('localhost', 'bbuske', 'intrepid', 'elvis_store')
    or die('Error connecting to MySQL server.');

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];

$query = "INSERT INTO email_list (first_name, last_name, email)  VALUES ('$first_name', '$last_name', '$email')";

mysqli_query($dbc, $query)
    or die('Error querying database.');

echo 'Customer added to email list.';

mysqli_close($dbc);