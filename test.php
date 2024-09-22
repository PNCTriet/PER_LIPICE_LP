<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Các thẻ meta khác -->
  <meta property="og:title" content="LIPICE CÙNG LỌ LEM" />
  <meta property="og:description" content="LIPICE - Bạn có thư từ Lọ Lem!" />
  <meta property="og:image" content="https://scontent.fsgn5-8.fna.fbcdn.net/v/t39.30808-6/448722170_1663438000862862_1557279869197611499_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=6ee11a&_nc_ohc=Oahe1yOkAuQQ7kNvgHQr-FI&_nc_ht=scontent.fsgn5-8.fna&oh=00_AYBsgzkVd9X9_cGzCGLb4KbQGAMh5lR7YTSyPJ_U_XpA9w&oe=66F59F61" />
  <meta property="og:url" content="https://netflop.xyz" />


  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet" />
  <title>Landing Page</title>
  <style>
    /* Font-face declarations for custom fonts */
    @font-face {
      font-family: "MyFont";
      src: url("fonts/Matahari-700Bold.ttf") format("truetype");
    }

    @font-face {
      font-family: "NewFont";
      src: url("fonts/Matahari-800ExtraBold.ttf") format("truetype");
    }

    body {
      font-family: "NewFont", sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-image: url("./a.png");
      background-size: cover;
      background-position: center;
      overflow: hidden;
    }

    .containerr {
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      margin-left: 55%;
      width: 30%;
    }

    input {
      margin: 10px auto;
      padding: 10px;
      width: 90%;
      height: 55px;
      border: none;
      background-color: #f0f0f0;
      border-radius: 5px;
      display: block;
      font-size: 15px;
    }

    /* Button style */
    button {
      display: flex;
      justify-content: flex-start;
      align-items: center;
      padding: 10px;
      background-color: white;
      cursor: pointer;
      box-shadow: 0px 5px 0px #0026a4;
      border: 2px solid #0026a4;
      border-radius: 10px;
      position: relative;
      overflow: hidden;
      z-index: 100;
      transition: box-shadow 250ms, transform 250ms, filter 50ms;
    }

    .button-container {
      display: flex;
      justify-content: center;
      /* Căn giữa theo chiều ngang */
      gap: 20px;
      /* Khoảng cách giữa các nút */
      flex-wrap: wrap;
      /* Đảm bảo rằng các button sẽ xuống hàng khi không đủ chỗ */
      padding-bottom: 5%;
      margin-left: 4%;
      /* Sử dụng % để margin responsive */
    }

    #shareButton,
    #downloadButton {
      font-size: 20pt;
      font-family: "NewFont", sans-serif;
      padding: 10px 10px;
    }

    button#downloadButton,
    button#shareButton {
      font-size: calc(0.8rem + 0.5vw);
      /* Tăng cường tính responsive cho font-size */
      font-family: "NewFont", sans-serif;
      /* Áp dụng font tùy chỉnh */
      width: 35vw;
      /* Tính tỷ lệ width dựa trên viewport width */
      height: auto;
      /* Đặt chiều cao tự động */
      padding: calc(0.5rem + 0.5vw) 1rem;
      /* Thêm padding để tạo không gian */
      max-width: 180px;
      /* Giới hạn tối đa cho width */
      max-height: 30px;
      /* Giới hạn tối đa cho height */
      min-width: 140px;
      /* Giới hạn tối thiểu cho width */
      min-height: calc(30px + 1rem);
      /* Thiết lập height tối thiểu để đảm bảo có không gian */
      display: flex;
      /* Căn giữa nội dung trong button */
      justify-content: center;
      /* Căn giữa theo chiều ngang */
      align-items: center;
      /* Căn giữa theo chiều dọc */
      box-sizing: border-box;
      /* Đảm bảo padding và border không làm thay đổi kích thước */
    }


    #downloadButton {
      color: #0026a4;
    }

    button#shareButton {
      background-color: #0026a4;
      box-shadow: 0px 4px 0px white, 0px 6px 0px 0px #0026a4;
      /* Bóng trắng nằm trên, viền xanh nằm dưới */
      border: 2px solid #0026a4;
      color: white;
    }

    button#CloseButton {
      content: "";
      position: absolute;
      inset: 0;

      z-index: -1;
      transform: translateX(-100%);
      transition: transform 250ms;
    }

    button:hover {
      transform: translate(2px, 2px);
      box-shadow: 2px 3px 0px #0026a4;
    }

    button:active {
      filter: saturate(0.75);
    }

    button::after {
      content: "";
      position: absolute;
      inset: 0;
      background-color: white;
      z-index: -1;
      transform: translateX(-100%);
      transition: transform 250ms;
    }

    button#shareButton::after {
      content: "";
      position: absolute;
      inset: 0;
      background-color: #0026a4;
      z-index: -1;
      transform: translateX(-100%);
      transition: transform 250ms;
    }

    button:hover::after {
      transform: translateX(0);
    }

    .bgContainer {
      position: relative;
      display: flex;
      justify-content: start;
      align-items: center;
      overflow: hidden;
      max-width: 50%;
      /* Adjust based on button text */
      font-size: 1.5em;
      font-weight: 600;
    }

    .bgContainer span {
      position: relative;
      transform: scale(1);
      transition: transform 250ms;
    }

    .button:hover .bgContainer>span {
      transform: scale(1.1);
      /* Slight scale on hover */
    }

    .arrowContainer {
      padding: 1em;
      margin-inline-end: 1em;
      border: 4px solid;
      border-radius: 50%;
      background-color: #ff7be3;
      position: relative;
      overflow: hidden;
      transition: transform 250ms, background-color 250ms;
      z-index: 100;
    }

    .arrowContainer::after {
      content: "";
      position: absolute;
      inset: 0;
      border-radius: inherit;
      background-color: white;
      transform: translateX(-100%);
      z-index: -1;
      transition: transform 250ms ease-in-out;
    }

    button:hover .arrowContainer::after {
      transform: translateX(0);
    }

    button:hover .arrowContainer {
      transform: translateX(5px);
    }

    button:active .arrowContainer {
      transform: translateX(8px);
    }

    .arrowContainer svg {
      vertical-align: middle;
    }

    #invitation {
      margin-top: 20px;
      display: none;
      font-size: 18px;
      color: #333;
    }

    .modal-content {
      background-image: url("./bg.png");
      background-size: cover;
      position: relative;
      overflow: hidden;
    }

    .modal-body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
      padding: 0%;
    }

    #invitationImage {
      max-width: 75%;
      height: auto;
    }

    /* Tắt viền phân cách giữa modal header và body */
    .modal-header {
      border-bottom: none;
    }

    /* Tắt viền phân cách giữa modal body và footer */
    .modal-footer {
      border-top: none;
      padding: 0% 0% 0% 12%;
      font-size: 20%;
    }

    .no-scroll {
      overflow: hidden;
      /* Vô hiệu hóa cuộn */
    }

    .text-container {
      display: flex;
      /* Sử dụng Flexbox */
      justify-content: center;
      /* Căn giữa theo trục X */
      align-items: center;
      /* Căn giữa theo trục Y */
      margin-bottom: 0%;
      margin-top: 2%;
    }
  </style>
</head>

<body>
  <div class="containerr">
    <h1>Tên mình là:</h1>
    <form id="infoForm">
      <input type="text" id="nameInput" placeholder="Nhập tên của bạn..." required class="form-control mb-3" />
      <h1>SĐT của mình:</h1>
      <input type="text" id="phoneInput" placeholder="Nhập số điện thoại của bạn..." required class="form-control mb-3" />
      <button type="submit" class="button">Nhận thiệp mời từ Lọ Lem nha!</button>
    </form>
  </div>


  <!-- Modal -->
  <div
    class="modal fade"
    id="invitationModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title visually-hidden" id="exampleModalLabel">
            Thiệp mời
          </h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
            id="CloseButton"></button>
        </div>

        <div class="modal-body">
          <img id="invitationImage" src="" alt="Invitation" />
        </div>

        <div class="modal-footer" style="justify-content: flex-start">
          <div class="button-container">
            <button class="button" id="downloadButton">
              <img src="download.svg" alt="Download" style="width: 35px; height: 35px; margin-right: 3px; margin-left: 3px; ">
              Download
            </button>

            <button class="button" id="shareButton">
              <img src="share.svg" alt="Share" style="margin-right: 15%">
              Share
            </button>
            <div class="text-container">
              <p style="font-size: calc(0.6rem + 0.5vw); color: #0026a4;">CHIA SẺ THIỆP MỜI ĐỂ CÓ CƠ HỘI NHẬN QUÀ NHÉ!</p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>


  <script>
    document.getElementById("infoForm").addEventListener("submit", function(e) {
      e.preventDefault();

      const name = document.getElementById("nameInput").value;
      const phone = document.getElementById("phoneInput").value;

      // Tạo đối tượng để lưu trữ thông tin
      const userInfo = {
        name: name,
        phone: phone,
        timestamp: Date.now() // Thêm thời gian lưu dữ liệu
      };

      // Kiểm tra ràng buộc tên (không quá 7 ký tự)
      if (name.length > 7) {
        alert("Tên không được quá 7 ký tự!");
        return; // Dừng lại nếu tên không hợp lệ
      }

      // Kiểm tra ràng buộc số điện thoại (phải là số và có đúng 10 ký tự)
      const phonePattern = /^[0-9]{10}$/;
      if (!phonePattern.test(phone)) {
        alert("Số điện thoại phải là số hợp lệ và có 10 chữ số!");
        return; // Dừng lại nếu số điện thoại không hợp lệ
      }

      // Gửi thông tin người dùng đến server
      fetch('save_data.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(userInfo),
        })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            // Nếu lưu thành công, tiếp tục tạo hình ảnh
            const img = new Image();
            img.src = "c.png"; // Đường dẫn đến hình ảnh của bạn

            img.onload = function() {
              const canvas = document.createElement("canvas");
              canvas.width = img.width;
              canvas.height = img.height;
              const ctx = canvas.getContext("2d");

              // Vẽ hình ảnh lên canvas
              ctx.drawImage(img, 0, 0);

              // Thêm đoạn "${name} ơi!" lên canvas
              ctx.font = "115pt NewFont";
              ctx.fillStyle = "#36b1ad";
              ctx.fillText(`${name} ơi!`, 335, 430);

              ctx.font = "60pt NewFont";
              ctx.fillStyle = "#ff0298";
              ctx.fillText(`${name} có hẹn với Lọ Lem nè!`, 180, 535);

              // Chuyển canvas thành URL hình ảnh
              const image = canvas.toDataURL("image/png", 1.0);

              // Hiển thị hình ảnh trong modal
              document.getElementById("invitationImage").src = image;

              // Hiển thị modal
              var myModal = new bootstrap.Modal(document.getElementById("invitationModal"));
              myModal.show();

              // Lưu giá trị của name để dùng sau
              window.inviteeName = name;

              // Xóa dữ liệu trong form
              document.getElementById("infoForm").reset();
            };
          } else {
            alert("Có lỗi xảy ra khi lưu thông tin!");
          }
        })
        .catch((error) => {
          console.error('Error:', error);
          alert("Có lỗi xảy ra khi gửi dữ liệu!");
        });
    });




    // Xử lý sự kiện cho nút tải về
    document
      .getElementById("downloadButton")
      .addEventListener("click", function() {
        const image = document.getElementById("invitationImage").src;

        const link = document.createElement("a");
        link.href = image;
        link.download = "invitation_edited.jpg";
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
      });

    document
      .getElementById("shareButton")
      .addEventListener("click", function() {
        const urlToShare = 'https://gody.vn/blog/trietnguyenpham7087#ban-do-viet-nam'; // URL muốn chia sẻ
        const facebookShareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(urlToShare)}`;
        window.open(facebookShareUrl, '_blank'); // Mở một tab mới với liên kết chia sẻ
      });
  </script>
</body>

</html>