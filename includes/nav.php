<nav class="content-area">
    <a href="index.php"><img src="images/logo.png" alt="hero image of speaker at summit"></a>

    <form action="index.php" method="POST" class="search-form">
        <input type="text" name="search" id="search" placeholder="Search...">
        <button type="submit">Search</button>
    </form>

    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="speakers.php">Speakers</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="admin.php">Admin</a></li>
        <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php?action=login">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>
