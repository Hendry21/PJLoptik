<?php
//lanjutkan session yang sudah dibuat sebelumnya
session_start();

//hapus session yang sudah dibuat
session_destroy();

?>
<script language="javascript">alert("Berhasil logout!"); location.href="index.php";</script>