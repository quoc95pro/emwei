<?php
use Gloudemans\Shoppingcart\Facades\Cart;
// Nhập giá trị number bằng phương thức post
$rowId = isset($_POST['id']) ? (string)$_POST['id'] : false;
$qty = isset($_POST['number']) ? (int)$_POST['number'] : false;
// Kiểm tra number có lớn hơn không hay không
//if (!$qty){
//    die ('<h1>Vui lòng nhập một số lớn hơn không (0)</h1>');
//}

 //Lặp từ 1 tới number để in ra màn hình
Cart::update($rowId, ['qty' => $qty]);
$price=Cart::get($rowId)->price;
echo number_format($price*$qty, 0, ',', '.');
?>