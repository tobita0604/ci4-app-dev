<?php
//============================================================+
// File name   : Pdf_for_template.php
//============================================================+

//============================================================+
// PDFフォーマット設定
//============================================================+


// Include the main TCPDF library (search for installation path).
require_once APPPATH.'libraries/TCPDF-master/tcpdf.php';

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('ご集合案内');

// remove default header/footer
$pdf->setPrintHeader(false);
// $pdf->setPrintFooter(false);
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('kozgopromedium', '', 12);

// add a page
$pdf->AddPage();
//============================================================+
// PDF内容を作成
//============================================================+
$content = "";
// style css
$css_head = <<<EOF
<style>
.group-table-title{
	font-size: 18px;
	text-align: center;
	background-color: #dcdcdc;
	border:1px double #000000;	
	padding:5px;
}
</style>
EOF;
// ヘッダー
$head = <<<EOF
$css_head
	<table class="group-table-title">
		<tr>
			<th ><b>ご出発当日のご案内</b></th>
		</tr>
	</table>	
EOF;
$content .= $head;

$css_tbl1 = <<<EOF
<style>
.bank-line-height{
	line-height: 15px;
}	
table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
}
.form {
    border-bottom: 1px solid #cbcbcb;
    margin-top: 1em;
    margin-bottom: 2em;
	padding-top:10px;
	vertical-align: middle;
}
.form td {
	line-height: 12px;
	height: 36px;	
	border: 1px solid #000000;
	background-color: #FFFFFF;
	color: #555555;
	font-size: 10px;
	font-weight: normal;    
	text-align: center;	
}
</style>
EOF;

//
//============================================================+
// コースD
//============================================================+
$tbl1 = <<<EOF
$css_tbl1
<div class="bank-line-height">　</div>
	<table class="form" width="100%">
		<tr>
			<td style="width:10%;">ご集合</td>
			<td style="width:90%;font-size: 10px !important;" >
				出発時、ご集合はございません。<br>フライトの出発時間2時間30分前までに、各自各航空会社のチェックインカウンターで搭乗手続きをお済ませください。
			</td>			
		</tr>
		<tr>
			<td style="height: 45px !important;">ご集合場所<br><span style="font-size: 8px !important;">(下記図参照)</span></td>
			<td></td>
		</tr>
		<tr>
			<td>ご出発便</td>
			<td></td>
		</tr>
		<tr>
			<td style="height: 45px !important;">ご出発当日<br>緊急連絡先</td>
			<td></td>
		</tr>
		<tr>
			<td style="height: 45px !important;">当日お渡しするもの</td>
			<td></td>
		</tr>
	</table>
EOF;

$content .= $tbl1;
//
//============================================================+
// PDFに内容を入れる
//============================================================+
$pdf->writeHTML($content, true, false, true, false, '');

$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
if($type=="user"){
	$pdf->Output('aaa.pdf', 'I');
}elseif($type=="server"){
	$pdf->Output($_SERVER['DOCUMENT_ROOT']."reinvent/pdf/shugo/bbb.pdf", 'F');
}
//$pdf->Output($_SERVER['DOCUMENT_ROOT']."reinvent/pdf/shugo/".$userData['R01_Reservation_No'].'.pdf', 'F');

//============================================================+
// END OF FILE
//============================================================+
