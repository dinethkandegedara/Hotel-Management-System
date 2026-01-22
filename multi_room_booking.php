<?php
session_start();
include('db.php');

// Initialize cart if not exists
if (!isset($_SESSION['room_cart'])) {
    $_SESSION['room_cart'] = array();
}

// Handle add to cart
if (isset($_POST['add_to_cart'])) {
    $room_id = intval($_POST['room_id']);
    
    // Check if room is available
    $check_query = "SELECT * FROM room WHERE id = $room_id AND status = 'Available'";
    $check_result = mysqli_query($con, $check_query);
    
    if ($check_result && mysqli_num_rows($check_result) > 0) {
        $room = mysqli_fetch_assoc($check_result);
        
        // Check if room already in cart
        $already_in_cart = false;
        foreach ($_SESSION['room_cart'] as $cart_item) {
            if ($cart_item['id'] == $room_id) {
                $already_in_cart = true;
                break;
            }
        }
        
        if (!$already_in_cart) {
            $_SESSION['room_cart'][] = $room;
            echo json_encode(['success' => true, 'message' => 'Room added to cart', 'cart_count' => count($_SESSION['room_cart'])]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Room already in cart']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Room not available']);
    }
    exit;
}

// Handle remove from cart
if (isset($_POST['remove_from_cart'])) {
    $room_id = intval($_POST['room_id']);
    
    foreach ($_SESSION['room_cart'] as $key => $item) {
        if ($item['id'] == $room_id) {
            unset($_SESSION['room_cart'][$key]);
            $_SESSION['room_cart'] = array_values($_SESSION['room_cart']); // Re-index array
            break;
        }
    }
    
    echo json_encode(['success' => true, 'message' => 'Room removed from cart', 'cart_count' => count($_SESSION['room_cart'])]);
    exit;
}

// Handle get cart
if (isset($_GET['get_cart'])) {
    echo json_encode(['cart' => $_SESSION['room_cart'], 'count' => count($_SESSION['room_cart'])]);
    exit;
}

// Handle clear cart
if (isset($_POST['clear_cart'])) {
    $_SESSION['room_cart'] = array();
    echo json_encode(['success' => true, 'message' => 'Cart cleared']);
    exit;
}
?>
