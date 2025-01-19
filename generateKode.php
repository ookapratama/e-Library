<?php

include 'fungsi.php';

$prefix = $_POST['prefix'];

$kode = generateKode($prefix);

echo $kode;
