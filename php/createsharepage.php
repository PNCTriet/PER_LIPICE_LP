<?php
// Bắt lỗi và hiển thị
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Kiểm tra dữ liệu POST
$input = file_get_contents("php://input");
$data = json_decode($input, true);

// Kiểm tra dữ liệu nhận được
if (isset($data['name']) && isset($data['imageUrl'])) {
    $name = $data['name'];
    $imageUrl = $data['imageUrl'];

    // Tạo nội dung HTML
    $htmlContent = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta property="og:title" content="LipIce gửi lời mời tới ' . htmlspecialchars($name) . '!" />
        <meta property="og:description" content="' . htmlspecialchars($name) . ' có hẹn với Lọ Lem!" />
        <meta property="og:image" content="' . htmlspecialchars($imageUrl) . '" />
        <meta property="og:url" content="https://20.189.113.224/share?name=' . urlencode($name) . '&image=' . urlencode($imageUrl) . '" />
        <title>Lời mời từ ' . htmlspecialchars($name) . '</title>
        <!-- Chuyển hướng ngay lập tức -->
        <script>
            window.location.href = "https://lipice-event.com.vn";
        </script>
    </head>
    <body>
        <h1>' . htmlspecialchars($name) . ' có hẹn với Lọ Lem!</h1>
    </body>
    </html>
    ';

    // Tạo file HTML và lưu lại
    $filePath = '../uploadshare/invite_' . time() . '.html';
    if (file_put_contents($filePath, $htmlContent)) {
        echo json_encode(['status' => 'success', 'htmlUrl' => $filePath]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Không thể tạo file HTML']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Dữ liệu không hợp lệ']);
}
?>
