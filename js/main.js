let savedName = "";
let savedUrl = "";
document.getElementById("infoForm").addEventListener("submit", function (e) {
  e.preventDefault();

  document.body.style.zoom = "100%"; // Đặt lại zoom
  document.body.style.transform = "translateX(0)"; // Đặt lại vị

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

  // Kiểm tra ràng buộc tên (không quá 11 ký tự)
  if (name.length > 11) {
    alert("Tên không được quá 11 ký tự!");
    return; // Dừng lại nếu tên không hợp lệ
  }

  // Kiểm tra ràng buộc số điện thoại (phải là số và có đúng 10 ký tự)
  const phonePattern = /^0[0-9]{9}$/;
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

                // Bắt đầu xử lý tạo trang chia sẻ ngay sau khi tải lên thành công
                createSharePage(uploadedImageUrl, name);

                // Kiểm tra sự hiện diện của nút Facebook Share
                setTimeout(checkFbShareButtonVisibility, 1000); // Tăng thời gian delay

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

  // Hàm tạo trang chia sẻ
  function createSharePage(imageUrl, name) {
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
          const customShareUrl = `https://lipice-event.com.vn/${data.htmlUrl}`;
          savedUrl = customShareUrl; // Lưu URL chia sẻ

          // Tạo nút chia sẻ Facebook
          var shareButtonHTML = `<div class="fb-share-button" data-href="${customShareUrl}" data-layout="button" data-size="large"></div>`;

          // Chèn nút chia sẻ vào modal
          document.getElementById("fbShareButton").innerHTML = shareButtonHTML;

          // Khởi tạo Facebook SDK với nút mới
          FB.XFBML.parse();
        } else {
          alert("Có lỗi xảy ra khi tạo trang chia sẻ!");
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        alert("Có lỗi xảy ra khi gửi yêu cầu tạo trang chia sẻ!");
      });
  }

  // Hàm kiểm tra sự hiện diện của nút Facebook Share
  function checkFbShareButtonVisibility() {
    var fbShareButton = document.querySelector(".fb-share-button");
    var shareButton = document.getElementById("shareButton");

    if (
      fbShareButton &&
      fbShareButton.offsetWidth > 0 &&
      fbShareButton.offsetHeight > 0 &&
    ) {
      // Nút Facebook Share đã xuất hiện -> ẩn nút "here"
      shareButton.style.display = "none";
      //alert("Nút Facebook Share đang hiển thị. Nút 'here' đã được ẩn.");
    } else {
      // Nút Facebook Share chưa xuất hiện -> hiển thị nút "here"
      shareButton.style.display = "inline-block";
      //alert("Nút Facebook Share không hiển thị. Nút 'here' đang hiển thị.");
    }
  }
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

// Đảm bảo rằng Facebook SDK đã được thêm vào trang
window.fbAsyncInit = function () {
  FB.init({
    appId: "1047271863230415", // Thay bằng App ID của bạn từ Facebook Developer
    xfbml: true,
    version: "v20.0", // Phiên bản của SDK
  });
};

document.getElementById("shareButton").addEventListener("click", function () {
  const customShareUrl = savedUrl;
  // Thay vì mở tab mới, sử dụng Facebook SDK để chia sẻ
  FB.ui(
    {
      method: "share",
      href: customShareUrl,
    },
    function (response) {
      if (response && !response.error_message) {
        console.log("Chia sẻ thành công!");
        // Đóng modal
        var myModal = bootstrap.Modal.getInstance(
          document.getElementById("invitationModal")
        );
        myModal.hide();
      } else {
        alert("Có lỗi xảy ra khi chia sẻ!");
      }
    }
  );
});
