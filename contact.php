<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact Us</title>
<style>
    /* Reset CSS */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/* Body styles */
body {
  font-family: Arial, sans-serif;
  background-color: #f4f4f4;
}

/* Container styles */
.container {
  max-width: 500px;
  margin: 50px auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Form styles */
form {
  display: grid;
  gap: 10px;
}

label {
  font-weight: bold;
}

input,
textarea {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

input[type="submit"] {
  background-color: #4caf50;
  color: #fff;
  border: none;
  border-radius: 3px;
  padding: 10px;
  cursor: pointer;
}

/* Responsive styles */
@media screen and (max-width: 600px) {
  .container {
    margin: 20px;
    padding: 10px;
  }

  input,
  textarea {
    padding: 6px;
  }

  input[type="submit"] {
    padding: 8px;
  }
}
</style>

</head>
<body>
<div class="container">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <h2>Contact Us</h2>
    <label for="name">Name</label>
    <input type="text" id="name" name="name" placeholder="Your name.." required>
    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="Your email.." required>
    <label for="phone">Phone Number</label>
    <input type="tel" id="phone" name="phone" placeholder="Your phone number.." required>
    <label for="message">Message</label>
    <textarea id="message" name="message" placeholder="Write something.." required></textarea>
    <input type="submit" name="submit" value="Submit">
  </form>
</div>
</body>
</html>

<?php
// Database credentials
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $message = $_POST['message'];

  // Insert data into database
  $sql = "INSERT INTO contact_form (name, email, phone, message)
  VALUES ('$name', '$email', '$phone', '$message')";

  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Thank you for contacting us!');</script>";
  } else {
    echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
  }
}

// Close connection
$conn->close();
?>
</html>
