<?php
session_start();
require_once 'config/database.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: index.php');
    exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();

if (!$user) {
    header('Location: dashboard.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user['password'];

    $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, password = ?, role = ? WHERE id = ?");
    $stmt->execute([$username, $email, $password, $role, $id]);

    header('Location: dashboard.php?success=updated');
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل مستخدم</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="dashboard-body">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body p-4">
                    <h4 class="mb-4"><i class="fas fa-edit me-2"></i>تعديل المستخدم</h4>
                    <form method="POST">
                        <div class="mb-3">
                            <label>اسم المستخدم</label>
                            <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label>نوع المستخدم</label>
                            <select name="role" class="form-control" required>
                                <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>مستخدم عادي</option>
                                <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>أدمن</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>البريد الإلكتروني</label>
                            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label>كلمة المرور (اتركها فارغة إذا لا تريد التغيير)</label>
                            <input type="text" name="password" class="form-control" placeholder="أدخل كلمة مرور جديدة">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">تحديث</button>
                        <a href="dashboard.php" class="btn btn-secondary w-100 mt-2">رجوع</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>