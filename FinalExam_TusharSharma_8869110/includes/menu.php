<nav class="gg-header-nav" style="display: none;">
    <ul id="menu">
        <li>
        <?php if (!isset($_SESSION['username'])): ?>
            <a href="index.php">Home</a>
            <?php endif; ?>
        </li>
        <li>
            <?php if (!isset($_SESSION['username'])): ?>
                <a href="login.php">Login</a>
            <?php else: ?>
                <a href="logout.php">Logout</a>
            <?php endif; ?>
        </li>
        <?php if (isset($_SESSION['username'])): ?>
            <li>
                <a href="allRegistrations.php">All Registrations</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
