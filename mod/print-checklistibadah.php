<?php
if ($mod == '') {
  header('location:../404');
  echo 'kosong';
} else {
  if (!isset($_COOKIE['COOKIES_MEMBER'])) {
    setcookie('COOKIES_MEMBER', '', 0, '/');
    setcookie('COOKIES_COOKIES', '', 0, '/');
    // Login tidak ditemukan
    setcookie("COOKIES_MEMBER", "", time() - $expired_cookie);
    setcookie("COOKIES_COOKIES", "", time() - $expired_cookie);
    session_destroy();
    header("location:./");
  } else {
    include_once '../library/vendor/autoload.php';
    $mpdf = new \Mpdf\Mpdf();
    ob_start();
    $mpdf->SetHTMLFooter('
    <table width="100%" style="border-top:solid 1px #333;font-size:11px;">
        <tr>
            <td width="60%" style="text-align:left;">Simpanlah lembar Absensi ini.</td>
            <td width="35%" style="text-align: right;">Dicetak tanggal ' . tgl_indo($date) . '</td>
        </tr>
    </table>');
    $html = ob_get_contents();
    ob_end_clean();
    $mpdf->WriteHTML(utf8_encode($html));
    $mpdf->Output("Absensi-$employees_name-$date.pdf", 'I');
  }
}
