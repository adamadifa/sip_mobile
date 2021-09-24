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
            <div class="section-title">Update Password</div>
            <div class="card">
                <div class="card-body">
                    <form id="update-password">
                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="text4">NPP</label>
                                <input type="text" class="form-control" name="npp" value="' . $row_user['npp'] . '" style="background:#eeeeee" readonly>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="email4">Password baru</label>
                                <input type="password" class="form-control" name="password" id="password" required>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-success mr-1 btn-block">Simpan</button>
                    </form>

                </div>
            </div>
        </div>
        
    </div>
    <!-- * App Capsule -->
';
    }
    include_once 'mod/sw-footer.php';
}
