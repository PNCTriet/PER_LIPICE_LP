<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData, true);

    // Đọc nội dung hiện tại của file data.json
    $file = './bstrpssw/data.json';
    if (file_exists($file)) {
        $currentData = json_decode(file_get_contents($file), true);
    } else {
        $currentData = [];
    }

    // Thêm dữ liệu mới
    $currentData[] = $data;

    // Ghi lại vào file data.json
    file_put_contents($file, json_encode($currentData, JSON_PRETTY_PRINT));

    // Phản hồi lại
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
