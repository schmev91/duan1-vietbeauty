<?php
require_once 'pdo.php';

/**
 * Lấy tất cả thông tin thương hiệu
 *
 * @return array Mảng chứa thông tin của tất cả thương hiệu
 */
function getAllThuonghieu()
{
    $sql = "SELECT * FROM thuonghieu";
    return pdo_query($sql);
}

function getAllThuonghieuDesc()
{
    $sql = "SELECT * FROM thuonghieu ORDER BY ma_th DESC";
    return pdo_query($sql);
}

/**
 * Lấy thông tin một thương hiệu theo mã thương hiệu
 *
 * @param int $ma_th Mã thương hiệu
 *
 * @return array Mảng chứa thông tin của thương hiệu
 */
function getThuonghieuById($ma_th)
{
    $sql = "SELECT * FROM thuonghieu WHERE ma_th = ?";
    return pdo_query_one($sql, $ma_th);
}


function uploadBrandImg($file)
{
    $imgDirectory = 'views/asset/img/brand/';

    // Tạo tên mới cho tệp ảnh
    $newFileName = uniqid() . '_' . $file['name'];

    // Di chuyển tệp vào thư mục img với tên mới
    move_uploaded_file($file['tmp_name'], $imgDirectory . $newFileName);

    // Địa chỉ URL của ảnh mới
    $imagePath = $imgDirectory . $newFileName;
    return $imagePath;
}

/**
 * Thêm mới một thương hiệu
 *
 * @param string $ten_th Tên thương hiệu
 *
 * @throws PDOException Lỗi thực thi câu lệnh
 */
function insertThuonghieu($ten_th, $hinh_th)
{
    $sql = "INSERT INTO thuonghieu (ten_th, hinh_th) VALUES (?, ?)";
    pdo_execute($sql, $ten_th, $hinh_th);
}

/**
 * Cập nhật thông tin một thương hiệu
 *
 * @param int $ma_th Mã thương hiệu
 * @param string $ten_th Tên thương hiệu mới
 *
 * @throws PDOException Lỗi thực thi câu lệnh
 */
function updateThuonghieu($ma_th, $ten_th)
{
    $sql = "UPDATE thuonghieu SET ten_th = ? WHERE ma_th = ?";
    pdo_execute($sql, $ten_th, $ma_th);
}

/**
 * Xóa một thương hiệu
 *
 * @param int $ma_th Mã thương hiệu
 *
 * @throws PDOException Lỗi thực thi câu lệnh
 */
function deleteThuonghieu($ma_th)
{
    $sql = "DELETE FROM thuonghieu WHERE ma_th = ?";
    pdo_execute($sql, $ma_th);
}

/**
 * thêm biến thuonghieu cho sản phẩm
 *
 * @param array $product mảng chứa thông tin sản phẩm
 *
 * @throws PDOException Lỗi thực thi câu lệnh
 */
function brandInlaiding(&$product)
{
    $product['ten_th'] = getThuonghieuById($product['ma_th'])['ten_th'];
}
