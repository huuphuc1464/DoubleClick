@extends('layout')

@section('title', 'Nhập Sách')

@section('content')
<section>

    <div class="container">
        <h1>Quản Lý Nhập Sách</h1>

        <!-- Form nhập hàng -->
        <form id="importForm">
            <div class="form-group">
                <label for="bookCode">Mã sách:</label>
                <input type="text" id="bookCode" placeholder="Nhập mã sách" required>
            </div>
            <div class="form-group">
                <label for="bookName">Tên sách:</label>
                <input type="text" id="bookName" placeholder="Nhập tên sách" required>
            </div>
            <div class="form-group">
                <label for="author">Tác giả:</label>
                <input type="text" id="author" placeholder="Nhập tên tác giả" required>
            </div>
            <div class="form-group">
                <label for="quantity">Số lượng:</label>
                <input type="number" id="quantity" placeholder="Nhập số lượng" required>
            </div>
            <div class="form-group">
                <label for="price">Giá nhập:</label>
                <input type="number" id="price" placeholder="Nhập giá nhập" required>
            </div>
            <div class="form-group">
                <label for="category">Thể loại:</label>
                <input type="text" id="category" placeholder="Nhập thể loại sách" required>
            </div>
            <div class="form-group">
                <label for="bookImage">Hình ảnh:</label>
                <input type="file" id="bookImage" accept="image/*">
            </div>
            <button type="submit">Thêm Sách</button>
        </form>

        <!-- Bảng danh sách nhập sách -->
        <h2>Danh Sách Sách Nhập</h2>
        <table id="bookTable">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã Sách</th>
                    <th>Tên Sách</th>
                    <th>Tác Giả</th>
                    <th>Số Lượng</th>
                    <th>Giá Nhập</th>
                    <th>Thể Loại</th>
                    <th>Hình Ảnh</th>
                    <th>Ghi Chú</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <!-- Các dòng dữ liệu sẽ được thêm vào đây -->
            </tbody>
        </table>

        <!-- Nút Duyệt Tổng -->
        <button id="approveAll">Duyệt Tổng</button>
        <button id="saveData">Upload</button>

        <!-- Tổng số lượng -->
        <div class="total">
            <strong>Tổng Số Lượng:</strong> <span id="totalQuantity">0</span>
            <br>
            <strong>Tổng Giá Trị Nhập:</strong> <span id="totalValue">0</span> VND
        </div>
    </div>

    <script src="/js/script.js"></script>
    <script>// DOM elements
        const importForm = document.getElementById("importForm");
        const bookTableBody = document.querySelector("#bookTable tbody");
        const totalQuantitySpan = document.getElementById("totalQuantity");
        const totalValueSpan = document.getElementById("totalValue");
        const approveAllBtn = document.getElementById("approveAll");
        const saveDataBtn = document.getElementById("saveData");

        // Variables to track totals
        let totalQuantity = 0;
        let totalValue = 0;
        let bookIndex = 0;

        // Handle form submission
        importForm.addEventListener("submit", (e) => {
            e.preventDefault();

            // Get form data
            const bookCode = document.getElementById("bookCode").value;
            const bookName = document.getElementById("bookName").value;
            const author = document.getElementById("author").value;
            const quantity = parseInt(document.getElementById("quantity").value);
            const price = parseFloat(document.getElementById("price").value);
            const category = document.getElementById("category").value;
            const bookImageInput = document.getElementById("bookImage");
            const bookImageFile = bookImageInput.files[0];

            // Process image
            let imageHTML = "-";
            if (bookImageFile) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imageHTML = `<img src="${e.target.result}" alt="${bookName}" style="width: 50px;">`;
                    const lastRow = bookTableBody.lastChild;
                    lastRow.querySelector(".image-cell").innerHTML = imageHTML;
                };
                reader.readAsDataURL(bookImageFile);
            }

            // Create table row
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${++bookIndex}</td>
                <td>${bookCode}</td>
                <td>${bookName}</td>
                <td>${author}</td>
                <td>${quantity}</td>
                <td>${price.toLocaleString()} VND</td>
                <td>${category}</td>
                <td class="image-cell">${imageHTML}</td>
                <td><input type="text" placeholder="Ghi chú..."></td>
                <td>
                    <button onclick="deleteRow(this)">Xóa</button>
                </td>
            `;
            bookTableBody.appendChild(row);

            // Update totals
            totalQuantity += quantity;
            totalValue += quantity * price;
            updateTotals();

            // Reset form
            importForm.reset();
        });

        // Update total quantity and value
        function updateTotals() {
            totalQuantitySpan.textContent = totalQuantity;
            totalValueSpan.textContent = totalValue.toLocaleString() + " VND";
        }

        // Delete a row
        function deleteRow(button) {
            const row = button.parentElement.parentElement;
            const quantity = parseInt(row.children[4].textContent);
            const price = parseFloat(row.children[5].textContent.replace(/,/g, "").replace(" VND", ""));
            totalQuantity -= quantity;
            totalValue -= quantity * price;

            row.remove();
            updateTotals();
        }

        // Handle approve all
        approveAllBtn.addEventListener("click", () => {
            const rows = bookTableBody.querySelectorAll("tr");
            if (rows.length === 0) {
                alert("Không có sản phẩm để duyệt!");
                return;
            }

            rows.forEach((row) => {
                const bookName = row.children[2].textContent;
                const notes = row.children[8].querySelector("input").value || "Không có ghi chú";
                console.log(`Duyệt: ${bookName} - Ghi chú: ${notes}`);
            });
            alert("Duyệt thành công!");
        });

        // Handle save data
        saveDataBtn.addEventListener("click", () => {
            const rows = bookTableBody.querySelectorAll("tr");
            const data = [];
            rows.forEach((row) => {
                const book = {
                    code: row.children[1].textContent,
                    name: row.children[2].textContent,
                    author: row.children[3].textContent,
                    quantity: parseInt(row.children[4].textContent),
                    price: parseFloat(row.children[5].textContent.replace(/,/g, "").replace(" VND", "")),
                    category: row.children[6].textContent,
                    notes: row.children[8].querySelector("input").value || "Không có ghi chú",
                };
                data.push(book);
            });

            console.log("Data to save:", data);
            alert("Dữ liệu đã được lưu!");
        });
        </script>
</section>
