<?php

$conn = new mysqli("localhost", "root", "", "cashier");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_GET['id_penjualan'])) {
    $id_penjualan = $_GET['id_penjualan'];

    $sql = "SELECT dp.id_penjualan, p.nama_produk, dp.jumlah_produk, dp.subtotal
            FROM detailpenjualan dp
            JOIN produk p ON dp.id_produk = p.id_produk
            WHERE dp.id_penjualan = '$id_penjualan'";
    $result = $conn->query($sql);

    $data = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data['id_penjualan'] = $row['id_penjualan'];
            $data['nama_produk'] = $row['nama_produk'];
            $data['jumlah_produk'] = $row['jumlah_produk'];
            $data['subtotal'] = $row['subtotal'];
        }
    }
    echo json_encode($data);
}
$conn->close();
?>
