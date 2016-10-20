<?php

	function change_image($src_image_dinac) {
		$i=$src_image_dinac;
		switch ($i) {
			case "http://www.meteorologia.gov.py/adm/imgtpo/chaparronyocnltsra.gif":
				$i = "img/adh-1.svg";
				$src_image_dinac=$i;
				break;
			case "http://www.meteorologia.gov.py/adm/imgtpo/lluviaytsra.gif":
				$i = "img/adh-2.svg";
				$src_image_dinac=$i;
				break;
			case "http://www.meteorologia.gov.py/adm/imgtpo/chaparron.gif":
				$i = "img/SVG/sw-11.svg";
				$src_image_dinac=$i;
				break;
			case "http://www.meteorologia.gov.py/adm/imgtpo/parcialnublado.gif":
				$i = "img/SVG/sw-03.svg";
				$src_image_dinac=$i;
				break;
			case "http://www.meteorologia.gov.py/adm/imgtpo/lluvia.gif":
				$i = "img/SVG/sw-21.svg";
				$src_image_dinac=$i;
				break;
			case "http://www.meteorologia.gov.py/adm/imgtpo/nublado.png":
				$i = "img/SVG/sw-06.svg";
				$src_image_dinac=$i;
				break;
			case "http://www.meteorologia.gov.py/adm/imgtpo/despejado.jpg":
				$i = "img/SVG/sw-01.svg";
				$src_image_dinac=$i;
				break;
			case "http://www.meteorologia.gov.py/adm/imgtpo/nochechaparron.gif":
				$i = "img/SVG/sw-31.svg";
				$src_image_dinac=$i;
				break;
			case "http://www.meteorologia.gov.py/adm/imgtpo/nochelluviatsra.gif":
				$i = "img/SVG/sw-37.svg";
				$src_image_dinac=$i;
				break;
		}
		return $src_image_dinac;
	}
?>