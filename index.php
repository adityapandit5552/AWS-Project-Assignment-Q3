```php
<?php

require_once "db.php";

$message = "";
$messageType = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $course = trim($_POST["course"] ?? "");
    $phone = trim($_POST["phone"] ?? "");

    if ($name === "" || $email === "" || $course === "" || $phone === "") {

        $message = "Please fill in all fields.";
        $messageType = "error";

    } else {

        $stmt = $conn->prepare(
            "INSERT INTO students (name, email, course, phone)
             VALUES (?, ?, ?, ?)"
        );

        $stmt->bind_param("ssss", $name, $email, $course, $phone);

        if ($stmt->execute()) {
            $message = "✓ Student registered successfully.";
            $messageType = "success";
        } else {
            $message = "Registration failed: " . $conn->error;
            $messageType = "error";
        }

        $stmt->close();
    }
}

$result = $conn->query(
    "SELECT id, name, email, course, phone, created_at
     FROM students
     ORDER BY id DESC"
);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Registration</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <header>

        <div>

            <p class="tag">AWS EC2 + RDS</p>

            <h1>Student Registration</h1>

            <p class="subtitle">
                Register students and store their records securely in Amazon RDS MySQL.
            </p>

        </div>

        <div class="status">

            <span></span>

            DATABASE CONNECTED

        </div>

    </header>


    <?php if ($message !== ""): ?>

        <div class="message <?php echo $messageType; ?>">

            <?php echo htmlspecialchars($message); ?>

        </div>

    <?php endif; ?>


    <section class="card">

        <h2>Register Student</h2>

        <form method="POST" action="index.php">

            <div class="form-grid">

                <div class="field">

                    <label>Student Name</label>

                    <input
                        type="text"
                        name="name"
                        placeholder="Enter student name"
                        required
                    >

                </div>


                <div class="field">

                    <label>Email Address</label>

                    <input
                        type="email"
                        name="email"
                        placeholder="Enter email address"
                        required
                    >

                </div>


                <div class="field">

                    <label>Course</label>

                    <input
                        type="text"
                        name="course"
                        placeholder="e.g. Computer Science"
                        required
                    >

                </div>


                <div class="field">

                    <label>Phone Number</label>

                    <input
                        type="text"
                        name="phone"
                        placeholder="Enter phone number"
                        required
                    >

                </div>

            </div>


            <button type="submit">
                REGISTER STUDENT
            </button>

        </form>

    </section>


    <section class="card">

        <div class="table-header">

            <h2>Registered Students</h2>

            <p>
                Records retrieved from Amazon RDS MySQL
            </p>

        </div>


        <div class="table-container">

            <table>

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Name</th>

                        <th>Email</th>

                        <th>Course</th>

                        <th>Phone</th>

                        <th>Registered</th>

                    </tr>

                </thead>


                <tbody>

                    <?php if ($result && $result->num_rows > 0): ?>

                        <?php while ($row = $result->fetch_assoc()): ?>_
```
