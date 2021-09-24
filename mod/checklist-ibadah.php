<?php
if ($mod == '') {
    header('location:../404');
    echo 'kosong';
} else {
    include_once 'mod/sw-header.php';
    if (!isset($_COOKIE['COOKIES_MEMBER'])) {
        setcookie('COOKIES_MEMBER', '', 0, '/');
        setcookie('COOKIES_COOKIES', '', 0, '/');
        // Login tidak ditemukan
        setcookie("COOKIES_MEMBER", "", time() - $expired_cookie);
        setcookie("COOKIES_COOKIES", "", time() - $expired_cookie);
        session_destroy();
        header("location:./");
    } else {
        $tahunmulai = 2021;
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        echo '<!-- App Capsule -->
    <div id="appCapsule">
        <div class="section mt-3 text-center">
            <div class="avatar-section">
                <input type="file" class="upload" name="file" id="avatar" accept=".jpg, .jpeg, ,gif, .png" capture="camera">
                <a href="#">';
        if ($row_user['foto'] == '') {
            echo '<img src="' . $base_url . 'content/avatar.jpg" alt="image" class="imaged w100 rounded">';
        } else {
            echo '
                    <img src="' . $base_url . 'content/karyawan/' . $row_user['foto'] . '" alt="avatar" class="imaged w100 rounded">';
        }
        echo '
                    <span class="button">
                        <ion-icon name="camera-outline"></ion-icon>
                    </span>
                </a>
            </div>
        </div>

        
      
        <div class="section mt-2 mb-2">
            <div class="section-title">Checklist Ibadah Harian</div>
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-warning mt-1" data-toggle="modal" data-target="#modal-print"><ion-icon name="print-outline"></ion-icon></button>
                    <table class="table table-striped">
                        <input type="hidden" id="tanggal" value="' . date("Y-m-d") . '">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>' . date("Y-m-d") . '</th>
                            </tr>
                        </thead>
                    </table>
                    <table class="table table-bordered table-striped">
                        <thead style="background-color:#065606;">
                            <tr >
                                <th style="color:white">Kegiatan</th>
                                <th style="color:white">Checklist</th>
                            </tr>
                        </thead>
                        <tbody id="loadchecklistibadah">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
    
';
?>
        <!-- MODAL EXPLORE -->
        <div class="modal fade action-sheet inset" id="modal-print" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cetak / Explore</h5>
                        <a href="javascript:void(0);" class="close" style="position: absolute;right:15px;top: 10px;" data-dismiss="modal" aria-hidden="true">
                            <ion-icon name="close-outline"></ion-icon>
                        </a>
                    </div>
                    <div class="modal-body">

                        <div class="action-sheet-content">
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label">Bulan</label>
                                    <select class="form-control custom-select bulan" name="bulan" required>
                                        <?php
                                        for ($i = 1; $i <= 12; $i++) {
                                        ?>
                                            <option <?php if (date('m') == $i) {
                                                        echo "selected";
                                                    } ?> value="<?php echo $i; ?>"><?php echo $namabulan[$i]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label">Tahun</label>
                                    <select class="form-control custom-select tahun" name="tahun" required>
                                        <?php
                                        for ($thn = $tahunmulai; $thn <= date('Y'); $thn++) {
                                        ?>
                                            <option <?php if (date('Y') == $thn) {
                                                        echo "selected";
                                                    } ?> value="<?php echo $thn; ?>"><?php echo $thn; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group basic">
                                <button type="submit" class="btn btn-primary btn-block mt-2 btn-print-checklistibadah">
                                    <ion-icon name="print-outline"></ion-icon> Cetak
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- * App Capsule -->
<?php
    }
    include_once 'mod/sw-footer.php';
}
