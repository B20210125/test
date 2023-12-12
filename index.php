<?php 

$servername = "localhost"; // This could be a domain or an IP address
$username = "testadmin";
$password = "";
$database = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

if (isset($_POST['submit'])) {

// Collect data from the form
$subject = $_POST['subject']; // Assuming you're using POST method in your form
$name = $_POST['name'];
$comment = $_POST['comment'];

// SQL query to insert data into the table
$sql = "INSERT INTO comment (subject, name, comment) VALUES ('$subject', '$name', '$comment')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}

// Close connection
$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
</head>
<body>

<h3>Contact Form</h3>

<div class="container">
  <form action="index.php" method="POST">
    <label for="fname">Subject</label>
    <input type="text" id="fname" name="subject" placeholder="subject">

    <label for="lname">Name</label>
    <input type="text" id="lname" name="name" placeholder="Your Name">

    <label for="comment">Comment</label>
    <textarea id="subject" name="comment" placeholder="Write something.." style="height:200px"></textarea>

    <input type="submit" value="Submit" name="submit">
  </form>
</div>

</body>
</html>
