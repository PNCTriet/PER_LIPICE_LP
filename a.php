<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <title>Landing Page</title>
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
            background-color: #f8f9fa;
        }

        .container {
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .image-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .image-container img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .form-container {
            flex: 1;
            padding: 10%;
        }


        h2 {
            text-align: left;
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="tel"] {
            width: 80%;
            padding: 10px;
            font-size: 16px;
            /* Đảm bảo font size là 16px */
            box-sizing: border-box;
        }

        button#submitButton {
            font-family: "MyFont", sans-serif;
            justify-content: center;
            box-shadow: 0px 0px 0px #ffffff;
            border: 0px;
            background: linear-gradient(to right, #b3edfc, #fbd3f5);
            box-shadow: 0px 4px 6px hsla(240, 40%, 90%, 0.7);
            width: 80%;
            align-items: center;
            justify-content: center;
            padding: 15px;
            color: #ff34ac;
            font-size: 0.8rem;
        }

        button#submitButton::after {
            content: "";
            position: absolute;
            inset: 0;
            background-color: linear-gradient(to right, #b3edfc, #fbd3f5);
            z-index: -1;
            transform: translateX(-100%);
            transition: transform 250ms;
        }

        @media (max-width: 500px) {
            .container {
                flex-direction: column;
            }

            .image-container {
                order: 1;
                /* Đảm bảo hình ảnh nằm trên cùng trong mobile */
            }

            .form-container {
                order: 2;
                /* Đảm bảo form nằm dưới hình ảnh trong mobile */
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="image-container">
            <img src="homemb.svg" alt="Placeholder Image" />
        </div>
        <div class="form-container">
            <form id="infoForm">
                <h2>Tên mình là:</h2>
                <input type="text" id="nameInput" placeholder="Nhập tên của bạn..." required class="form-control mb-3" />
                <h2>SĐT của mình:</h2>
                <input type="tel" id="phoneInput" placeholder="Nhập SĐT của bạn..." required class="form-control mb-3" />
                <button type="submit" id="submitButton" class="btn btn-primary">
                    Nhận thiệp mời từ Lọ Lem nha!
                </button>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="invitationModal" tabindex="-1" aria-labelledby="invitationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="invitationModalLabel">Thiệp mời</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Cảm ơn bạn đã đăng ký! Thiệp mời sẽ được gửi đến bạn.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('infoForm').onsubmit = function(event) {
            event.preventDefault(); // Ngăn không cho form gửi đi
            const modal = new bootstrap.Modal(document.getElementById('invitationModal'));
            modal.show(); // Hiển thị modal
        };
    </script>
</body>

</html>