document.addEventListener('DOMContentLoaded', function () {
    const saveButton = document.getElementById('savePaymentMethod');
    const selectedPayment = document.getElementById('selectedPayment');
    const paymentRadios = document.querySelectorAll('input[name="paymentMethod"]');
    const paymentMethodInput = document.getElementById('paymentMethod');

    const provinceSelect = document.getElementById("provinceSelect");
    const districtSelect = document.getElementById("districtSelect");
    const wardSelect = document.getElementById("wardSelect");
    const shippingFeeElement = document.getElementById("shippingFee");
    const cartSum = parseInt(document.getElementById("subtotal").value.replace('đ', '').replace(/\./g, '').trim());
    const totalPriceElement = document.getElementById("totalPrice");
    const discountAmountElement = document.getElementById("discountAmount");

    let shippingFee = 0;
    let discountAmount = 0;

    // Cập nhật phí vận chuyển
    function updateShippingFee() {
        const selectedProvince = provinceSelect.value;
        shippingFee = (selectedProvince === '79') ? 25000 : 35000;
        shippingFeeElement.value = (shippingFee === 25000) ? '25000đ' : '35000đ';
        updateTotalPrice();
    }

    // Cập nhật tổng tiền
    function updateTotalPrice() {
        const totalWithShipping = cartSum + shippingFee - discountAmount;
        totalPriceElement.value = `${totalWithShipping.toLocaleString()}đ`;
    }

    fetch("https://provinces.open-api.vn/api/p/")
    .then(response => {
        if (!response.ok) {
            throw new Error('Failed to load provinces data');
        }
        return response.json();
    })
    .then(data => {
        data.forEach(province => provinceSelect.add(new Option(province.name, province.code)));
    })
    .catch(error => {
        console.error("Error fetching provinces:", error);
    });

    function updateSelectOptions(selectElement, options) {
        selectElement.innerHTML = '<option value="" selected>Chọn</option>';
        options.forEach(option => {
            const newOption = new Option(option.name, option.code);
            selectElement.add(newOption);
        });
    }

    provinceSelect.addEventListener("change", function () {
        districtSelect.disabled = true;
        wardSelect.disabled = true;

        if (this.value) {
            fetch(`https://provinces.open-api.vn/api/p/${this.value}?depth=2`)
                .then(response => response.json())
                .then(data => {
                    updateSelectOptions(districtSelect, data.districts);
                    districtSelect.disabled = false;
                })
                .catch(error => {
                    console.error('Error fetching districts:', error);
                });
        }

        // Cập nhật phí vận chuyển
        updateShippingFee();
    });

    districtSelect.addEventListener("change", function () {
        wardSelect.disabled = true;

        if (this.value) {
            fetch(`https://provinces.open-api.vn/api/d/${this.value}?depth=2`)
                .then(response => response.json())
                .then(data => {
                    updateSelectOptions(wardSelect, data.wards);
                    wardSelect.disabled = false;
                })
                .catch(error => {
                    console.error('Error fetching wards:', error);
                });
        }
    });

    // Xử lý chọn voucher
    const saveVoucherBtn = document.getElementById("saveVoucher");
    const selectedVoucherElement = document.getElementById("selectedVoucher");
    const checkboxes = document.querySelectorAll('input[name="voucher"]');

    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', function () {
            checkboxes.forEach((item) => {
                if (item !== checkbox) item.checked = false;
            });
        });
    });

    saveVoucherBtn.addEventListener("click", function () {
        const selectedVoucherCheckbox = document.querySelector('input[name="voucher"]:checked');
        if (selectedVoucherCheckbox) {
            const discount = parseFloat(selectedVoucherCheckbox.getAttribute('data-discount'));
            const discountType = selectedVoucherCheckbox.getAttribute('data-type');
            const voucherName = selectedVoucherCheckbox.closest('.voucher-card').querySelector('h6').innerText;

            selectedVoucherElement.innerHTML = `<span>${voucherName} - Giảm: ${discountType === 'percent' ? discount + '%' : discount + ' VNĐ'}</span>`;
            discountAmount = (discount <= 100) ? (cartSum * discount) / 100 : discount;

            discountAmountElement.value = discountAmount.toLocaleString() + 'đ';

            updateTotalPrice();
        } else {
            selectedVoucherElement.innerHTML = "<span>Không có voucher được chọn</span>";
            discountAmountElement.value = '0đ';
            discountAmount = 0;
            updateTotalPrice();
        }
    });

    // Xử lý input số điện thoại
    document.getElementById('phoneInput').addEventListener('input', function() {
        const phoneInput = this.value;
        const phoneError = document.getElementById('phoneError');
        const phonePattern = /^[0-9]{10}$/;

        if (phonePattern.test(phoneInput)) {
            phoneError.style.display = 'none';
            this.style.borderColor = '';
        } else {
            phoneError.style.display = 'block';
            this.style.borderColor = 'red';
        }
    });

    // Xử lý input địa chỉ
    document.getElementById('addressInput').addEventListener('input', function() {
        const addressInput = this.value;
        const addressError = document.getElementById('addressError');

        if (addressInput.length <= 50) {
            addressError.style.display = 'none';
            this.style.borderColor = '';
        } else {
            addressError.style.display = 'block';
            this.style.borderColor = 'red';
        }
    });

    document.getElementById('submitOrder').addEventListener('click', function() {
        // Lấy giá trị của các trường
        const customerAddress = document.getElementById('addressInput').value.trim();
        const phoneInput = document.getElementById('phoneInput').value.trim();
        const paymentMethodValue = document.querySelector('input[name="paymentMethod"]:checked')?.value;
        const shippingFeeValue = document.getElementById('shippingFee').value.replace('đ', '').replace(',', '') || 0;
        const totalPriceValue = document.getElementById('totalPrice').value.replace('đ', '').replace(',', '') || 0;
        const discountAmountValue = document.getElementById('discountAmount').value.replace('đ', '').replace(',', '') || 0;
        const voucherValue = document.querySelector('input[name="voucher"]:checked')?.value || '';
    
        // Kiểm tra các trường hợp cần thiết
        if (!phoneInput || !customerAddress || !paymentMethodValue || !provinceSelect.value || !districtSelect.value || !wardSelect.value) {
            alert("Vui lòng nhập đầy đủ thông tin!");
            return;
        }
    
        // Lấy tên tỉnh, quận, xã thay vì mã
        const provinceName = provinceSelect.options[provinceSelect.selectedIndex].text;
        const districtName = districtSelect.options[districtSelect.selectedIndex].text;
        const wardName = wardSelect.options[wardSelect.selectedIndex].text;
    
        // Gán các tên vào các trường ẩn trong form
        document.getElementById('provinceName').value = provinceName;
        document.getElementById('districtName').value = districtName;
        document.getElementById('wardName').value = wardName;
    
        // Gán các giá trị vào các trường ẩn trong form
        document.getElementById('MaTK').value = document.querySelector('input[name="MaTK"]').value;
        document.getElementById('phone').value = phoneInput;
        document.getElementById('address').value = customerAddress;
        document.getElementById('voucher').value = voucherValue;
        document.getElementById('paymentMethod').value = paymentMethodValue;
        document.getElementById('note').value = document.getElementById('note').value;
        document.getElementById('subtotal').value = document.getElementById('subtotal').value.replace('đ', '').replace(',', '');
        document.getElementById('discountAmount').value = discountAmountValue;
        document.getElementById('shippingFee').value = shippingFeeValue;
        document.getElementById('totalPrice').value = totalPriceValue;
    
        // Submit form tự động
        document.getElementById('checkoutForm').submit();
    });
    
});
