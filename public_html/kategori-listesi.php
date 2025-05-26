<?php
require_once 'header.php';
require_once 'navbar.php';


$sonuc=[];
?>

<div class="container" >
    <h1 class="text-center mt-5">Kategori Listesi</h1>
    <div style="display: flex; justify-content: space-between; width: 100%">
        <form class="form-inline my-2 mt-3 mb-3"style="display: flex; " method="post">
            <input id="search-input" class="form-control mr-sm-2 " name="aranan" style="margin-right: 5px" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" name="ara" type="submit" id="search-button">Ara</button>
        </form>
    </div>

    <table class="table">
        <thead class="thead-dark" style="--bs-table-bg:black; --bs-table-color:white;">
        <tr style="text-align: center">
            <th scope="col">İD</th>
            <th scope="col">Kategori Adı</th>
            <th scope="col">Sil</th>
        </tr>
        </thead>
        <tbody >
        <?php
        if (isset($_POST["ara"])) {
            $aranan=strtoupper($_POST['aranan']);
            $urunsor=$db->prepare("SELECT * FROM kategoriler WHERE kategori_adi  LIKE  ?  ");
            $urunsor->execute(array("%$aranan%"));
            while ($sonuc = $urunsor->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr style="text-align: center">
                        <td><?php echo $sonuc["id"];?></td>
                         <td><?php echo $sonuc["kategori_adi"];?></td>
                        <td><form method="post" action=""><button style="background-color: white; color: darkred"  class="btn btn-danger"name="sil" value="<?php  echo $sonuc["id"];?>">Sil</button></form></td>
                    </tr><?php }}
        else{
             $cat_listele = $db->prepare("SELECT  kategori_adi, id FROM kategoriler");
             $cat_listele->execute();
            while ($sonuc = $cat_listele->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr style="text-align: center">
                        <td><?php echo $sonuc["id"];?></td>
                        <td><?php echo $sonuc["kategori_adi"];?></td>
                        <td><form method="post" action=""><button style="background-color: white; color: darkred"  class="btn btn-danger"name="silcat" value="<?php  echo $sonuc["id"];?>">Sil</button></form></td>
                    </tr>
                <?php }
        }
        if (isset($_POST["silcat"])) {
            $id =$_POST["silcat"];
            $urun_sil = $db->prepare("DELETE FROM kategoriler   WHERE id = ?");
            $urun_sil->execute([$id]);
        }

        ?>

        </tbody>
    </table>


</div>


<?php
require_once 'footer.php';

?>
