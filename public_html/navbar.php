<?php
$statu="";
$kullanici_get= $db->prepare("SELECT * FROM uyeler WHERE uye_id = ?");
$kullanici_get->execute(array($_SESSION['uye_id']));
$kul=$kullanici_get->fetch(PDO::FETCH_ASSOC);
$statu=$kul["statu"];
if($kul["statu"]=="1"){
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
    <a class="navbar-brand" href="#">Anasayfa</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="kasa.php"> Kasa</a>
            </li>
           <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Maaşlar
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="calisan_ekle.php">Çalışan Ekle</a>
                    <a class="dropdown-item" href="maas_ekle.php">Maaş  Ekle</a>
                    <a class="dropdown-item" href="maas_listele.php">Maaş Listesi</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="fiyat-degistir.php">Fiyat Değiştir</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Satışlar
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="satis-listesi.php">Satış Listesi</a>
                    <a class="dropdown-item" href="satis-yap.php">Satış Yap</a>

                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Kategoriler
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="kategori_ekle.php">Kategori Ekle</a>
                    <a class="dropdown-item" href="kategori-listesi.php">Kategori Listesi</a>

                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Ürünler
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="urun_ekle.php">Ürün Ekle</a>
                    <a class="dropdown-item" href="#">Ürün Güncelle</a>
                    <a class="dropdown-item" href="urun-listesi.php">Ürün Listesi</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Teknik Servisler
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="teknik_servis_ekle.php">Teknik Servis Ekle</a>
                    <a class="dropdown-item" href="servis_listesi.php">Teknik Servis Listesi</a>

                </div>
            </li>
        </ul>

    </div>
    <a class="navbar-brand " href="logout.php">Çıkış Yap</a>
</nav>
<?php }
else{
 ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
    <a class="navbar-brand" href="#">Anasayfa</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"  disabled>
                <a class="nav-link disabled" href="#" > Kasa</a>
            </li>
             <li class="nav-item dropdown" disabled>
                <a  class="nav-link dropdown-toggle disabled" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Maaşlar
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" >
                    <a class="dropdown-item" href="calisan_ekle.php">Çalışan Ekle</a>
                    <a class="dropdown-item" href="maas_ekle.php">Maaş  Ekle</a>
                    <a class="dropdown-item" href="maas_listele.php">Maaş Listesi</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="fiyat-degistir.php">Fiyat Değiştir</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Satışlar
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="satis-listesi.php">Satış Listesi</a>
                    <a class="dropdown-item" href="satis-yap.php">Satış Yap</a>

                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Kategoriler
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="kategori_ekle.php">Kategori Ekle</a>
                    <a class="dropdown-item" href="kategori-listesi.php">Kategori Listesi</a>

                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Ürünler
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="urun_ekle.php">Ürün Ekle</a>
                    <a class="dropdown-item" href="#">Ürün Güncelle</a>
                    <a class="dropdown-item" href="urun-listesi.php">Ürün Listesi</a>
                </div>
            </li>
             <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Teknik Servisler
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="teknik_servis_ekle.php">Teknik Servis Ekle</a>
                    <a class="dropdown-item" href="servis_listesi.php">Teknik Servis Listesi</a>

                </div>
            </li>
        </ul>

    </div>
    <a class="navbar-brand " href="logout.php">Çıkış Yap</a>
</nav>
<?php }?>