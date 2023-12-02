<?php
class paymentController
{
    private $payment;

    public function __construct()
    {

        if (u::isLoggedin()) {
            $this->payment = new paymentModel(s('user'));
        }
    }

    public function show($data = null)
    {
        if ($data) extract($data);
        if (isset($this->payment)) {
            extract($this->payment->getPaymentInfo());
            if (isset($diachi) && empty($diachi)) $diachi = null;
        }
        include_once "./views/pages/instantbuy.php";
    }

    public function instantBuying()
    {
        if (u::isThreading())
            u::toThread();
        else u::setThread();

        extract($_POST);


        if (u::isLoggedin()  & isset($_POST['ma_sp'])) {
            $product = new productModel($ma_sp);

            $this->show(array_merge($product->getData(), $_POST, $this->payment->getPaymentInfo()));
        } else if (u::isThreading() && !u::isLoggedin()) {
            header("location: " . u::link('user', 'showLoginForm'));
        } else {
            u::toThread();
        }
    }

    public function abort()
    {
        u::toThread();
    }

    public function orderRequest()
    {
        //update địa chỉ cho user
        //Nếu post có diachi thì người dùng đã nhập địa chỉ mới 
        if (isset($_POST['diachi'])) {
            $user = new UserModel(s('user')['ma_nd']);
            $user->updateDiachi($_POST['diachi']);

            
            s('user', $user->getData());
            $this->payment->updateUser($user->getData());
        }

        extract($this->payment->getPaymentInfo());
        extract($_POST);


        // ma_dh ,ngaydat, tongtien, diachi, vanchuyen, thanhtoan, ma_gh, ma_nd
        //tính tổng tiền và thành tiền từng sản phẩm ở controller trước
        // var_dump($_POST);
        if ($type == 'instant') {
            $orderData = array();

            $item = new orderItem(new productModel($ma_sp), $soluong);

            $ORDER_STATEMENT = 'Đang chờ xác nhận';

            $orderData['tongtien'] = $item->getThanhtien();
            $orderData['diachi'] = $diachi;
            $orderData['vanchuyen'] = $vanchuyen;
            $orderData['thanhtoan'] = $thanhtoan;
            $orderData['trangthai'] = $ORDER_STATEMENT;
            $orderData['ma_gh'] = null;
            $orderData['ma_nd'] = $ma_nd;

            $ma_dh = $this->payment->addOrder($orderData);
            $item->insertCTDonhang($ma_dh);
            header('location: ' . u::link('user', 'show', ['userTab' => 'orders']));
            exit;
        } else {
        }
    }

    public function statement()
    {
    }

    public function cartOrdering()
    {
    }
}
