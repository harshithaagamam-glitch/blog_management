<?php
include 'db.php';

if(isset($_POST['submit']))
{
$title=$_POST['title'];
$content=$_POST['content'];

mysqli_query(
$conn,
"INSERT INTO posts(title,content)
VALUES('$title','$content')"
);

header("Location:index.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h3>Create Post</h3>

</div>

<div class="card-body">

<form method="POST">

<input
type="text"
name="title"
class="form-control mb-3"
placeholder="Title">

<textarea
name="content"
class="form-control mb-3"
rows="5">
</textarea>

<button
name="submit"
class="btn btn-success">

Save

</button>

</form>

</div>

</div>

</div>

</body>
</html>