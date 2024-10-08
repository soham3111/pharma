<?php
include "includes/head.php"
?>

<body>

  <div class="site-wrap">

    <?php
    include "includes/header.php";
    $data = get_user($_SESSION['user_id']);
    ?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0">
            <a href="index.php">Home</a> <span class="mx-2 mb-0">/</span>
            <strong class="text-black">Checkout</strong>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6">

            <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Delivery Details</h2>
                <div class="p-3 p-lg-5 border">
                  <table class="table site-block-order-table mb-5">
                    <thead>
                      <th>Customer Details</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>First Name </td>
                        <td><?php echo $data[0]['user_fname'] ?></td>
                      </tr>
                      <tr>
                        <td>Last Name </td>
                        <td><?php echo $data[0]['user_lname'] ?></td>
                      </tr>
                      <tr>
                        <td>Email </td>
                        <td><?php echo $data[0]['email'] ?></td>
                      </tr>
                      <tr>
                        <td>Address </td>
                        <td><?php echo $data[0]['user_address'] ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>
          <div class="col-md-6">

            <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Your Order</h2>
                <div class="p-3 p-lg-5 border">
                  <table class="table site-block-order-table mb-5">
                    <thead>
                      <th>Product</th>
                      <th>Total</th>
                    </thead>
                    <tbody>
                      <?php
                      if (!empty($_SESSION['cart'])) {
                        $data = get_cart();
                        $num = sizeof($data);
                        for ($i = 0; $i < $num; $i++) {
                          if (isset($data[$i])) {
                      ?>
                            <tr>
                              <td><?php echo $data[$i][0]['item_title'] ?><strong class="mx-2">x</strong><?php echo $_SESSION['cart'][$i]['quantity'] ?></td>
                              <td>₹<?php echo ($data[$i][0]['item_price'] * $_SESSION['cart'][$i]['quantity'])  ?></td>
                            </tr>
                      <?php
                          }
                        }
                      }
                      ?>
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
                        <td class="text-black">₹<?php echo total_price($data) ?></td>
                      </tr>
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Delivery Fees</strong></td>
                        <td class="text-black">₹<?php echo delivery_fees($data) ?></td>
                      </tr>
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                        <td class="text-black font-weight-bold"><strong>₹<?php echo delivery_fees($data) + total_price($data) ?></strong></td>
                      </tr>
                    </tbody>
                  </table>

                  <!-- Button to trigger modal -->
                  <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#paymentModal">
                    Enter Payment Details
                  </button>

                  <!-- Payment Modal -->
                  <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="paymentModalLabel">Payment Details</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="process_payment.php" method="POST" id="payment-form">
                            <div class="form-group">
                              <label for="card_number">Card Number</label>
                              <input type="text" class="form-control" id="card_number" name="card_number" required>
                            </div>
                            <div class="form-group">
                              <label for="expiry_date">Expiry Date (MM/YY)</label>
                              <input type="text" class="form-control" id="expiry_date" name="expiry_date" required>
                            </div>
                            <div class="form-group">
                              <label for="cvv">CVV</label>
                              <input type="text" class="form-control" id="cvv" name="cvv" required>
                            </div>
                            <div class="form-group">
                              <button type="submit" class="btn btn-primary btn-block">Pay Now</button>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End of Payment Modal -->

                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <?php
    include "includes/footer.php"
    ?>
  </div>

  <!-- Bootstrap and jQuery scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

</body>

</html>
