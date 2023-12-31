<?php
require_once 'pdo.php';

/**
 * Lấy thông tin một đơn hàng theo mã đơn hàng
 *
 * @param int $ma_dh Mã đơn hàng
 *
 * @return array Mảng chứa thông tin của đơn hàng
 */
function getDonhangById($ma_dh)
{
    $sql = "SELECT * FROM donhang WHERE ma_dh = ?";
    return pdo_query_one($sql, $ma_dh);
}

/**
 * Lấy chi tiết sản phẩm trong một đơn hàng
 *
 * @param int $ma_dh Mã đơn hàng
 *
 * @return array Mảng chứa thông tin chi tiết sản phẩm trong đơn hàng
 */
function getCTDonhangById($ma_dh)
{
    $sql = "SELECT * FROM ctdonhang WHERE ma_dh = ?";
    return pdo_query($sql, $ma_dh);
}

function getDonhangByNguoidung($ma_nd)
{
    $sql = "SELECT * FROM donhang WHERE ma_nd = ?";
    return pdo_query($sql, $ma_nd);
}

function getDonhangByNguoidungDesc($ma_nd)
{
    $sql = "SELECT * FROM donhang WHERE ma_nd = ? ORDER BY ngaydat DESC";
    return pdo_query($sql, $ma_nd);
}


function getAllDonhang()
{
    $sql = "SELECT * FROM donhang";
    return pdo_query($sql);
}

function getAllDonhangDesc()
{
    $sql = "SELECT * FROM donhang ORDER BY ngaydat DESC";
    return pdo_query($sql);
}

function getDonhangAmountThisMonth()
{
    $currentMonth = date('m'); // Get the current month with leading zeros

    $sql = "SELECT COUNT(ma_dh) as order_count 
            FROM donhang 
            WHERE MONTH(ngaydat) = ?";


    $result = pdo_query($sql, $currentMonth);

    // Assuming pdo_query returns an array with the query result
    // Adjust the retrieval of the count based on your actual database query function
    return $result[0]['order_count'];
}

function getTotalRevenueInCurrentMonth()
{
    $currentMonth = date('m'); // Lấy số tháng hiện tại với số 0 được thêm vào nếu tháng < 10

    // Truy vấn để lấy tổng tiền từ tất cả đơn hàng trong tháng hiện tại
    $sql = "SELECT SUM(tongtien) as total_revenue 
            FROM donhang 
            WHERE MONTH(ngaydat) = ?";

    $result = pdo_query($sql, $currentMonth);

    return $result[0]['total_revenue'];
}

/**
 * Thêm mới một đơn hàng
 *
 * @param array $donhang Mảng chứa thông tin đơn hàng
 *
 * @return int Mã đơn hàng vừa thêm mới
 */
function insertDonhang($donhang)
{
    $sql = "INSERT INTO donhang (ma_dh ,ngaydat, tongtien, diachi, vanchuyen, thanhtoan, trangthai, ma_gh, ma_nd) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    pdo_execute($sql, $donhang['ma_dh'], $donhang['ngaydat'], $donhang['tongtien'], $donhang['diachi'], $donhang['vanchuyen'], $donhang['thanhtoan'], $donhang['trangthai'], $donhang['ma_gh'], $donhang['ma_nd']);
    return pdo_query_value("SELECT LAST_INSERT_ID()");
}

/**
 * Thêm mới chi tiết sản phẩm trong đơn hàng
 *
 * @param array $ctdonhang Mảng chứa thông tin chi tiết sản phẩm
 */
function insertCTDonhang($ctdonhang)
{
    $sql = "INSERT INTO ctdonhang (ma_dh, ma_sp, soluong, dongia, thanhtien) VALUES (?, ?, ?, ?, ?)";
    pdo_execute($sql, $ctdonhang['ma_dh'], $ctdonhang['ma_sp'], $ctdonhang['soluong'], $ctdonhang['dongia'], $ctdonhang['thanhtien']);
}

/**
 * Cập nhật thông tin một đơn hàng
 *
 * @param array $donhang Mảng chứa thông tin đơn hàng
 */
function updateDonhang($donhang)
{
    $sql = "UPDATE donhang SET ngaydat = ?, tongtien = ?, diachi = ?, vanchuyen = ?, thanhtoan = ?, ma_gh = ? WHERE ma_dh = ?";
    pdo_execute($sql, $donhang['ngaydat'], $donhang['tongtien'], $donhang['diachi'], $donhang['vanchuyen'], $donhang['thanhtoan'], $donhang['ma_gh'], $donhang['ma_dh']);
}

function updateDonhangStatus($ma_dh, $trangthai)
{
    $sql = "UPDATE donhang SET trangthai = ? WHERE ma_dh = ?";
    pdo_execute($sql, $trangthai, $ma_dh);
}


/**
 * Xóa một đơn hàng
 *
 * @param int $ma_dh Mã đơn hàng
 */
function deleteDonhang($ma_dh)
{
    $sql = "DELETE FROM donhang WHERE ma_dh = ?";
    pdo_execute($sql, $ma_dh);
}

/**
 * Xóa chi tiết sản phẩm trong một đơn hàng
 *
 * @param int $ma_dh Mã đơn hàng
 */
function deleteCTDonhang($ma_dh)
{
    $sql = "DELETE FROM ctdonhang WHERE ma_dh = ?";
    pdo_execute($sql, $ma_dh);
}
