<?php

function rupiah($value)
{
	$afterConvert = "Rp " . number_format($value, 2, ',', '.');
	return $afterConvert;
}
