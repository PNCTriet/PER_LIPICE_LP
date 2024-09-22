<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Admin Dashboard</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody id="data-table-body">
                <!-- Dữ liệu sẽ được chèn vào đây -->
            </tbody>
        </table>
    </div>

    <script>
        // Hàm để hiển thị dữ liệu
        function displayData(data) {
            const tableBody = document.getElementById('data-table-body');
            tableBody.innerHTML = ''; // Xóa dữ liệu cũ

            data.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.name}</td>
                    <td>${item.phone}</td>
                    <td>${new Date(item.timestamp).toLocaleString()}</td>
                `;
                tableBody.appendChild(row);
            });
        }

        // Đọc dữ liệu từ file data.json
        fetch('./bstrpssw/data.json')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                displayData(data);
            })
            .catch(error => {
                console.error('There has been a problem with your fetch operation:', error);
            });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
