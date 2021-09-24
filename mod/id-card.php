<?php
if ($mod == '') {
    header('location:../404');
    echo 'kosong';
} else {
    include_once 'mod/sw-header.php';
    require_once './library/phpqrcode/qrlib.php';
    if (!isset($_COOKIE['COOKIES_MEMBER'])) {
        setcookie('COOKIES_MEMBER', '', 0, '/');
        setcookie('COOKIES_COOKIES', '', 0, '/');
        // Login tidak ditemukan
        setcookie("COOKIES_MEMBER", "", time() - $expired_cookie);
        setcookie("COOKIES_COOKIES", "", time() - $expired_cookie);
        session_destroy();
        header("location:./");
    } else {

        $codeContents = $row_user['npp'];
        $tempdir = './content/employees-code-qr/';
        #parameter inputan
        $isi_teks = $codeContents;
        $namafile = '' . $row_user['npp'] . '.jpg';
        if (file_exists('./content/employees-code-qr/' . $namafile . '')) {
            $namafile = '' . $row_user['npp'] . '.jpg';
        } else {
            $quality = 'L'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
            $ukuran = 5; //batasan 1 paling kecil, 10 paling besar
            $padding = 1;
            QRCode::png($isi_teks, $tempdir . $namafile, $quality, $ukuran, $padding);
        }

        echo '
  <!-- App Capsule -->
    <div id="appCapsule">
        <!-- Wallet Card -->
        <div class="section wallet-card-section pt-1">
            <div class="wallet-card">
                <div class="text-center">
                    <!-- * ID Card -->
                    <div class="id-card">
                        <div class="body-id-card text-center" id="divToPrint">
                            <div class="avatar">';
        if ($row_user['foto'] == '') {
            echo '<img src="' . $base_url . 'content/avatar.jpg" alt="image" class="imaged w100 rounded">';
        } else {
            echo '
                                    <img src="' . $base_url . 'content/karyawan/' . $row_user['foto'] . '" alt="' . $row_user['nama_lengkap'] . '" class="imaged w100">';
        }
        echo '
                            </div>
                            <h3 style="color:white">' . $row_user['nama_lengkap'] . '</h3>
                            <p style="color:white">' . $row_user['npp'] . '</p>
                            <div class="qrcode">
                            <img class="img-responsive text-center" src="' . $tempdir . '' . $namafile . '" alt="QR CODE" style="width:100px; height:100px">
                            </div>
                        </div>
                    </div>'; ?>
        <hr>
        <a href="#" class="btn btn-success btn-Convert-Html2Image">
            <ion-icon name="save-outline"></ion-icon> Siampan ID Card
        </a>
        <div id="previewImage" class="d-none"></div>
        </div>
        </div>
        </div>
        <!-- Wallet Card -->
        </div>
        <!-- * App Capsule -->
<?php
    }
    include_once 'mod/sw-footer.php';
} ?>