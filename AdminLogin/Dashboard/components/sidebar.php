    <div class='page-content'>
    	<div class='row'>
		  <div class='col-md-2'>
		  	<div class='sidebar content-box' style='display: block;'>
                <ul class='nav'>
                    <!-- Main menu -->
                    <li><a href='index.php'><i class='glyphicon glyphicon-home'></i> Dashboard</a></li>
                    <li><a href='index.php?modules=pemesanan'><i class='glyphicon glyphicon-star-empty'></i> Pemesanan</a></li>
                    <li><a href='index.php?modules=struktur'><i class='glyphicon glyphicon-user'></i> Struktur Organisasi</a></li>
                    <?php 
                    if ($_SESSION['auth']<=1) {
                        echo "
                        <li class='submenu'>
                                 <a>
                                    <i class='glyphicon glyphicon-list'></i> Pengaturan
                                    <span class='caret pull-right'></span>
                                 </a>
                                 <!-- Sub menu -->
                                 <ul>
                                    <li><a href='index.php?modules=settingblok'>Pengaturan Blok</a></li>
                                </ul>
                                <ul>
                                    <li><a href='index.php?modules=settingsubblok'>Pengaturan Sub-Blok</a></li>
                                </ul>
                                <ul>
                                    <li><a href='index.php?modules=pilih'>Pengaturan Pilih Blok Yang Digunakan</a></li>
                                </ul>
                        </li>
                        <li><a href='index.php?modules=report'><i class='glyphicon glyphicon-stats'></i> Laporan</a></li>";
                    }

                     ?>
                    <li><a href='index.php?modules=back'><i class='glyphicon glyphicon-step-backward'></i> Logout & Back to klien web</a></li>
                </ul>
             </div>
		  </div>