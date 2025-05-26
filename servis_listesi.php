<?php
require_once 'header.php';
require_once 'navbar.php';

$sonuc = [];
?>

<div class="container">
    <h1 class="text-center mt-5">Teknik Servis Listesi</h1>
    <div style="display: flex; justify-content: space-between; width: 100%">
        <form method="post" action="">
            <button type="submit" name="yil" class="btn btn-success mt-3 mb-3" value="2024">2024</button>
            <button type="submit" name="yil" class="btn btn-success mt-3 mb-3" value="2025">2025</button>
            <button type="submit" name="yil" class="btn btn-success mt-3 mb-3" value="2026">2026</button>
        </form>
        <form class="form-inline my-2 mt-3 mb-3" style="display: flex;" method="post">
            <input id="search-input" class="form-control mr-sm-2" name="aranan" style="margin-right: 5px" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" name="ara" type="submit" id="search-button">Ara</button>
        </form>
    </div>

    <table class="table">
        <thead class="thead-dark" style="--bs-table-bg:black; --bs-table-color:white;">
            <tr style="text-align: center">
                <th>İd</th>
                <th scope="col">Tarih</th>
                <th scope="col">Müşteri</th>
                <th scope="col">Adres</th>
                <th scope="col">Telefon</th>
                <th scope="col">Cihaz Bilgisi</th>
                <th scope="col">Seri No</th>
                <th scope="col">Toplam Fiyat</th>
                <th scope="col">Yıl</th>
                <th scope="col">Düzenle</th>
                <th scope="col">İzle</th>
                <th scope="col">Sil</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Arama işlemi
        if (isset($_POST["ara"])) {
            $aranan = strtoupper($_POST['aranan']);
            $servissor = $db->prepare("SELECT * FROM teknikservis WHERE musteri_adi LIKE ? OR serino LIKE ?");
            $servissor->execute(array("%$aranan%", "%$aranan%"));
            while ($sonuc = $servissor->fetch(PDO::FETCH_ASSOC)) {
        ?>
            <tr style="text-align: center">
                <th scope="row"><?php echo htmlspecialchars($sonuc["servis_id"]); ?></th>
                <td><?php echo htmlspecialchars($sonuc["tarih"]); ?></td>
                <td><?php echo htmlspecialchars($sonuc["musteri_adi"]); ?></td>
                <td><?php echo htmlspecialchars($sonuc["adres"]); ?></td>
                <td><?php echo htmlspecialchars($sonuc["telefon"]); ?></td>
                <td><?php echo htmlspecialchars($sonuc["cihaz"]); ?></td>
                <td><?php echo htmlspecialchars($sonuc["serino"]); ?></td>
                <td><?php echo htmlspecialchars($sonuc["toplam"]); ?></td>
                <td><?php echo htmlspecialchars($sonuc["yil"]); ?></td>
                <td>
                    <form method="post" action="teknik_servis_guncelle.php">
                        <button name="guncel" class="btn btn-primary" value="<?php echo htmlspecialchars($sonuc["servis_id"]); ?>">Düzenle</button>
                    </form>
                </td>
                 <td>
                    <form method="post" action="teknik_servis_izle.php">
                        <button name="guncel" class="btn btn-primary" value="<?php echo htmlspecialchars($sonuc["serino"]); ?>">İzle</button>
                    </form>
                </td>
                <td>
                    <form method="post" action="teknik_servis_sil.php">
                        <button class="btn btn-danger" name="sil" value="<?php echo htmlspecialchars($sonuc["servis_id"]); ?>">Sil</button>
                    </form>
                </td>
            </tr>
        <?php 
            }
        } 
        // Yıl seçimi işlemi
        elseif (isset($_POST["yil"])) {
            $buttonValue = $_POST["yil"];
            $servis_listele = $db->prepare("SELECT * FROM teknikservis WHERE yil = ?");
            $servis_listele->execute([$buttonValue]);
            while ($sonuc = $servis_listele->fetch(PDO::FETCH_ASSOC)) {
        ?>
            <tr style="text-align: center">
                <th scope="row"><?php echo htmlspecialchars($sonuc["servis_id"]); ?></th>
                <td><?php echo htmlspecialchars($sonuc["tarih"]); ?></td>
                <td><?php echo htmlspecialchars($sonuc["musteri_adi"]); ?></td>
                <td><?php echo htmlspecialchars($sonuc["adres"]); ?></td>
                <td><?php echo htmlspecialchars($sonuc["telefon"]); ?></td>
                <td><?php echo htmlspecialchars($sonuc["cihaz"]); ?></td>
                <td><?php echo htmlspecialchars($sonuc["serino"]); ?></td>
                <td><?php echo htmlspecialchars($sonuc["toplam"]); ?></td>
                <td><?php echo htmlspecialchars($sonuc["yil"]); ?></td>
                <td>
                    <form method="post" action="teknik_servis_guncelle.php">
                        <button name="guncel" class="btn btn-primary" value="<?php echo htmlspecialchars($sonuc["servis_id"]); ?>">Düzenle</button>
                    </form>
                </td>
                 <td>
                    <form method="post" action="teknik_servis_izle.php">
                        <button name="guncel" class="btn btn-primary" value="<?php echo htmlspecialchars($sonuc["serino"]); ?>">İzle</button>
                    </form>
                </td>
                <td>
                    <form method="post" action="teknik_servis_sil.php">
                        <button class="btn btn-danger" name="sil" value="<?php echo htmlspecialchars($sonuc["servis_id"]); ?>">Sil</button>
                    </form>
                </td>
            </tr>
        <?php 
            }
        } 
        // Koşulsuz listeleme
        else {
            $servisgetir = $db->prepare("SELECT * FROM teknikservis");
            $servisgetir->execute();
            while ($sonuc = $servisgetir->fetch(PDO::FETCH_ASSOC)) {
        ?>
            <tr style="text-align: center">
                <th scope="row"><?php echo htmlspecialchars($sonuc["servis_id"]); ?></th>
                <td><?php echo htmlspecialchars($sonuc["tarih"]); ?></td>
                <td><?php echo htmlspecialchars($sonuc["musteri_adi"]); ?></td>
                <td><?php echo htmlspecialchars($sonuc["adres"]); ?></td>
                <td><?php echo htmlspecialchars($sonuc["telefon"]); ?></td>
                <td><?php echo htmlspecialchars($sonuc["cihaz"]); ?></td>
                <td><?php echo htmlspecialchars($sonuc["serino"]); ?></td>
                <td><?php echo htmlspecialchars($sonuc["toplam"]); ?></td>
                <td><?php echo htmlspecialchars($sonuc["yil"]); ?></td>
                <td>
                    <form method="post" action="teknik_servis_guncelle.php">
                        <button name="guncel" class="btn btn-primary" value="<?php echo htmlspecialchars($sonuc["servis_id"]); ?>">Düzenle</button>
                    </form>
                </td>
                 <td>
                    <form method="post" action="teknik_servis_izle.php">
                        <button name="guncel" class="btn btn-primary" value="<?php echo htmlspecialchars($sonuc["serino"]); ?>">İzle</button>
                    </form>
                </td>
                <td>
                    <form method="post" action="teknik_servis_sil.php">
                        <button class="btn btn-danger" name="sil" value="<?php echo htmlspecialchars($sonuc["servis_id"]); ?>">Sil</button>
                    </form>
                </td>
            </tr>
        <?php 
            }
        }
        ?>
        </tbody>
    </table>
</div>

<?php
require_once 'footer.php';
?>
