<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />
  <!-- Các thẻ meta khác -->
  <link rel="icon" type="image/png" sizes="64x64" href="../images/metalogo.png" />
  <meta property="og:title" content="LIPICE CÙNG LỌ LEM" />
  <meta property="og:description" content="LIPICE - Bạn có thư từ Lọ Lem!" />
  <meta
    property="og:image"
    content="https://scontent.fsgn7-2.fna.fbcdn.net/v/t39.30808-6/461186112_1731572460716082_3650692345729793542_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=833d8c&_nc_ohc=xl_wib6kswEQ7kNvgG7iI9v&_nc_ht=scontent.fsgn7-2.fna&_nc_gid=AXBalDBMeCGE2mnA1uI408T&oh=00_AYBePHuyM2DVN-Mc88abrjB95Y9DEY6anQS7uPzd1Trtew&oe=66F864B2" />
  <meta
    property="og:url"
    content="https://lipice-event.com.vn" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet" />
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
  <link rel="stylesheet" href="css/style.css" />
  <title>Bạn có hẹn cùng Lọ Lem</title>
  <style>
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
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: white;
    }

    .containerfr {
      display: flex;
      align-items: center;
      background-color: #fff;
      width: 100%;
      height: auto;
      padding: 0;
    }

    .form-containerfr {
      flex: 1;
      padding: 10%;
      align-items: center;
      justify-content: center;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 15px;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-size: 16px;
    }

    input[type="text"],
    input[type="email"] {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      box-sizing: border-box;
    }

    /* Image styling */
    .image-containerfr {
      flex: 2;
      display: flex;
      align-items: center;
      object-fit: contain;
    }

    .image-containerfr img {

      height: auto;
      width: 100%;
      max-height: 100vh;
      object-fit: contain;
    }

    @media (max-width: 900px) {
      h1 {
        font-size: 20px;
      }

      button {
        font-size: 16px;
        padding: 10px;
      }

      .containerfr {
        padding: 5%;
      }
    }

    /* Responsive for mobile */
    @media (max-width: 600px) {
      #infoForm {
        font-size: 16px;
      }

      .containerfr {
        flex-direction: column;
      }

      .form-containerfr {
        padding: 15px;
      }

      .image-containerfr {
        justify-content: center;
        margin-bottom: 5px;
      }

      input[type="text"] {
        font-size: 16px;
      }

      button {
        font-size: 16px;
        padding: 10px;
      }
    }
  </style>
</head>

<body>

  <!-- Load Facebook SDK for JavaScript -->
  <div id="fb-root"></div>
  <script>
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s);
      js.id = id;
      js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>

  <div class="containerfr">
    <div class="image-containerfr">
      <img src="homemb.svg" alt="Placeholder Image" />
    </div>
    <div class="form-containerfr">
      <form id="infoForm">
        <h1>Tên mình là:</h1>
        <input
          type="text"
          id="nameInput"
          placeholder="Nhập tên của bạn..."
          required
          class="form-control mb-3" />
        <h1>SĐT của mình:</h1>
        <input
          type="text"
          id="phoneInput"
          placeholder="Nhập SĐT của bạn..."
          required
          class="form-control mb-3" />
        <button
          type="submit"
          id="submitButton"
          class="button"
          style="margin-top: 10%">
          Nhận thiệp mời từ Lọ Lem nha!
          <img
            src="search.svg"
            style="margin-left: 10px"
            alt="Search Icon"
            width="30"
            height="30" />
        </button>
      </form>
    </div>
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

        </div>

        <div class="modal-body">
          <img id="invitationImage" src="" alt="Invitation" />
        </div>

        <div class="modal-footer" style="justify-content: center">
          <div class="button-container">
            <button class="button" id="downloadButton">
              <img
                src="download.svg"
                alt="Download"
                style="
                    width: 35px;
                    height: 35px;
                    margin-right: 3px;
                    margin-left: 3px;
                  " />
              Download
            </button>
            <button class="button" id="shareButton">
              <img src="share.svg" alt="Share" style="margin-right: 15%" />
              Share
            </button>
            <div class="text-container">
              <p style="font-size: calc(0.6rem + 0.4vw); color: #0026a4">
                CHIA SẺ THIỆP MỜI ĐỂ CÓ CƠ HỘI NHẬN QUÀ NHÉ!
              </p>
            </div>
            <p id="message" style="font-size: calc(0.6rem + 0.5vw); color: #1977f1;"></p>
            <div id="fbShareButton"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0"></script>
  <script>
    function isFacebookApp() {
      const userAgent = navigator.userAgent || navigator.vendor || window.opera;
      return /fb|facebook|messenger/i.test(userAgent);
    }
    document.addEventListener("DOMContentLoaded", function() {
      const messageElement = document.getElementById('message');
      if (isFacebookApp()) {
        var pp = document.getElementById("shareButton");
        pp.style.display = "none";
        messageElement.innerText = "Bạn đang trong chế độ Facebook Webview, hãy sử dụng nút share ở bên dưới nhé!";
      } else {
        //messageElement.innerText = "Bạn đang truy cập trang này từ trình duyệt khác!";
      }
    });
  </script>
  <script src="./js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <!-- Include Bootstrap JS and dependencies (if not included already) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>