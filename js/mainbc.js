let savedName = "";
let savedUrl = "";

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
            window.location.href = "https://lipice-event.com.vn/"; // Quay về trang chính
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
        img.src = "../images/c.png"; // Đường dẫn đến hình ảnh chính của bạn

        img.onload = function () {
          // Canvas đầu tiên - Không có background (hiển thị trên modal)
          const canvasWithoutBackground = document.createElement("canvas");
          canvasWithoutBackground.width = img.width;
          canvasWithoutBackground.height = img.height;
          const ctxWithoutBackground = canvasWithoutBackground.getContext("2d");

          // Vẽ hình ảnh chính lên canvas không có background
          ctxWithoutBackground.drawImage(img, 0, 0);

          // Thêm đoạn "${name} ơi!" lên canvas không có background
          ctxWithoutBackground.font = "110pt NewFont";
          ctxWithoutBackground.fillStyle = "#36b1ad";
          ctxWithoutBackground.fillText(`${name} ơi!`, 335, 430);

          ctxWithoutBackground.font = "50pt NewFont";
          ctxWithoutBackground.fillStyle = "#ff0298";
          ctxWithoutBackground.fillText(
            `${name} có hẹn với Lọ Lem nè!`,
            180,
            535
          );

          // Chuyển canvas không có background thành URL hình ảnh
          const imageWithoutBackground = canvasWithoutBackground.toDataURL(
            "image/png",
            1.0
          );

          // Hiển thị modal với hình ảnh không có background
          document.getElementById("invitationImage").src =
            imageWithoutBackground;
          var myModal = new bootstrap.Modal(
            document.getElementById("invitationModal")
          );
          myModal.show();

          // Khi modal hiển thị, reset form và xóa canvas không có background
          myModal._element.addEventListener("shown.bs.modal", function () {
            // Xóa dữ liệu form
            document.getElementById("infoForm").reset();

            // Xóa canvas không có background khỏi DOM
            canvasWithoutBackground.remove();
          });

          // Canvas thứ hai - Có background (dùng cho tạo trang chia sẻ)
          const canvasWithBackground = document.createElement("canvas");
          canvasWithBackground.width = img.width;
          canvasWithBackground.height = img.height;
          const ctxWithBackground = canvasWithBackground.getContext("2d");

          // Tạo một đối tượng hình nền
          const background = new Image();
          background.src = "../images/bg.png"; // Đường dẫn đến ảnh nền của bạn

          background.onload = function () {
            // Vẽ hình nền lên canvas có background
            ctxWithBackground.drawImage(
              background,
              0,
              0,
              canvasWithBackground.width,
              canvasWithBackground.height
            );

            // Vẽ hình ảnh chính lên canvas có background
            ctxWithBackground.drawImage(img, 0, 0);

            // Thêm đoạn "${name} ơi!" lên canvas có background
            ctxWithBackground.font = "110pt NewFont";
            ctxWithBackground.fillStyle = "#36b1ad";
            ctxWithBackground.fillText(`${name} ơi!`, 335, 430);

            ctxWithBackground.font = "50pt NewFont";
            ctxWithBackground.fillStyle = "#ff0298";
            ctxWithBackground.fillText(
              `${name} có hẹn với Lọ Lem nè!`,
              180,
              535
            );

            // Chuyển canvas có background thành URL hình ảnh
            const imageWithBackground = canvasWithBackground.toDataURL(
              "image/png",
              1.0
            );

            // Gửi hình ảnh có background đến máy chủ
            fetch("../php/upload_image.php", {
              method: "POST",
              headers: {
                "Content-Type": "application/json",
              },
              body: JSON.stringify({ imageData: imageWithBackground }),
            })
              .then((response) => response.json())
              .then((data) => {
                if (data.status === "success") {
                  const uploadedImageUrl = data.imageUrl;

                  // Lưu URL hình ảnh đã tải lên để sử dụng cho chia sẻ
                  window.uploadedImageUrl = uploadedImageUrl;
                  console.log("Custom Share URL:", uploadedImageUrl);

                  // Bắt đầu xử lý tạo trang chia sẻ ngay sau khi tải lên thành công
                  createSharePage(uploadedImageUrl, name);

                  // Xóa dữ liệu form
                  document.getElementById("infoForm").reset();
                } else {
                  //alert("Có lỗi xảy ra khi tải ảnh lên máy chủ!");
                }
              })
              .catch((error) => {
                console.error("Error:", error);
                //alert("Có lỗi xảy ra khi tải ảnh lên máy chủ!");
              });
          };
        };
      } else {
        //alert("Có lỗi xảy ra khi lưu thông tin!");
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      //alert("Có lỗi xảy ra khi gửi dữ liệu!");
    });

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
        if (window.innerWidth < 400) {
          // Kiểm tra nếu màn hình có chiều rộng nhỏ hơn 400px
          if (data.status === "success") {
            const customShareUrl = `https://lipice-event.com.vn/${data.htmlUrl}`;
            savedUrl = customShareUrl;
            // Tạo nút chia sẻ Facebook
            var shareButtonHTML = `
            <div class="fb-share-button" data-href="${customShareUrl}" data-layout="button" data-size="large"></div>`;
            document.getElementById("fbShareButton").innerHTML =
              shareButtonHTML;
            FB.XFBML.parse();
          } else {
            // Thông báo lỗi nếu cần
            // alert("Có lỗi xảy ra khi tạo trang chia sẻ!");
          }
        } else {
          console.log(
            "Chiều rộng màn hình lớn hơn hoặc bằng 400px, không chạy đoạn mã."
          );
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        //alert("Có lỗi xảy ra khi gửi yêu cầu tạo trang chia sẻ!");
      });
  }
});

// Xử lý sự kiện cho nút tải về
document
  .getElementById("downloadButton")
  .addEventListener("click", function () {
    const image = document.getElementById("invitationImage").src;

    const link = document.createElement("a");
    link.href = image;
    link.download = "invitation_edited";
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  });

// Đảm bảo rằng Facebook SDK đã được thêm vào trang
window.fbAsyncInit = function() {
  FB.init({
      appId: '1047271863230415', // ID ứng dụng của bạn
      cookie: true,
      xfbml: true,
      version: 'v10.0'
  });
};
document.getElementById("shareButton").addEventListener("click", function () {
  const customShareUrl = savedUrl;
  // Log giá trị customShareUrl ra console để kiểm tra
  console.log("Custom Share URL:", customShareUrl);

  // Thay vì mở tab mới, sử dụng Facebook SDK để chia sẻ
  FB.ui(
    {
      display: "popup",
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
        //alert("Có lỗi xảy ra khi chia sẻ!");
      }
    }
  );
});
