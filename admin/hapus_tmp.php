<?php

include_once "../config/inc.connection.php";
$id = $_GET['id'];

$hasil = mysql_query("DELETE FROM tmp_penjualan WHERE id = '$id'");

if ($hasil){
?><script>
document.location.href="?open=Penjualan-Baru";</script><?php
} 
else
{
echo "gagal karena : ".mysql_error();
}
?>