<?php
require_once 'pdo.php';

/**
 * Thêm sản phẩm vào bảng sanpham
 * @param string $ten_sp Tên sản phẩm
 * @param float $dongia Đơn giá sản phẩm
 * @param string $mota Mô tả sản phẩm
 * @param string $anh Đường dẫn đến ảnh sản phẩm
 * @param int $ma_dm Mã danh mục
 * @param int $ma_th Mã thương hiệu
 */
function insertSanpham($ten_sp, $dongia, $mota, $anh, $ma_dm, $ma_th)
{
    $sql = "INSERT INTO sanpham (ten_sp, dongia, mota, anh, ma_dm, ma_th) VALUES (?, ?, ?, ?, ?, ?)";
    pdo_execute($sql, $ten_sp, $dongia, $mota, $anh, $ma_dm, $ma_th);
}

function uploadProductImg($file)
{
    $imgDirectory = 'views/asset/img/product/';

    // Tạo tên mới cho tệp ảnh
    $newFileName = uniqid() . '_' . $file['name'];

    // Di chuyển tệp vào thư mục img với tên mới
    move_uploaded_file($file['tmp_name'], $imgDirectory . $newFileName);

    // Địa chỉ URL của ảnh mới
    $imagePath = $imgDirectory . $newFileName;
    return $imagePath;
}

function deleteSanphamImg($imagePath)
{
    unlink($imagePath);
}

/**
 * Cập nhật thông tin sản phẩm trong bảng sanpham
 * @param int $ma_sp Mã sản phẩm cần cập nhật
 * @param string $ten_sp Tên sản phẩm
 * @param float $dongia Đơn giá sản phẩm
 * @param string $mota Mô tả sản phẩm
 * @param string $anh Đường dẫn đến ảnh sản phẩm
 * @param int $ma_dm Mã danh mục
 * @param int $ma_th Mã thương hiệu
 */
function updateSanpham($ma_sp, $ten_sp, $dongia, $mota, $anh, $ma_dm, $ma_th)
{
    $sql = "UPDATE sanpham SET ten_sp = ?, dongia = ?, mota = ?, anh = ?, ma_dm = ?, ma_th = ? WHERE ma_sp = ?";
    pdo_execute($sql, $ten_sp, $dongia, $mota, $anh, $ma_dm, $ma_th, $ma_sp);
}

function updateTenSp($ma_sp, $ten_sp)
{
    $sql = "UPDATE sanpham SET ten_sp = ? WHERE ma_sp = ?";
    pdo_execute($sql, $ten_sp, $ma_sp);
}

function updateDongia($ma_sp, $dongia)
{
    $sql = "UPDATE sanpham SET dongia = ? WHERE ma_sp = ?";
    pdo_execute($sql, $dongia, $ma_sp);
}

function updateMota($ma_sp, $mota)
{
    $sql = "UPDATE sanpham SET mota = ? WHERE ma_sp = ?";
    pdo_execute($sql, $mota, $ma_sp);
}

function updateAnh($ma_sp, $anh)
{
    $sql = "UPDATE sanpham SET anh = ? WHERE ma_sp = ?";
    pdo_execute($sql, $anh, $ma_sp);
}

function updateMaDanhmuc($ma_sp, $ma_dm)
{
    $sql = "UPDATE sanpham SET ma_dm = ? WHERE ma_sp = ?";
    pdo_execute($sql, $ma_dm, $ma_sp);
}

function updateMaThuonghieu($ma_sp, $ma_th)
{
    $sql = "UPDATE sanpham SET ma_th = ? WHERE ma_sp = ?";
    pdo_execute($sql, $ma_th, $ma_sp);
}


/**
 * Xóa sản phẩm từ bảng sanpham
 * @param int $ma_sp Mã sản phẩm cần xóa
 */
function deleteSanpham($ma_sp)
{
    $sql = "DELETE FROM sanpham WHERE ma_sp = ?";
    pdo_execute($sql, $ma_sp);
}

/**
 * Lấy thông tin sản phẩm theo ID từ bảng sanpham
 * @param int $ma_sp Mã sản phẩm
 * @return array Mảng chứa thông tin sản phẩm
 */
function getSanphamByID($ma_sp)
{
    $sql = "SELECT * FROM sanpham WHERE ma_sp = ?";
    return pdo_query_one($sql, $ma_sp);
}

/**
 * Lấy tất cả thông tin sản phẩm từ bảng sanpham
 * @return array Mảng chứa tất cả thông tin sản phẩm
 */
function getAllSanpham()
{
    $sql = "SELECT * FROM sanpham";
    return pdo_query($sql);
}

function getAllSanphamDesc()
{
    $sql = "SELECT * FROM sanpham ORDER BY ma_sp DESC";
    return pdo_query($sql);
}

/**
 * Lấy một số lượng sản phẩm từ bảng sanpham
 *
 * @param int $quantity Số lượng sản phẩm cần lấy
 *
 * @return array Mảng chứa thông tin các sản phẩm ngẫu nhiên
 */
function getAmountOfSanpham($quantity)
{
    $sql = "SELECT * FROM sanpham LIMIT $quantity";
    return pdo_query($sql);
}


/**
 * Lấy ngẫu nhiên một số lượng sản phẩm từ bảng sanpham
 *
 * @param int $quantity Số lượng sản phẩm cần lấy
 *
 * @return array Mảng chứa thông tin các sản phẩm ngẫu nhiên
 */
function getRandomSanpham($quantity)
{
    $sql = "SELECT * FROM sanpham ORDER BY RAND() LIMIT $quantity";
    return pdo_query($sql);
}

/**
 * Lấy ngẫu nhiên một số lượng sản phẩm từ bảng sanpham theo phạm vi giá
 *
 * @param int $quantity Số lượng sản phẩm cần lấy
 * @param float $minPrice Giá tối thiểu
 * @param float $maxPrice Giá tối đa
 *
 * @return array Mảng chứa thông tin các sản phẩm ngẫu nhiên theo phạm vi giá
 */
function getRandomSanphamByPriceRange($quantity, $minPrice, $maxPrice)
{
    $sql = "SELECT * FROM sanpham WHERE dongia BETWEEN ? AND ? ORDER BY RAND() LIMIT ?";
    return pdo_query($sql, $minPrice, $maxPrice, $quantity);
}


/**
 * Hàm dao để tìm kiếm tất cả sản phẩm theo từ khóa
 * @param string $keyword Từ khóa tìm kiếm
 * @return array Mảng chứa tất cả sản phẩm tìm được
 */
function searchProductsByKeyword($keyword)
{
    // Convert the keyword to lowercase
    $lowercaseKeyword = strtolower($keyword);

    $sql = "SELECT * FROM sanpham WHERE LOWER(ten_sp) LIKE ? OR LOWER(mota) LIKE ?";

    // Convert the keyword placeholder to lowercase
    return pdo_query($sql, '%' . $lowercaseKeyword . '%', '%' . $lowercaseKeyword . '%');
}



/**
 * Lọc sản phẩm dựa trên các điều kiện nhất định.
 *
 * @param array $params Mảng chứa các tham số lọc sản phẩm.
 *                      Các khóa có thể bao gồm:
 *                      - 'maDanhmuc': Mã danh mục.
 *                      - 'maThuonghieu': Mảng chứa mã thương hiệu.
 *                      - 'minPrice': Giá thấp nhất.
 *                      - 'maxPrice': Giá cao nhất.
 *
 * @return array Mảng chứa thông tin của các sản phẩm thỏa mãn điều kiện lọc.
 */
function filterProducts($params)
{
    $sql = "SELECT * FROM sanpham WHERE ";
    $conditions = array();
    $sql_args = array();

    if (!empty($params['ma_dm'])) {
        $conditions[] = "ma_dm = ?";
        $sql_args[] = $params['ma_dm'];
    }

    if (!empty($params['arr_ma_th'])) {
        $placeholders = str_repeat('?,', count($params['arr_ma_th']) - 1) . '?';
        $conditions[] = "ma_th IN ($placeholders)";
        $sql_args = array_merge($sql_args, $params['arr_ma_th']);
    }

    if (!empty($params['minPrice'])) {
        $conditions[] = "dongia >= ?";
        $sql_args[] = $params['minPrice'];
    }

    if (!empty($params['maxPrice'])) {
        $conditions[] = "dongia <= ?";
        $sql_args[] = $params['maxPrice'];
    }

    // Check if there are conditions
    if (empty($conditions)) {
        // No conditions specified, return an empty result
        return array();
    }

    // Xây dựng câu truy vấn
    $sql .= implode(" AND ", $conditions);

    // Thực hiện truy vấn
    $result = pdo_query($sql, ...$sql_args);

    return $result;
}

function inlaidProductInfo(&$row)
{
    $product = getSanphamByID($row['ma_sp']);
    //thêm từng cột trong sản phẩm vào $row
    foreach ($product as $key => $value) {
        $row[$key] = $value;
    }
}

/**
 * Lấy 5 ma_sp có tổng doanh thu cao nhất
 * @param int $amount Số lượng sản phẩm cần lấy
 * @return array Mảng chứa 5 ma_sp có tổng doanh thu cao nhất
 */
function getTopRevenueProducts($amount)
{
    $sql = "
        SELECT sp.ma_sp, sp.ten_sp, sp.anh, SUM(ctdh.thanhtien) as doanhthu
        FROM ctdonhang ctdh
        LEFT JOIN sanpham sp ON ctdh.ma_sp = sp.ma_sp
        GROUP BY sp.ma_sp
        ORDER BY doanhthu DESC
        LIMIT $amount;
    ";

    // Thực hiện truy vấn
    return pdo_query($sql);
}

function getTopSellerProducts($amount)
{
    $sql = "
        SELECT sp.ma_sp, sp.ten_sp, sp.anh, SUM(ctdh.soluong) as soluong
        FROM ctdonhang ctdh
        LEFT JOIN sanpham sp ON ctdh.ma_sp = sp.ma_sp
        GROUP BY sp.ma_sp
        ORDER BY soluong DESC
        LIMIT $amount;
    ";

    // Thực hiện truy vấn
    return pdo_query($sql);
}
