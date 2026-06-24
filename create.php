<?php
require_once 'config/database.php';

$username = 'Admin';
$email = 'admin@portal.com';
$password = password_hash('Admin@123', PASSWORD_DEFAULT);
$role = 'admin';

try {
    // احذف أي أدمن قديم
    $pdo->exec("DELETE FROM users WHERE email = '$email'");
    
    // أضف أدمن جديد
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->execute([$username, $email, $password, $role]);
    
    echo "✅ تم إنشاء الأدمن بنجاح!";
    echo "<br>📧 البريد: admin@portal.com";
    echo "<br>🔑 الباسورد: Admin@123";
    echo "<br><a href='index.php'>اذهب لتسجيل الدخول</a>";
} catch(PDOException $e) {
    echo "❌ خطأ: " . $e->getMessage();
}
?>