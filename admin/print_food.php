<?php
session_start();
if(!isset($_SESSION["user"])) {
    header("location:index.php");
}

include('db.php');

if(isset($_GET['pid'])) {
    $payment_id = mysqli_real_escape_string($con, $_GET['pid']);
    
    // Get payment details
    $payment_sql = "SELECT * FROM food_payments WHERE id = '$payment_id'";
    $payment_result = mysqli_query($con, $payment_sql);
    $payment = mysqli_fetch_array($payment_result);
    
    // Get payment items
    $items_sql = "SELECT * FROM food_payment_items WHERE payment_id = '$payment_id'";
    $items_result = mysqli_query($con, $items_sql);
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OCEAN VIEW HOTEL - Food Order Bill</title>
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <style>
        @media print {
            .no-print { display: none; }
            body { margin: 0; }
            .print-content { padding: 20px; }
        }
        
        .bill-header {
            text-align: center;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .bill-details {
            margin-bottom: 30px;
        }
        
        .bill-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        
        .bill-table th,
        .bill-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        
        .bill-table th {
            background-color: #2c3e50;
            color: white;
        }
        
        .total-section {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border: 2px solid #2c3e50;
        }
        
        .print-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="print-content">
        <div class="bill-header">
            <h1 style="color: #2c3e50; margin-bottom: 10px;">OCEAN VIEW HOTEL</h1>
            <h3 style="color: #ffce14; margin-bottom: 5px;">Kalpitiya Beach Hotel</h3>
            <p style="margin-bottom: 5px;">Kalpitiya Beach Side, 1km from Kalpitiya Town, Sri Lanka</p>
            <p style="margin-bottom: 5px;">Phone: +94 (32)225-8800 | Email: info@oceanviewhotel.com</p>
            <h2 style="color: #2c3e50; margin-top: 20px;">FOOD ORDER BILL</h2>
        </div>

        <?php if(isset($payment)): ?>
        <div class="bill-details">
            <div class="row">
                <div class="col-md-6">
                    <strong>Bill No:</strong> FOB-<?php echo str_pad($payment['id'], 4, '0', STR_PAD_LEFT); ?><br>
                    <strong>Customer:</strong> <?php echo $payment['customer_name']; ?><br>
                    <strong>Email:</strong> <?php echo $payment['customer_email']; ?>
                </div>
                <div class="col-md-6 text-right">
                    <strong>Order Date:</strong> <?php echo date('Y-m-d H:i', strtotime($payment['order_date'])); ?><br>
                    <strong>Print Date:</strong> <?php echo date('Y-m-d H:i'); ?><br>
                    <strong>Status:</strong> <span style="color: <?php echo $payment['payment_status'] == 'paid' ? 'green' : 'orange'; ?>;"><?php echo ucfirst($payment['payment_status']); ?></span>
                </div>
            </div>
        </div>

        <table class="bill-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Unit Price (LKR)</th>
                    <th>Total (LKR)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $grand_total = 0;
                while($item = mysqli_fetch_array($items_result)):
                    $grand_total += $item['total_price'];
                ?>
                <tr>
                    <td><?php echo $item['food_name']; ?></td>
                    <td><?php echo $item['category']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php echo number_format($item['unit_price'], 2); ?></td>
                    <td><?php echo number_format($item['total_price'], 2); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="total-section">
            <div style="font-size: 24px; color: #2c3e50;">
                GRAND TOTAL: LKR <?php echo number_format($grand_total, 2); ?>
            </div>
        </div>

        <div style="text-align: center; margin-top: 40px; font-style: italic; color: #666;">
            <p>Thank you for choosing Ocean View Hotel!</p>
            <p>We hope you enjoyed your meal.</p>
        </div>
        <?php endif; ?>

        <div class="no-print" style="text-align: center; margin-top: 30px;">
            <button onclick="window.print()" class="btn btn-primary btn-lg">
                <i class="fa fa-print"></i> Print Bill
            </button>
            <a href="payment.php" class="btn btn-secondary btn-lg">
                <i class="fa fa-arrow-left"></i> Back to Payments
            </a>
        </div>
    </div>

    <!-- jQuery -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>