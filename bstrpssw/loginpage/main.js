document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Ngăn chặn form gửi mặc định

    const name = document.getElementById("AccInput").value;
    const phone = document.getElementById("PassInput").value;

    // Kiểm tra điều kiện để chuyển trang
      fetch("./account31072001.json")
        .then((response) => response.json())
        .then((users) => {
          const user = users.find((u) => u.name === name && u.phone === phone);
          if (user) {
            // Lưu thông tin vào sessionStorage
            sessionStorage.setItem("user", JSON.stringify(user));

            // Thiết lập thời gian phiên làm việc (ví dụ: 5 phút = 300000 ms)
            const sessionDuration = 300000; // 5 phút
            setTimeout(() => {
              sessionStorage.removeItem("user"); // Xóa thông tin người dùng
              alert("Phiên làm việc đã hết hạn. Vui lòng đăng nhập lại.");
              window.location.href = "https://lipice-event.com.vn/"; // Quay về trang chính
            }, sessionDuration);

            // Chuyển đến trang bảo mật
            window.location.href = "../tables.html";
          } else {
            alert("Thông tin không hợp lệ. Vui lòng thử lại.");
          }
        })
        .catch((error) => console.error("Error:", error));
  });