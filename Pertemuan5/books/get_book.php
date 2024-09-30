<?php
require_once('../lib/db_login.php');

if (isset($_GET['title'])) {
    $title = $_GET['title'];

    // Query the database to find books by title
    $query = "SELECT * FROM books WHERE title LIKE '%$title%'";
    $result = $db->query($query);

    if ($result->num_rows > 0) {
        echo '<table class="table table-striped">';
        echo '<tr>
                <th>ISBN</th>
                <th>Author</th>
                <th>Title</th>
                <th>Price</th>
              </tr>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['isbn'] . '</td>';
            echo '<td>' . $row['author'] . '</td>';
            echo '<td>' . $row['title'] . '</td>';
            echo '<td>$' . $row['price'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo "No books found for the title: " . htmlspecialchars($title);
    }
} else {
    echo "Please provide a book title.";
}
?>
