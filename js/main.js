let savedName = "";
document.getElementById("infoForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const name = document.getElementById("nameInput").value;
  const phone = document.getElementById("phoneInput").value;

  // Lưu tên vào biến cục bộ
  savedName = name;

  // Tạo đối tượng để lưu trữ thông tin
  const userInfo = {
    name: name,
    phone: phone,
    timestamp: Date.now(), // Thêm thời gian lưu dữ liệu
  };

  // Kiểm tra điều kiện để chuyển trang
  if (name === "admin@$" && phone === "1232343451") {
    // Fetch data from users.json
    fetch("./bstrpssw/user.json")
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
            window.location.href = "index.html"; // Quay về trang chính
          }, sessionDuration);

          // Chuyển đến trang bảo mật
          window.location.href = "bstrpssw/tables.html";
        } else {
          alert("Thông tin không hợp lệ. Vui lòng thử lại.");
        }
      })
      .catch((error) => console.error("Error:", error));
    return; // Dừng lại không thực hiện các hành động khác
  }

  // Kiểm tra ràng buộc tên (không quá 7 ký tự)
  if (name.length > 11) {
    alert("Tên không được quá 11 ký tự!");
    return; // Dừng lại nếu tên không hợp lệ
  }

  // Kiểm tra ràng buộc số điện thoại (phải là số và có đúng 10 ký tự)
  const phonePattern = /^[0-9]{10}$/;
  if (!phonePattern.test(phone)) {
    alert("Số điện thoại phải là số hợp lệ và có 10 chữ số!");
    return; // Dừng lại nếu số điện thoại không hợp lệ
  }

  // Gửi thông tin người dùng đến server
  fetch("../php/save_data.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(userInfo),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "success") {
        // Nếu lưu thành công, tiếp tục tạo hình ảnh
        const img = new Image();
        img.src = "../images/c.png"; // Đường dẫn đến hình ảnh của bạn

        img.onload = function () {
          const canvas = document.createElement("canvas");
          canvas.width = img.width;
          canvas.height = img.height;
          const ctx = canvas.getContext("2d");

          // Vẽ hình ảnh lên canvas
          ctx.drawImage(img, 0, 0);

          // Thêm đoạn "${name} ơi!" lên canvas
          ctx.font = "110pt NewFont";
          ctx.fillStyle = "#36b1ad";
          ctx.fillText(`${name} ơi!`, 335, 430);

          ctx.font = "50pt NewFont";
          ctx.fillStyle = "#ff0298";
          ctx.fillText(`${name} có hẹn với Lọ Lem nè!`, 180, 535);

          // Chuyển canvas thành URL hình ảnh
          const image = canvas.toDataURL("image/png", 1.0);

          // Gửi hình ảnh đến máy chủ
          fetch("../php/upload_image.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({ imageData: image }),
          })
            .then((response) => response.json())
            .then((data) => {
              if (data.status === "success") {
                const uploadedImageUrl = data.imageUrl;

                // Lưu URL hình ảnh đã tải lên để sử dụng cho chia sẻ
                window.uploadedImageUrl = uploadedImageUrl;

                // Hiển thị modal với hình ảnh đã tải lên
                document.getElementById("invitationImage").src =
                  uploadedImageUrl;
                var myModal = new bootstrap.Modal(
                  document.getElementById("invitationModal")
                );
                myModal.show();

                // Xóa dữ liệu form
                document.getElementById("infoForm").reset();
              } else {
                alert("Có lỗi xảy ra khi tải ảnh lên máy chủ!");
              }
            })
            .catch((error) => {
              console.error("Error:", error);
              alert("Có lỗi xảy ra khi tải ảnh lên máy chủ!");
            });
        };
      } else {
        alert("Có lỗi xảy ra khi lưu thông tin!");
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      alert("Có lỗi xảy ra khi gửi dữ liệu!");
    });
});

// Xử lý sự kiện cho nút tải về
document
  .getElementById("downloadButton")
  .addEventListener("click", function () {
    const image = document.getElementById("invitationImage").src;
   

    const link = document.createElement("a");
    link.href = image;
    link.download = "invitation_edited.jpg";
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  });

  document.getElementById("shareButton").addEventListener("click", function () {
    const name = window.inviteeName || savedName; // Lấy tên người dùng
    const imageUrl = window.uploadedImageUrl || ""; // Đường dẫn của hình ảnh đã tải lên
  
    if (imageUrl) {
      // Gửi yêu cầu đến máy chủ để tạo file HTML mới
      fetch("../php/createsharepage.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ name: name, imageUrl: imageUrl }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.status === "success") {
            const customShareUrl = `http://20.189.113.224/${data.htmlUrl}`;
            const facebookShareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(customShareUrl)}`;
  
            // Mở tab mới để chia sẻ nội dung lên Facebook
            window.open(facebookShareUrl, "_blank");
          } else {
            alert("Có lỗi xảy ra khi tạo trang chia sẻ!");
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          alert("Có lỗi xảy ra khi gửi yêu cầu tạo trang chia sẻ!");
        });
    } else {
      alert("Chưa có hình ảnh để chia sẻ!");
    }
  });
  
  