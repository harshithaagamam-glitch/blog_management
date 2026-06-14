<?php
include 'db.php';
$limit = 6;

$page = isset($_GET['page'])
?
$_GET['page']
:
1;

$start = ($page - 1) * $limit;
$search = "";

if(isset($_GET['search']))
{
    $search = $_GET['search'];
}
$result=mysqli_query(
$conn,
"SELECT * FROM posts
WHERE title LIKE '%$search%'
OR content LIKE '%$search%'
LIMIT $start,$limit"
);
$total_result=mysqli_query(
$conn,
"SELECT COUNT(*) AS total
FROM posts"
);

$total_row=mysqli_fetch_assoc(
$total_result
);

$total_posts=
$total_row['total'];

$total_pages=
ceil(
$total_posts/$limit
);
?>

<!DOCTYPE html>
<html>
<head>

<title>Blog Management</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="style.css">

</head>

<body>

<nav class="navbar navbar-dark bg-primary">
<div class="container">

<a class="navbar-brand">
Blog Management System
</a>

</div>
</nav>

<div class="container mt-4">

<div class="hero">
<form method="GET">

<div class="input-group my-4">

<input
type="text"
name="search"
class="form-control"
placeholder="Search Posts">

<button
class="btn btn-primary">

Search

</button>

</div>

</form>

<h1>Welcome Admin</h1>

<p>
Manage Blog Posts Easily
</p>

</div>

<a href="create.php"
class="btn btn-success my-3">

Add New Post

</a>

<div class="row">

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<div class="col-md-4">

<div class="card shadow">

<div class="card-body">

<h4>
<?php echo $row['title']; ?>
</h4>

<p>
<?php echo $row['content']; ?>
</p>

<a href="edit.php?id=<?php echo $row['id']; ?>"
class="btn btn-warning">

Edit

</a>

<a href="delete.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger">

Delete

</a>

</div>

</div>

</div>

<?php } ?>

</div>

</div>
<nav class="mt-4">

<ul class="pagination justify-content-center">

<?php

for($i=1;$i<=$total_pages;$i++)
{
?>

<li class="page-item">

<a
class="page-link"
href="?page=<?php echo $i; ?>">

<?php echo $i; ?>

</a>

</li>

<?php
}
?>

</ul>

</nav>

</body>
</html>