<section class="navbar">
    <div class="bar">
        <ul class="ulmenu">
            <li><a href="../index.php">ABOUT</a></li>
            <li><a href="#">TOUR</a></li>
            <li><a href="#">CONTACT</a></li>

        </ul>
        <div class="login-button">
            <?php if (!isset($_SESSION["user"])): ?>
            <button class="login">
                <a class="a-login" href="../login.php">LOGIN</a>

            </button>
            <?php else: ?>
            <button class="login">
                <a href="logout.php" class="logout">
                    LOGOUT
                </a>
            </button>
            <?php endif; ?>
        </div>
    </div>
</section>
