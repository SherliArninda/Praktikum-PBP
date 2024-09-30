<?php
session_start();
require_once('../lib/db_login.php');

if (!isset($_SESSION['username'])) {
  header('Location: login.php');
  exit();
}

error_reporting(0);

// Add items to the cart if 'id' is provided in the query string
$id = $_GET['id'];
if ($id != '') {
  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
  }

  if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]++;
  } else {
    $_SESSION['cart'][$id] = 1;
  }
}

// Search logic
$search_title = isset($_GET['search_title']) ? $_GET['search_title'] : '';

?>
<?php include('../header.php') ?>
<br>
<div class="card mt-4">
  <div class="card-header">Shopping Cart</div>
  <div class="card-body">
    <div class="mb-3 d-flex justify-content-end">
      <a class="btn btn-danger" href="logout.php">Logout</a>
    </div>
    
    <!-- Search Form -->
    <form method="GET" action="">
      <label for="search_title">Search for a Book:</label>
      <input type="text" id="search_title" name="search_title" value="<?php echo htmlspecialchars($search_title); ?>">
      <input class="btn btn-primary" type="submit" value="Search">
    </form>
    <br>

    <!-- Book List -->
    <table class="table table-striped">
      <tr>
        <th>ISBN</th>
        <th>Author</th>
        <th>Title</th>
        <th>Price</th>
        <th>Add to Cart</th>
      </tr>
      <?php
      // Display books from the database
      $query = "SELECT * FROM books";
      if ($search_title != '') {
        $query .= " WHERE title LIKE '%$search_title%'";
      }
      
      $result = $db->query($query);
      if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo '<tr>';
          echo '<td>' . $row['isbn'] . '</td>';
          echo '<td>' . $row['author'] . '</td>';
          echo '<td>' . $row['title'] . '</td>';
          echo '<td>$' . $row['price'] . '</td>';
          echo '<td><a class="btn btn-success" href="your_cart_page.php?id=' . $row['isbn'] . '">Add to Cart</a></td>';
          echo '</tr>';
        }
      } else {
        echo '<tr><td colspan="5" align="center">No books found.</td></tr>';
      }
      ?>
    </table>

    
<?php include('../footer.php') ?>
<script src="../ajax.js"></script>