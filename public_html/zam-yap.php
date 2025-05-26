<?php
require_once 'header.php';
require_once 'navbar.php';
?>

<div class="container" >
    <h1 class="text-center mt-5">Zam Yap</h1>
    <form method="post" action="">
        <?php
        $cat_listele = $db->prepare("SELECT  kategori_adi FROM kategoriler");
        $cat_listele->execute();
        while ($satir = $cat_listele->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <button type="submit"  name="kat" class=" btn btn-success mt-3 mb-3" value="<?php echo $satir["kategori_adi"]?>"><?php echo $satir["kategori_adi"]?> </button>
        <?php }?>
    </form>
    <table class="table">
        <thead class="thead-dark" style="--bs-table-bg:black; --bs-table-color:white;">
        <tr style="text-align: center">
            <th scope="col">Ürün Kodu</th>
            <th scope="col">Marka</th>
            <th scope="col">Model </th>
            <th scope="col">İsim</th>
            <th scope="col">Adet</th>
            <th scope="col">Geliş Fiyatı</th>
            <th scope="col">Bayi Fiyatı</th>
            <th scope="col">Satış Fiyatı</th>
            <th scope="col">Kategori</th>
            <th scope="col">Zam Yap</th>


        </tr>
        </thead>
        <tbody >
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $buttonValue = $_POST["kat"];
        }
        $urun_listele = $db->prepare("SELECT kod,marka,model,isim,adet,gelis_fiyat,bayi_fiyat,fiyat,kategori  FROM urunler  WHERE kategori=?");
        $urun_listele->execute([ $buttonValue]);
        while ($sonuc = $urun_listele->fetch(PDO::FETCH_ASSOC)) {

            $adet = $sonuc['adet'];
            $kod = $sonuc['kod'];
            $marka = $sonuc['marka'];
            $model = $sonuc['model'];
            $isim = $sonuc['isim'];
            $fiyat = $sonuc['fiyat'];
            $bayi=$sonuc["bayi_fiyat"];
            $gelis=$sonuc["gelis_fiyat"];
            $kategori = $sonuc['kategori'];
            if(intval($adet)<=2){


                ?>
                <tr style="--bs-table-bg:red; --bs-table-color:white;text-align: center">
                    <th scope="row"><?php echo $sonuc["kod"];?></th>
                    <td><?php echo $sonuc["marka"];?></td>
                    <td><?php echo $sonuc["model"];?></td>
                    <td><?php echo $sonuc["isim"];?></td>
                    <td><?php echo $sonuc["adet"];?></td>
                    <td><?php echo $sonuc["gelis_fiyat"];?></td>
                    <td><?php echo $sonuc["bayi_fiyat"];?></td>
                    <td><?php echo $sonuc["fiyat"];?></td>
                    <td><?php echo $sonuc["kategori"];?></td>
                    <td><form method="post" action="zam-yap-devam.php"><button name="zam" class="btn btn-primary" value="<?php  echo $sonuc["kod"];?>">Zam Yap</button></form></td>
                </tr>
            <?php }
            else{ ?>
                <tr style="text-align: center">
                    <th scope="row"><?php echo $sonuc["kod"];?></th>
                    <td><?php echo $sonuc["marka"];?></td>
                    <td><?php echo $sonuc["model"];?></td>
                    <td><?php echo $sonuc["isim"];?></td>
                    <td><?php echo $sonuc["adet"];?></td>
                    <td><?php echo $sonuc["gelis_fiyat"];?></td>
                    <td><?php echo $sonuc["bayi_fiyat"];?></td>
                    <td><?php echo $sonuc["fiyat"];?></td>
                    <td><?php echo $sonuc["kategori"];?></td>
                    <td><form method="post" action="zam-yap-devam.php"><button name="zam" class="btn btn-primary" value="<?php  echo $sonuc["kod"];?>">Zam Yap</button></form></td>
                </tr>


            <?php }
        }?>
        </tbody>
    </table>


</div>


<?php
require_once 'footer.php';

?>
