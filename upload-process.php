<?php
$servername = "localhost";
$username = "userr";
$password = "root";
$dbname = "userr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$fullName = $_POST["fullName"];
$emailAddress = $_POST["emailAddress"];
$mealName = $_POST["mealName"];
$categoryName = $_POST["categoryName"];
$instructions = $_POST["instructions"];
$picture = $_POST["picture"];
$videoLink = $_POST["videoLink"];

// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO userRecipe (fullName, emailAddress, mealName, categoryName, instructions, picture, videoLink) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $fullName, $emailAddress, $mealName, $categoryName, $instructions, $picture, $videoLink);

// Execute the SQL statement
if ($stmt->execute()) {
  $recipeID = $conn->insert_id; // Get the auto-generated ID of the inserted recipe
    // Redirect to submission-report.php with query parameters
  header("Location: submission-report.php?fullName=$fullName&emailAddress=$emailAddress&mealName=$mealName&categoryName=$categoryName&instructions=$instructions&picture=$picture&videoLink=$videoLink");
  exit();
/*  echo "Recipe submitted successfully! Recipe ID: " . $recipeID . "<br><br>";
  echo "Submitted Recipe Details:<br>";
  echo "Full Name: " . $fullName. "<br>";
  echo "Email Address: " . $emailAddress . "<br>";
  echo "Meal Name: " . $mealName . "<br>";
  echo "Category Name: " . $categoryName . "<br>";
  echo "Instructions: " . $instructions . "<br>";
  echo "Picture: " . $picture . "<br>";
  echo "Video Link: " . $videoLink . "<br>";
  
    // Redirect to submission-report.php
  header("Location: submission-report.php");
  exit(); */
} else {
  echo "Error: " . $stmt->error;
}

// Close the prepared statement and database connection
$stmt->close();
$conn->close();
?>
