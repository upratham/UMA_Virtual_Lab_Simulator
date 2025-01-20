<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: index.html");
    exit();
}
?>

<!-- Header with username and logout option -->
<header class="user-header">
    <div class="user-info">
        Hello, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
        <a href="logout.php" class="logout-link">Log Out</a>
    </div>
</header>

<style>
    .user-header {
        background-color: #f0f0f0;
        padding: 10px 20px;
        text-align: right;
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    
    .user-info {
        font-size: 16px;
    }
    
    .logout-link {
        margin-left: 20px;
        color: #e40d5e;
        text-decoration: none;
        font-weight: bold;
    }
    
    .logout-link:hover {
        text-decoration: underline;
    }
    
    body {
        padding-top: 60px; /* Add padding to ensure content is not hidden behind the fixed header */
    }
</style>
