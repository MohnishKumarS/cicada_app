<!--   Core JS Files   -->
<script src="{{ asset('admin/assets/js/core/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/core/bootstrap.min.js') }}"></script>

<!-- jQuery Scrollbar -->
<script src="{{ asset('admin/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

<!-- Chart JS -->
<script src="{{ asset('admin/assets/js/plugin/chart.js/chart.min.js') }}"></script>

<!-- jQuery Sparkline -->
<script src="{{ asset('admin/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Chart Circle -->
<script src="{{ asset('admin/assets/js/plugin/chart-circle/circles.min.js') }}"></script>

<!-- Datatables -->
<script src="{{ asset('admin/assets/js/plugin/datatables/datatables.min.js') }}"></script>

<!-- Bootstrap Notify -->
{{-- <script src="{{ asset('admin/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script> --}}

<!-- jQuery Vector Maps -->
<script src="{{ asset('admin/assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/plugin/jsvectormap/world.js') }}"></script>

<!-- Sweet Alert -->
{{-- <script src="{{ asset('admin/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script> --}}

<!-- Kaiadmin JS -->
<script src="{{ asset('admin/assets/js/kaiadmin.min.js') }}"></script>
{{-- select2 --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src="{{ asset('admin/assets/js/setting-demo.js') }}"></script>
<script src="{{ asset('admin/assets/js/demo.js') }}"></script>
<script>
      $(document).ready(function() {
        $('#size').select2();
    });
    $(document).ready(function () {
      $("#brandsTable").DataTable({});
      $("#categoriesTable").DataTable({});
      $("#productsTable").DataTable({});

    });
  </script>

<script>

  // ##== For Brand scripts
 
    $(".brand-status").click(function(){
      var brandId = $(this).data('id');
      var currentStatus = $(this).data('status');
      var newStatus = currentStatus == 1 ? 0 : 1; 
     console.log(brandId, currentStatus, newStatus)
     
      $.ajax({
          url: '{{ url("/brands/brand-status") }}/' + brandId,
          type: 'POST',
          data: {
              _token: '{{ csrf_token() }}',
              brand_status: newStatus
          },
          success: function(response) {
              if (response.success) {
                  if (newStatus == 1) {
                      $(this).removeClass('btn-danger').addClass('btn-success');
                      $(this).text('Active');
                  } else {
                      $(this).removeClass('btn-success').addClass('btn-danger');
                      $(this).text('Inactive');
                  }
                  $(this).data('status', newStatus); 
              }
          }.bind(this),
          error: function() {
              alert('An error occurred while updating the status.');
          }
      });
  });
  $(".delete-brand").click(function(){
    var brandId = $(this).data('id');
    var userURL = $(this).data('url');
    var trObj = $(this);

    if (confirm("Are you sure you want to delete this brand?") == true) {
        $.ajax({
            url: userURL,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(data) {
                console.log(data); 
                if (data.success) {       
                    $('#brand-row-' + brandId).fadeOut(500, function() {
                        $(this).remove();
                    });
                    $('#delete-message').html('<div class="alert alert-success">Brand deleted successfully!</div>');
                    $('#table-id').DataTable().ajax.reload();
                } else {
                    $('#delete-message').html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText); 
                $('#delete-message').html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
            }
        });
    }
});
  // ##== For category scripts
  $(".category-status").click(function(){
    var categoryId = $(this).data('id');
      var currentStatus = $(this).data('status');
      var newStatus = currentStatus == 1 ? 0 : 1; 
     console.log(categoryId, currentStatus, newStatus)
     
      $.ajax({
          url: '{{ url("/category/category-status") }}/' + categoryId,
          type: 'POST',
          data: {
              _token: '{{ csrf_token() }}',
              status: newStatus
          },
          success: function(response) {
              if (response.success) {
                  if (newStatus == 1) {
                      $(this).removeClass('btn-danger').addClass('btn-success');
                      $(this).text('Active');
                  } else {
                      $(this).removeClass('btn-success').addClass('btn-danger');
                      $(this).text('Inactive');
                  }
                  $(this).data('status', newStatus); 
              }
          }.bind(this),
          error: function() {
              alert('An error occurred while updating the status.');
          }
      });
  })
  


$(".delete-category").click(function(){
  var categoryId = $(this).data('id');
    var userURL = $(this).data('url');
    var trObj = $(this);
    $.ajax({
            url: userURL,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(data) {
                console.log(data); 
                if (data.success) {       
                    $('#category-row-' + categoryId).fadeOut(500, function() {
                        $(this).remove();
                    });
                    $('#categoryTable-msg').html('<div class="alert alert-success">category deleted successfully!</div>');
                    $('#table-id').DataTable().ajax.reload();
                } else {
                    $('#categoryTable-msg').html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText); 
                $('#categoryTable-msg').html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
            }
        });

})
  // ## == For product scripts

  $(".product-status").click(function(){
    var productId = $(this).data('id');
      var currentStatus = $(this).data('status');
      var newStatus = currentStatus == 1 ? 0 : 1; 
     console.log(productId, currentStatus, newStatus)
     
      $.ajax({
          url: '{{ url("/product/product-status") }}/' + productId,
          type: 'POST',
          data: {
              _token: '{{ csrf_token() }}',
              status: newStatus
          },
          success: function(response) {
              if (response.success) {
                  if (newStatus == 1) {
                      $(this).removeClass('btn-danger').addClass('btn-success');
                      $(this).text('Active');
                  } else {
                      $(this).removeClass('btn-success').addClass('btn-danger');
                      $(this).text('Inactive');
                  }
                  $(this).data('status', newStatus); 
              }
          }.bind(this),
          error: function() {
              alert('An error occurred while updating the status.');
          }
      });
  })

  $(".delete-product").click(function(){
  var productId = $(this).data('id');
    var userURL = $(this).data('url');
    var trObj = $(this);
    $.ajax({
            url: userURL,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(data) {
                console.log(data); 
                if (data.success) {       
                    $('#product-row-' + productId).fadeOut(500, function() {
                        $(this).remove();
                    });
                    $('#productTable-msg').html('<div class="alert alert-success">product deleted successfully!</div>');
                    $('#table-id').DataTable().ajax.reload();
                } else {
                    $('#productTable-msg').html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText); 
                $('#productTable-msg').html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
            }
        });

})

// Add to cart

// function addToCart(productId) {
//     alert("tyy")
//     const quantity = document.querySelector('input[name="quantity"]').value; // Get the quantity
//     const selectedSize = document.querySelector('input[name="size"]:checked').value; // Get the selected size

//     fetch("{{ route('cart.add') }}", {
//         method: "POST",
//         headers: {
//             "Content-Type": "application/json",
//             "X-CSRF-TOKEN": "{{ csrf_token() }}"
//         },
//         body: JSON.stringify({
//             product_id: productId,
//             quantity: quantity,
//             size: selectedSize // Send the selected size
//         })
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.success) {
//             // Populate modal with product details
//             document.getElementById('modalProductName').innerText = data.product_name;
//             document.getElementById('modalProductSize').innerText = `Size: ${data.product_size}`;
//             document.getElementById('modalProductImage').src = data.product_image;

//             // Update cart count
//             document.getElementById('cartCount').innerText = data.cart_count; // Update this as needed

//             // Show the modal
//             const viewCartModal = new bootstrap.Modal(document.getElementById('viewCartModal'));
//             viewCartModal.show();
//         } else {
//             console.error(data.message); // Log any error messages
//         }
//     })
//     .catch(error => {
//         console.error('Error:', error);
//     });
// }

</script>