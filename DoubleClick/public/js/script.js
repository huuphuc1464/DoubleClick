// DOM elements
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
