<?php
$data = json_decode(file_get_contents('php://input'), true);
$imageData = $data['imageData'];

if (isset($imageData)) {
    // Loại bỏ phần đầu 'data:image/png;base64,'
    $imageData = str_replace('data:image/png;base64,', '', $imageData);
    $imageData = str_replace(' ', '+', $imageData);
    $image = base64_decode($imageData);

    // Tạo đường dẫn và tên file
    $imageName = uniqid() . '.png';
    $filePath = '../uploads/' . $imageName;

    // Lưu file
    if (file_put_contents($filePath, $image)) {
        // Trả về đường dẫn ảnh đã tải lên
        echo json_encode(['status' => 'success', 'imageUrl' => $filePath]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Lỗi khi lưu hình ảnh.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Không nhận được dữ liệu hình ảnh.']);
}
?>
