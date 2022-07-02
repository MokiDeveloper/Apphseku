<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function encNomorBerkas($nomorBerkas)
{
	$exp_nomor_berkas 	= explode('/', $nomorBerkas);
	$imp_nomor_berkas 	= implode('--', $exp_nomor_berkas);
	return $imp_nomor_berkas;
}
function decNomorBerkas($nomorBerkas)
{
	$exp_nomor_berkas 	= explode('--', $nomorBerkas);
	$imp_nomor_berkas 	= implode('/', $exp_nomor_berkas);
	return $imp_nomor_berkas;
}

/* End of file helper.php */
/* Location: ./application/helpers/helper.php */