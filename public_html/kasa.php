<?php
require_once 'header.php';
require_once 'navbar.php';
if ($statu=="2") {
    header('Location:index.php');
}
?>

<div class="container" >
    <h1 class="text-center mt-5">Kasa</h1>
    <form method="post" action="">
        <button type="submit"  name="gun" class=" btn btn-success mt-3 mb-3" value="">Günlük</button>
        <button type="submit"  name="hafta" class=" btn btn-success mt-3 mb-3" value="">Haftalık</button>
        <button type="submit"  name="ay" class=" btn btn-success mt-3 mb-3" value="">Aylık</button>
    </form>
    <table class="table">
        <thead class="thead-dark" style="--bs-table-bg:black; --bs-table-color:white;">
        <tr style="text-align: center">
            <th scope="col">Tarih</th>
            <th scope="col">Ürün Kodu</th>
            <th scope="col">Marka</th>
            <th scope="col">Açıklama </th>
            <th scope="col">İsim</th>
            <th scope="col">Adet</th>
            <th scope="col">Kategori</th>
            <th scope="col">Ödeme Türü</th>
            <th scope="col">Satış Türü</th>
            <th scope="col">Satış Fiyatı</th>
            <th scope="col">Toplam Fiyat</th>

        </tr>
        </thead>
        <tbody >
        <?php

        $toplamkasa=0;
        if(isset($_POST["gun"])){
        $satis_listele = $db->prepare("SELECT tarih,kod,marka,model,isim,adet, Kategori,fiyat,tur,odeme,toplam_fiyat  FROM satislar WHERE t2=CURDATE()  ORDER BY tarih ASC ");
        $satis_listele->execute();
        while ($sonuc = $satis_listele->fetch(PDO::FETCH_ASSOC)) {
            $adet = $sonuc['adet'];
            $tarih=$sonuc["tarih"];
            $kod = $sonuc['kod'];
            $marka = $sonuc['marka'];
            $model = $sonuc['model'];
            $isim = $sonuc['isim'];
            $fiyat = $sonuc['fiyat'];
            $kategori = $sonuc['Kategori'];
            $toplam = $sonuc['toplam_fiyat'];
            $toplamkasa=$toplamkasa+intval($toplam);

            ?>
            <tr style="text-align: center">
                <th scope="row"><?php echo $sonuc["tarih"];?></th>
                <td><?php echo $sonuc["kod"];?></td>
                <td><?php echo $sonuc["marka"];?></td>
                <td><?php echo $sonuc["model"];?></td>
                <td><?php echo $sonuc["isim"];?></td>
                <td><?php echo $sonuc["adet"];?></td>
                <td><?php echo $sonuc["Kategori"];?></td>
                <td><?php echo $sonuc["odeme"];?></td>
                <td><?php echo $sonuc["tur"];?></td>
                <td><?php echo $sonuc["fiyat"];?></td>
                <td><?php echo $sonuc["toplam_fiyat"];?></td>
            </tr>
        <?php }}?>
        <?php
        if(isset($_POST["hafta"])){
            $satis_listele = $db->prepare("SELECT tarih,kod,marka,model,isim,adet, Kategori,fiyat,tur,odeme,toplam_fiyat  FROM satislar WHERE t2 BETWEEN NOW() - INTERVAL 7 DAY AND NOW()  ORDER BY tarih ASC ");
            $satis_listele->execute();
            while ($sonuc = $satis_listele->fetch(PDO::FETCH_ASSOC)) {
                $adet = $sonuc['adet'];
                $tarih=$sonuc["tarih"];
                $kod = $sonuc['kod'];
                $marka = $sonuc['marka'];
                $model = $sonuc['model'];
                $isim = $sonuc['isim'];
                $fiyat = $sonuc['fiyat'];
                $kategori = $sonuc['Kategori'];
                $toplam = $sonuc['toplam_fiyat'];
                $toplamkasa=$toplamkasa+intval($toplam);

                ?>
                <tr style="text-align: center">
                    <th scope="row"><?php echo $sonuc["tarih"];?></th>
                    <td><?php echo $sonuc["kod"];?></td>
                    <td><?php echo $sonuc["marka"];?></td>
                    <td><?php echo $sonuc["model"];?></td>
                    <td><?php echo $sonuc["isim"];?></td>
                    <td><?php echo $sonuc["adet"];?></td>
                    <td><?php echo $sonuc["Kategori"];?></td>
                    <td><?php echo $sonuc["odeme"];?></td>
                    <td><?php echo $sonuc["tur"];?></td>
                    <td><?php echo $sonuc["fiyat"];?></td>
                    <td><?php echo $sonuc["toplam_fiyat"];?></td>
                </tr>
            <?php }}?>
        <?php
        if(isset($_POST["ay"])){
            $satis_listele = $db->prepare("SELECT tarih,kod,marka,model,isim,adet, Kategori,fiyat,tur,odeme,toplam_fiyat  FROM satislar WHERE t2 BETWEEN NOW() - INTERVAL 30 DAY AND NOW()  ORDER BY tarih ASC ");
            $satis_listele->execute();
            while ($sonuc = $satis_listele->fetch(PDO::FETCH_ASSOC)) {
                $adet = $sonuc['adet'];
                $tarih=$sonuc["tarih"];
                $kod = $sonuc['kod'];
                $marka = $sonuc['marka'];
                $model = $sonuc['model'];
                $isim = $sonuc['isim'];
                $fiyat = $sonuc['fiyat'];
                $kategori = $sonuc['Kategori'];
                $toplam = $sonuc['toplam_fiyat'];
                $toplamkasa=$toplamkasa+intval($toplam);

                ?>
                <tr style="text-align: center">
                    <th scope="row"><?php echo $sonuc["tarih"];?></th>
                    <td><?php echo $sonuc["kod"];?></td>
                    <td><?php echo $sonuc["marka"];?></td>
                    <td><?php echo $sonuc["model"];?></td>
                    <td><?php echo $sonuc["isim"];?></td>
                    <td><?php echo $sonuc["adet"];?></td>
                    <td><?php echo $sonuc["Kategori"];?></td>
                    <td><?php echo $sonuc["odeme"];?></td>
                    <td><?php echo $sonuc["tur"];?></td>
                    <td><?php echo $sonuc["fiyat"];?></td>
                    <td><?php echo $sonuc["toplam_fiyat"];?></td>
                </tr>
            <?php }}?>





        <tr style="text-align: center;--bs-table-bg:black; --bs-table-color:white; ">
            <th scope="row">Toplam Kasa</th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><?php echo $toplamkasa?></td>

        </tr>
        </tbody>
    </table>


</div>


<?php
require_once 'footer.php';

?>
