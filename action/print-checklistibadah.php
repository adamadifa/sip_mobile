<?php
session_start();
require_once '../library/sw-config.php';
require_once '../library/sw-function.php';
include_once '../library/vendor/autoload.php';
if (!isset($_COOKIE['COOKIES_MEMBER']) or !isset($_COOKIE['COOKIES_COOKIES'])) {
  //Kondisi tidak login
} else {
  require_once '../mod/out/sw-cookies.php';
  //kondisi login
  switch (@$_GET['action']) {


      /* -------  CETAK PDF----------*/
    case 'pdf':
      $bulan = $_GET['bulan'];
      $tahun = $_GET['tahun'];
      $tglawal = $tahun . "-" . $bulan . "-01";
      $tglakhir = date('Y-m-t', strtotime($tglawal));
      $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
      $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'orientation' => 'L',
        'default_font_size' => 9,
        'default_font' => 'Tahoma'
      ]);

      ob_start();
      $mpdf->SetMargins(5, 5, 5);
      $mpdf->SetHTMLFooter('
    <table width="100%" style="border-top:solid 1px #333;font-size:11px;">
        <tr>
            <td width="60%" style="text-align:left;">Simpanlah lembar Checklist Ibadah ini.</td>
            <td width="35%" style="text-align: right;">Dicetak tanggal ' . tgl_indo($date) . '</td>
        </tr>
    </table>');
      echo '<!DOCTYPE html>
      <html lang="id-ID" xml:lang="id-ID">
      <head>
          <title>Cetak Data Absensi</title>
          <style>
          body{font-family:Arial,Helvetica,sans-serif}.container_box{position:relative}.container_box .row h3{padding:10px 0;line-height:25px;font-size:20px;margin:5px 0 15px;text-transform: uppercase;}.container_box .text-center{text-align:center}.container_box .content_box{position:relative}.container_box .content_box .des_info{margin:20px 0;text-align:right}.container_box h3{
            font-size:30px;}
          table.customTable{width:100%;background-color:#fff;border-collapse:collapse;border-width:1px;border-color:#b3b3b3;border-style:solid;color:#000}table.customTable td,table.customTable th{border-width:1px;border-color:#b3b3b3;border-style:solid;padding:5px;text-align:left}table.customTable thead{background-color:#f6f3f8}.text-center{text-align:center}.badge-danger,a.badge-danger{background:#ff396f!important}.badge-success,a.badge-success{background:#2EB82E!important}.badge-warning,a.badge-warning{background:#00B4FF!important;color:#fff}.badge-info,a.badge-info{background:#754aed!important}.badge{font-size:12px;line-height:1em;border-radius:100px;letter-spacing:0;height:22px;min-width:22px;padding:0 6px;display:inline-flex;align-items:center;justify-content:center;font-weight:400;color:#fff}
          </style>
      </head>
      <body>';
      echo '
    <section class="container_box">
      <div class="row">';
      echo '<h3>DATA   PENGISIAN CHECKLIST IBADAH HARIAN BULAN  ' . $namabulan[$bulan] . ' ' . $tahun . '</h3>';
      echo '<div class="content_box">
        <table>
            <tr>
              <td>NPP</td>
              <td>:</td>
              <td>' . $row_user['npp'] . '</td>
            </tr>
            <tr>
            <td>Nama Lengkap</td>
            <td>:</td>
            <td>' . $row_user['nama_lengkap'] . '</td>
          </tr>
        </table>
        <br>
        <table class="customTable">
          <thead>
            <tr>
            <th rowspan="2" align="center">NO</th>
            <th rowspan="2" align="center">Kegiatan Ibadah</th>
            <th colspan="31" align="center">Tanggal</th>
            <th rowspan="2" align="center">Total</th>
            </tr>
            <tr>';
      for ($i = 1; $i <= 31; $i++) {
        echo '<td>' . $i . '</td>';
      }
      echo '</tr>
          </thead>
        <tbody>';
      $no = 1;
      $query = "SELECT  * FROM kegiatan_ibadah
      LEFT JOIN (SELECT id_kegiatan,SUM(IF(DAY(tanggal)=1,1,0)) as tgl_1,
                    SUM(IF(DAY(tanggal)=2,1,0)) as tgl_2,
                    SUM(IF(DAY(tanggal)=3,1,0)) as tgl_3,
                    SUM(IF(DAY(tanggal)=4,1,0)) as tgl_4,
                    SUM(IF(DAY(tanggal)=5,1,0)) as tgl_5,
                    SUM(IF(DAY(tanggal)=6,1,0)) as tgl_6,
                    SUM(IF(DAY(tanggal)=7,1,0)) as tgl_7,
                    SUM(IF(DAY(tanggal)=8,1,0)) as tgl_8,
                    SUM(IF(DAY(tanggal)=9,1,0)) as tgl_9,
                    SUM(IF(DAY(tanggal)=10,1,0)) as tgl_10,
                    SUM(IF(DAY(tanggal)=11,1,0)) as tgl_11,
                    SUM(IF(DAY(tanggal)=12,1,0)) as tgl_12,
                    SUM(IF(DAY(tanggal)=13,1,0)) as tgl_13,
                    SUM(IF(DAY(tanggal)=14,1,0)) as tgl_14,
                    SUM(IF(DAY(tanggal)=15,1,0)) as tgl_15,
                    SUM(IF(DAY(tanggal)=16,1,0)) as tgl_16,
                    SUM(IF(DAY(tanggal)=17,1,0)) as tgl_17,
                    SUM(IF(DAY(tanggal)=18,1,0)) as tgl_18,
                    SUM(IF(DAY(tanggal)=19,1,0)) as tgl_19,
                    SUM(IF(DAY(tanggal)=20,1,0)) as tgl_20,
                    SUM(IF(DAY(tanggal)=21,1,0)) as tgl_21,
                    SUM(IF(DAY(tanggal)=22,1,0)) as tgl_22,
                    SUM(IF(DAY(tanggal)=23,1,0)) as tgl_23,
                    SUM(IF(DAY(tanggal)=24,1,0)) as tgl_24,
                    SUM(IF(DAY(tanggal)=25,1,0)) as tgl_25,
                    SUM(IF(DAY(tanggal)=26,1,0)) as tgl_26,
                    SUM(IF(DAY(tanggal)=27,1,0)) as tgl_27,
                    SUM(IF(DAY(tanggal)=28,1,0)) as tgl_28,
                    SUM(IF(DAY(tanggal)=29,1,0)) as tgl_29,
                    SUM(IF(DAY(tanggal)=30,1,0)) as tgl_30,
                    SUM(IF(DAY(tanggal)=31,1,0)) as tgl_31
	            FROM checklist_ibadah
	            WHERE npp = '$row_user[npp]' AND tanggal BETWEEN '$tglawal' AND '$tglakhir'
	            GROUP BY id_kegiatan) checklist ON (kegiatan_ibadah.id = checklist.id_kegiatan)";

      //print($query);
      $result = $connection->query($query);
      while ($row = $result->fetch_assoc()) {
        echo '<tr>
        <td>' . $no . '</td>
        <td>' . $row['kegiatan_ibadah'] . '</td>';
        $total = 0;
        for ($i = 1; $i <= 31; $i++) {
          $tgl = "tgl_" . $i;
          $check = $row[$tgl];
          if (!empty($check)) {
            $check = "✓";
            $total += 1;
          } else {
            $check = "";
            $total += 0;
          }
          echo '<td align="center">' . $check . '</td>';
        }
        echo
        '
        <td align="center">' . $total . '</td>
        </tr>';
        $no++;
      }
      echo '
        </tbody>
        </table>';
      echo '</body>';
      $html = ob_get_contents();
      ob_end_clean();

      $mpdf->WriteHTML($html);
      $mpdf->Output("Checklist Ibadah--$date.pdf", 'I');
      break;
    case 'excel':
      break;
  }
}
