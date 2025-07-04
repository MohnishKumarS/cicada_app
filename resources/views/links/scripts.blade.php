{{-- jquery --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{ asset('lib/vendors/toast-popup/toast.script.js') }}"></script>

@if (session('toast'))
    <script>
        $.Toast("{{ session('toast') }}", "{{ session('text') }}", "{{ session('type') }}", {
            has_icon: true,
            has_close_btn: true,
            position_class: 'toast-top-right',
            stack: true,
            fullscreen: false,
            timeout: 6000,
            sticky: false,
            has_progress: true,
            rtl: false,
        });
    </script>
@endif


<script>
    updateCartCount();

    function buyNow(productId) {
        const sizeInputExists = $('input[name="size"]').length > 0; // Check if size inputs exist
        const size = $('input[name="size"]:checked').val();
        const colorInputExists = $('input[name="color"]').length > 0; // Check if color inputs exist
        const color = $('input[name="color"]:checked').val();
        const quantity = $('#quantity').val();


        if (colorInputExists && !color) {
            $.Toast("Hooray!", "Please select a color", "error", {
                timeout: 6000,
                has_progress: true,
            });
            return;
        }
        if (sizeInputExists && !size) {
            $.Toast("Oops!", "Please select a size", "error", {
                timeout: 6000,
                has_progress: true,
            });
            return;
        }

        const productDetails = {
            product_id: productId,
            size: size,
            color: color,
            quantity: parseInt(quantity),
            product_name: $('.product__title').text(),
            product_price: $('.price-sell').text().trim().replace(/[^\d]/g, ''),
            product_image: $('#productImage').attr('src')
        };

        $.ajax({
            url: '/buy-it-now',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productDetails.product_id,
                size: productDetails.size,
                color: productDetails.color,
                quantity: productDetails.quantity,
                product_name: productDetails.product_name,
                product_price: productDetails.product_price,
                product_image: productDetails.product_image
            },
            success: function(res) {
                console.log(res);
                if (res.status == 'success') {
                    window.location.href = "/checkout";
                } else {
                    $.Toast("Oops!", "Please login to continue", "error", {
                        timeout: 6000,
                        has_progress: true,
                    });
                    setTimeout(function() {
                        window.location.href = "/login";
                    }, 1200);
                }
                // updateCartCount();
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function addToCart(productId) {
        const sizeInputExists = $('input[name="size"]').length > 0; // Check if size inputs exist
        const size = $('input[name="size"]:checked').val();
        const colorInputExists = $('input[name="color"]').length > 0; // Check if color inputs exist
        const color = $('input[name="color"]:checked').val();
        const quantity = $('#quantity').val();


        if (colorInputExists && !color) {
            $.Toast("Hooray!", "Please select a color", "error", {
                timeout: 6000,
                has_progress: true,
            });
            return;
        }
        if (sizeInputExists && !size) {
            $.Toast("Oops!", "Please select a size", "error", {
                timeout: 6000,
                has_progress: true,
            });
            return;
        }

        const productDetails = {
            product_id: productId,
            size: size,
            color: color,
            quantity: parseInt(quantity),
            product_name: $('.product__title').text(),
            product_price: $('.price-sell').text().trim().replace(/[^\d]/g, ''),
            product_image: $('#productImage').attr('src')
        };

        $.ajax({
            url: '/add-to-cart',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productDetails.product_id,
                size: productDetails.size,
                color: productDetails.color,
                quantity: productDetails.quantity,
                product_name: productDetails.product_name,
                product_price: productDetails.product_price,
                product_image: productDetails.product_image
            },
            success: function(response) {
                console.log(response.message);
                updateCartCount();
                showProductAddedMessageInModal(productDetails);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function showProductAddedMessageInModal(productDetails) {

        $('#modalProductImage').attr('src', productDetails.product_image);
        $('#modalProductName').text(productDetails.product_name);
        $('#modalProductSize').text(`Size: ${productDetails.size}`);
        if (productDetails.color) {
            $('#modalProductColor').text(`Color: ${productDetails.color}`).show();
        } else {
            $('#modalProductColor').hide();
        }
        $('#modalProductColor').text(`Color: ${productDetails.color}`);
        $('#cartCount').text(`Quantity: ${productDetails.quantity}`);
        $('#viewCartModal').modal('show');

    }

    function removeItemFromCart(productId, size, color) {
        var t_row = $("#" + productId + '-' + size + '-' + color);
        $.ajax({
            url: '/remove-item-from-cart',
            type: 'POST',
            data: {
                product_id: productId,
                size: size,
                color: color,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // console.log(response);

                if (response.status === 'success') {
                    t_row.remove();
                    console.log('Item removed from cart');
                    updateCartCount();
                    updateCartTotal(response.cart);
                    $('.ccd--cart').load(location.href + ' .ccd--cart');
                }
            },
            error: function(xhr, status, error) {
                console.error('Failed to remove item:', error);
            }
        });
    }

    function CartQuantityChange(element, quantityChange) {
        const productId = element.dataset.productId;
        const size = element.dataset.size || '';
        const color = element.dataset.color || '';
        const input = element.closest('.input-group').querySelector('.cart-quantity');
        let value = parseInt(input.value);
        const min = input.getAttribute('min') ? parseInt(input.getAttribute('min')) : 1;
        const max = input.getAttribute('max') ? parseInt(input.getAttribute('max')) : 10;

        value = value + quantityChange;

        if (value >= min && value <= max) {
            input.value = value;
        } else {
            return;
        }

        $.ajax({
            url: '/update-cart-quantity',
            method: 'POST',
            data: {
                product_id: productId,
                size: size,
                color: color,
                quantity: input.value,
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                if (response.status === 'success') {
                    var cart = response.cart;
                    console.log(cart);
                    // Update individual item total price
                    const $totalPriceElement = $(element)
                        .closest('.cart-item')
                        .find('.cart-item__tprice');


                    $totalPriceElement.html(`Rs. ${response.item_total_price.toLocaleString()}`);

                    updateCartTotal(cart);
                    updateCartCount(cart);
                    // $('.ccd--cart').load(location.href + ' .ccd--cart');

                }
            },
            error: function(xhr, status, error) {
                console.error("Error updating cart:", error);
            }
        });
    }


    function updateCartTotal(cart) {
        let total = 0;
        cart.forEach(item => {
            let itemTotal = parseFloat(item.product_price) * parseInt(item.quantity);
            total += itemTotal;
        });
        $(".cart__total-price").html('Rs. ' + total.toLocaleString());
    }

    function updateCartCount(cart) {
        $.get('/get-cart', function(cart) {
            let cartCount = cart.reduce((total, item) => total + parseInt(item.quantity), 0);
            console.log("cartCount" + cartCount);
            $(".ccd-cart__num").html(cartCount);
            if (cartCount === 0) {
                $(".ccd-cart__num").html('0');
            }
        });
    }
</script>
