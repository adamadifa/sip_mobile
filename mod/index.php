<?php
if ($mod == '') {
	header('location:../404');
	echo 'kosong';
} else {
	include_once 'mod/sw-header.php';
	if (!isset($_COOKIE['COOKIES_MEMBER'])) {

		$query = mysqli_query($connection, "SELECT max( employees_code) as kodeTerbesar FROM employees");
		$data = mysqli_fetch_array($query);
		$kode_karyawan = $data['kodeTerbesar'];
		$urutan = (int) substr($kode_karyawan, 3, 3);
		$urutan++;
		$huruf = "OM";
		$kode_karyawan = $huruf . sprintf("%03s", $urutan);

		echo '
 
 <!-- App Capsule -->
    <div id="appCapsule">
        <div style="margin:0 16px;padding:10px 15px" class="section text-center">
          
            <img src="' . $site_url . '/content/' . $site_logo . '" height="70">
            <br>
            <br>
            <h4 style="color:black;">Sistem Informasi Pegawai <br> Persis 80 Al Amin </h4>
        </div>
        <div class="section mb-5 p-2">
            <form id="form-login">
                <div class="card">
                    <div class="card-body pb-1">
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="email1">NPP</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan NPP">
                                <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                            </div>
                        </div>
        
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="password1">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                                <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-links mt-2">
                    <div>
                       
                    </div>
                    <div>
                        <a class="btn btn-danger" href="#"><i class="fa fa-key mr-2"></i> Reset Password</a>
                    </div>
                </div>

                <div class="form-button-group transparent">
                   <button type="submit" class="btn btn-success btn-block"><ion-icon name="log-in"></ion-icon> Login</button>
                   <a href="#" class="btn btn-warning btn-block"><ion-icon name="logo-google"></ion-icon> Login with Google</a>
                </div>

            </form>
        </div>

    </div>
    <!-- * App Capsule -->';
	} else {
	}

	include_once 'mod/sw-footer.php';
}
