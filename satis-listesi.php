<?php
require_once 'header.php';
require_once 'navbar.php';

?>

<div class="container" >
    <h1 class="text-center mt-5">Satış Listesi</h1>
    <div style="display: flex; justify-content: space-between; width: 100%">
        <form method="post" action="">
            <?php
            $cat_listele = $db->prepare("SELECT  kategori_adi FROM kategoriler");
            $cat_listele->execute();
            while ($satir = $cat_listele->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <button type="submit"  name="kat" class=" btn btn-success mt-3 mb-3" value="<?php echo $satir["kategori_adi"]?>"><?php echo $satir["kategori_adi"]?> </button>
            <?php }?>
        </form>
        <form class="form-inline my-2 mt-3 mb-3"style="display: flex; " method="post">
            <input id="search-input" class="form-control mr-sm-2 " name="aranan" style="margin-right: 5px" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" name="ara" type="submit" id="search-button">Ara</button>
        </form>
    </div>
    <table class="table">
        <thead class="thead-dark" style="--bs-table-bg:black; --bs-table-color:white;">
        <tr style="text-align: center">
            <th scope="col">Tarih</th>
            <th scope="col">Satış Yapan</th>
            <th scope="col">Ürün Kodu</th>
            <th scope="col">Marka</th>
            <th scope="col">İsim</th>
            <th scope="col">Adet</th>
            <th scope="col">Kategori</th>
            <th scope="col">Satış Türü</th>
            <th scope="col">Ödeme Türü</th>
            <th scope="col">Satış Açıklaması</th>
            <th scope="col">Satış Fiyatı</th>
            <th scope="col">Toplam Fiyat</th>

        </tr>
        </thead>
        <tbody>
        <?php
        if (isset($_POST["ara"])) {
        $aranan=strtoupper($_POST['aranan']);
        $urunsor=$db->prepare("SELECT * FROM satislar WHERE isim  LIKE  ?  OR   kod  LIKE  ? ");
        $urunsor->execute(array("%$aranan%","%$aranan%"));
        while ($sonuc = $urunsor->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr style="text-align: center">
                <th scope="row"><?php echo $sonuc["tarih"];?></th>
                <td><?php echo $sonuc["satici"];?></td>
                <td><?php echo $sonuc["kod"];?></td>
                <td><?php echo $sonuc["marka"];?></td>
                <td><?php echo $sonuc["isim"];?></td>
                <td><?php echo $sonuc["adet"];?></td>
                <td><?php echo $sonuc["Kategori"];?></td>
                <td><?php echo $sonuc["tur"];?></td>
                <td><?php echo $sonuc["odeme"];?></td>
                <td><?php echo $sonuc["model"];?></td>
                <td><?php echo $sonuc["fiyat"];?></td>
                <td><?php echo $sonuc["toplam_fiyat"];?></td>

            </tr>
        <?php
        }
        }
        else{
            $buttonValue="";
            if (isset($_POST["kat"])) {
                $buttonValue = $_POST["kat"];
             }
            $satis_listele = $db->prepare("SELECT tarih,kod,satici, marka,model,isim,adet, Kategori,tur,odeme,fiyat,toplam_fiyat  FROM satislar  WHERE Kategori=?");
            $satis_listele->execute([ $buttonValue]);
            while ($sonuc = $satis_listele->fetch(PDO::FETCH_ASSOC)) {

        ?>
        <tr style="text-align: center">
            <th scope="row"><?php echo $sonuc["tarih"];?></th>
            <td><?php echo $sonuc["satici"];?></td>
            <td><?php echo $sonuc["kod"];?></td>
            <td><?php echo $sonuc["marka"];?></td>
            <td><?php echo $sonuc["isim"];?></td>
            <td><?php echo $sonuc["adet"];?></td>
            <td><?php echo $sonuc["Kategori"];?></td>
            <td><?php echo $sonuc["tur"];?></td>
            <td><?php echo $sonuc["odeme"];?></td>
            <td><?php echo $sonuc["model"];?></td>
            <td><?php echo $sonuc["fiyat"];?></td>
            <td><?php echo $sonuc["toplam_fiyat"];?></td>

        </tr>
        <?php  }}
?>

        </tbody>
    </table>


</div>


<?php
require_once 'footer.php';

?>
