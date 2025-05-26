<?php
require_once 'header.php';
require_once 'navbar.php';
$sonuc = [];
$calisan = '';
?>

<div class="container">
    <h1 class="text-center mt-5">Maaş Listesi</h1>
    <div style="display: flex; justify-content: space-between; width: 100%">
        <form method="post" action="">
            <label for="calisan">Çalışanı Seç</label>
            <select class="form-select form-select-lg mb-3" name="calisan" aria-label=".form-select-lg example" onchange="this.form.submit()">
                <option value="" selected>Çalışanı Seç</option>
                <?php
                $calisan_listele = $db->prepare("SELECT id, calisan FROM calisanlar");
                $calisan_listele->execute();
                while ($res = $calisan_listele->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <option value="<?php echo $res["id"]; ?>" <?php echo ($calisan == $res["id"]) ? 'selected' : ''; ?>><?php echo $res["calisan"]; ?></option>
                <?php } ?>
            </select>
        </form>
        <form class="form-inline my-2 mt-3 mb-3" style="display: flex;" method="post">
            <input id="search-input" class="form-control mr-sm-2" name="aranan" style="margin-right: 5px" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" name="ara" type="submit" id="search-button">Ara</button>
        </form>
    </div>

    <table class="table">
        <thead class="thead-dark" style="--bs-table-bg:black; --bs-table-color:white;">
            <tr style="text-align: center">
                <th scope="col">Tarih</th>
                <th scope="col">Çalışan </th>
                <th scope="col">Net Maaş</th>
                <th scope="col">Ödenen Maaş</th>
                <th scope="col">Kalan Maaş</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Arama işlemi
        if (isset($_POST["ara"])) {
            $aranan = strtoupper($_POST['aranan']);
            $maassor = $db->prepare("SELECT * FROM maaslar WHERE calisan LIKE ? OR yiladi LIKE ?");
            $maassor->execute(array("%$aranan%", "%$aranan%"));
            while ($sonuc = $maassor->fetch(PDO::FETCH_ASSOC)) {
                $kalan = intval($sonuc["net_maas"]) - intval($sonuc["odenen"]);
        ?>
            <tr style="text-align: center">
                <td><?php echo htmlspecialchars($sonuc["tarih"]); ?></td>
                <td><?php echo htmlspecialchars($sonuc["ads"]); ?></td>
                <td><?php echo htmlspecialchars($sonuc["net_maas"]); ?></td>
                <td><?php echo htmlspecialchars($sonuc["odenen"]); ?></td>
                <td><?php echo htmlspecialchars($kalan); ?></td>
    
          
            </tr>
        <?php 
            }
        } elseif (isset($_POST["calisan"])) {
            $buttonValue = $_POST["calisan"];
            $servis_listele = $db->prepare("SELECT * FROM maaslar WHERE calisan_id = ?");
            $servis_listele->execute([$buttonValue]);
            while ($sonuc = $servis_listele->fetch(PDO::FETCH_ASSOC)) {
                $kalan = intval($sonuc["net_maas"]) - intval($sonuc["odenen"]);
        ?>
            <tr style="text-align: center">
                <td><?php echo htmlspecialchars($sonuc["tarih"]); ?></td>
                <td><?php echo htmlspecialchars($sonuc["ads"]); ?></td>
                <td><?php echo htmlspecialchars($sonuc["net_maas"]); ?></td>
                <td><?php echo htmlspecialchars($sonuc["odenen"]); ?></td>
                <td><?php echo htmlspecialchars($kalan); ?></td>
             
         
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
