<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
   
}
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "User";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <a href="dashboard.php" class="active"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
    <a href="#"><i class="fas fa-user me-2"></i> Profile</a>
    <a href="#"><i class="fas fa-cog me-2"></i> Settings</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
</div>

<!-- Top Navbar -->
<div class="top-navbar">
    <span class="navbar-brand">My Dashboard</span>
    <div class="d-flex align-items-center">
        <img src="assets/img/img1.png" alt="User Avatar" class="user-avatar">
        <span>Welcome,  <?php echo htmlspecialchars($username); ?></span>
    </div>
</div>

<!-- Main Content -->
<div class="content">
    <div class="container-fluid">
        <div class="row g-4 mb-4">
            <!-- Stats Cards -->
            <div class="col-md-4">
                <div class="card stats-card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">245</h5>
                        <p class="card-text">New Users</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stats-card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">89%</h5>
                        <p class="card-text">Performance</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stats-card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">55</h5>
                        <p class="card-text">Messages</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Feed -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Recent Activity</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-3">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Completed a task.
                            </li>
                            <li class="mb-3">
                                <i class="fas fa-chart-line text-info me-2"></i>
                                Analytics report generated.
                            </li>
                            <li class="mb-3">
                                <i class="fas fa-user-plus text-primary me-2"></i>
                                New user registration.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- User Info Widget -->
            <div class="col-lg-4">
                <div class="card text-center">
                    <div class="card-body">
                        <img src="assets/img/img1.png" alt="User Avatar" class="user-avatar mb-3">
                        <h5> <?php echo htmlspecialchars($username); ?> </h5>
                        <p class="text-muted">Administrator</p>
                        <button class="btn btn-primary">View Profile</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>