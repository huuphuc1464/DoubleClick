    //Modal Hình thức thanh toán
    document.addEventListener('DOMContentLoaded', function () {
    const saveButton = document.getElementById('savePaymentMethod');
    const selectedPayment = document.getElementById('selectedPayment');
    const paymentRadios = document.querySelectorAll('input[name="paymentMethod"]');

    saveButton.addEventListener('click', function () {
        const selected = Array.from(paymentRadios).find(radio => radio.checked);
        if (selected) {
            const label = selected.nextElementSibling.innerHTML;
            selectedPayment.innerHTML = label;
        }
        const modal = bootstrap.Modal.getInstance(document.getElementById('paymentModal'));
        modal.hide();
    });
});
///
document.addEventListener("DOMContentLoaded", function () {
    const provinceSelect = document.getElementById("provinceSelect");
    const districtSelect = document.getElementById("districtSelect");
    const wardSelect = document.getElementById("wardSelect");
    const shippingFeeElement = document.getElementById("shippingFee");

    // Lấy tổng giá trị giỏ hàng từ phần tử subtotal trong HTML
    const cartSum = parseInt(document.getElementById("subtotal").innerText.replace('đ', '').replace(/\./g, '').trim());
    const totalPriceElement = document.getElementById("totalPrice"); // Hiển thị thành tiền sau khi giảm
    const discountAmountElement = document.getElementById("discountAmount"); // Hiển thị giá trị giảm giá

    let shippingFee = 0;
    let discountAmount = 0;

    // Lấy danh sách tỉnh/thành phố
    fetch("https://provinces.open-api.vn/api/p/").then(response => response.json())
        .then(data => {
            data.forEach(province => {
                const option = new Option(province.name, province.code);
                provinceSelect.add(option);
            });
        });

    // Cập nhật phí vận chuyển
    function updateShippingFee() {
        const selectedProvince = provinceSelect.value;
        if (selectedProvince === '79') {  // Mã tỉnh TP Hồ Chí Minh là '79'
            shippingFee = 25000;
            shippingFeeElement.innerText = '25.000đ';
        } else {
            shippingFee = 35000;  // Khác TP HCM
            shippingFeeElement.innerText = '35.000đ';
        }
        updateTotalPrice();  // Cập nhật lại tổng tiền sau khi thay đổi địa chỉ
    }

    // Cập nhật total giá trị
    function updateTotalPrice() {
        const totalWithShipping = cartSum + shippingFee - discountAmount;
        totalPriceElement.innerText = `${totalWithShipping.toLocaleString()}đ`;
    }

    provinceSelect.addEventListener("change", function () {
        districtSelect.innerHTML = '<option value="" selected>Chọn quận/huyện</option>';
        wardSelect.innerHTML = '<option value="" selected>Chọn xã/phường</option>';
        districtSelect.disabled = true;
        wardSelect.disabled = true;

        const selectedProvinceCode = this.value;

        if (selectedProvinceCode) {
            fetch(`https://provinces.open-api.vn/api/p/${selectedProvinceCode}?depth=2`)
                .then(response => response.json())
                .then(data => {
                    data.districts.forEach(district => {
                        const option = new Option(district.name, district.code);
                        districtSelect.add(option);
                    });
                    districtSelect.disabled = false;
                });
        } else {
            districtSelect.disabled = true;
        }

        updateShippingFee();  // Cập nhật phí vận chuyển khi chọn địa chỉ
    });

    districtSelect.addEventListener("change", function () {
        wardSelect.innerHTML = '<option value="" selected>Chọn xã/phường</option>';
        wardSelect.disabled = true;

        const selectedDistrictCode = this.value;

        if (selectedDistrictCode) {
            fetch(`https://provinces.open-api.vn/api/d/${selectedDistrictCode}?depth=2`)
                .then(response => response.json())
                .then(data => {
                    data.wards.forEach(ward => {
                        const option = new Option(ward.name, ward.code);
                        wardSelect.add(option);
                    });
                    wardSelect.disabled = false;
                });
        } else {
            wardSelect.disabled = true;
        }
    });

    const saveVoucherBtn = document.getElementById("saveVoucher");
    const selectedVoucherElement = document.getElementById("selectedVoucher");

    // Khi modal mở, dọn dẹp việc chọn checkbox
    const checkboxes = document.querySelectorAll('input[name="voucher"]');
    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', function () {
            // Khi một checkbox được chọn, bỏ chọn các checkbox còn lại
            checkboxes.forEach((item) => {
                if (item !== checkbox) {
                    item.checked = false;
                }
            });
        });
    });

    // Lưu voucher được chọn
    saveVoucherBtn.addEventListener("click", function () {
        const selectedVoucherCheckbox = document.querySelector('input[name="voucher"]:checked');

        // Kiểm tra nếu có voucher được chọn
        if (selectedVoucherCheckbox) {
            const voucherCode = selectedVoucherCheckbox.value;
            const discount = parseFloat(selectedVoucherCheckbox.getAttribute('data-discount'));
            const discountType = selectedVoucherCheckbox.getAttribute('data-type');
            const voucherName = selectedVoucherCheckbox.closest('.voucher-card').querySelector('h6').innerText;

            // Hiển thị voucher đã chọn
            selectedVoucherElement.innerHTML = `<span>${voucherName} - Giảm: ${discountType === 'percent' ? discount + '%' : discount + ' VNĐ'}</span>`;

            // Tính toán giảm giá
            if (discountType === 'percent') {
                discountAmount = (cartSum * discount) / 100;  // Giảm theo phần trăm
            } else {
                discountAmount = discount;  // Giảm theo giá tiền cố định
            }

            discountAmountElement.innerText = discountAmount.toLocaleString() + 'đ';

            // Cập nhật lại total khi có voucher
            updateTotalPrice();

            // Đóng modal sau khi chọn voucher
            const modal = document.getElementById("voucherModal");
            const modalBootstrap = bootstrap.Modal.getInstance(modal);
            modalBootstrap.hide();
        } else {
            // Nếu không có voucher nào được chọn
            selectedVoucherElement.innerHTML = "<span>Không có voucher được chọn</span>";
            discountAmountElement.innerText = '0đ';
            discountAmount = 0;

            // Cập nhật lại total không có giảm giá
            updateTotalPrice();
        }
    });
});