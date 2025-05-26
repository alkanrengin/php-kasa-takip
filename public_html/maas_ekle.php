<?php
require_once 'header.php';
require_once 'navbar.php';

$calisan = null;
$maas = null;
$msg = '';
$status = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $calisan = $_POST["calisan"];
    $odenen = strtoupper($_POST["odenen"]);
    $tarih = $_POST["tarih"];
    $gelmedigi_gun = $_POST["gelmedigi_gun"];
    $odenecek_tutar = $_POST["odenecek_tutar"]; // Ödenecek tutar alanı
    
    if (empty($calisan) || empty($odenen) || empty($tarih) || empty($gelmedigi_gun) || empty($odenecek_tutar)) {
        $msg = 'Tüm alanları doldurun.';
        $status = 'alert-danger';
    } else {
        $netMaas = $db->prepare('SELECT maas, calisan FROM calisanlar WHERE id = ?');
        $netMaas->execute([$calisan]);
        $sorgu = $netMaas->fetch(PDO::FETCH_ASSOC);
        
        if ($sorgu) {
            // Günlük maaşı hesapla
            $gunluk_maas = $sorgu["maas"] / 30;
            $kesinti = $gelmedigi_gun * $gunluk_maas; // Kesinti hesaplama
            $bu_ay_maas = $sorgu["maas"] - $kesinti; // Kesintili maaş
            
            // Maaşı veritabanına ekle
            $calisan_ekle = $db->prepare("INSERT INTO maaslar (calisan_id, odenen, tarih, net_maas, ads, gun, buay) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $calisan_ekle->execute([$calisan,  $odenecek_tutar, $tarih, $sorgu["maas"], $sorgu["calisan"], $gelmedigi_gun, $bu_ay_maas]);
            
            if ($calisan_ekle) {
                $msg = 'Kayıt işlemi tamamlandı. Ödenecek Tutar: ' . number_format($odenecek_tutar, 2) . ' TL';
                $status = 'alert-success';
            } else {
                $msg = 'Bir sorun oluştu.';
                $status = 'alert-danger';
            }
        } else {
            $msg = 'Çalışan bulunamadı.';
            $status = 'alert-danger';
        }
    }
}
?>

<div class="container">
    <h1 class="text-center mt-5">Maaş Ödemesi Ekle</h1>
    <form method="post" action="">
        <div class="form-group">
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
        </div>
        <?php if ($calisan) {
            $netMaas1 = $db->prepare('SELECT maas FROM calisanlar WHERE id = ?');
            $netMaas1->execute([$calisan]);
            $sorgu1 = $netMaas1->fetch(PDO::FETCH_ASSOC);
        ?>
        <div class="form-group">
            <label for="net_maas">Net Maaş</label>
            <input disabled type="text" class="form-control" id="net_maas" value="<?php echo htmlspecialchars($sorgu1["maas"]); ?>" name="netmaas" placeholder="Net Maaş">
        </div>
        <?php } ?>
        
        <div class="form-group">
            <label for="gelmedigi_gun">Gelmediği Gün Sayısı</label>
            <input type="number" class="form-control" id="gelmedigi_gun" name="gelmedigi_gun" placeholder="Gelmediği Gün Sayısı" oninput="hesaplaOdenecekMaas()">
        </div>

        <div class="form-group">
            <label for="bu_ay_maas">Bu Ay Ödenecek Maaş (Kesintili)</label>
            <input type="text" class="form-control" id="bu_ay_maas" name="bu_ay_maas" placeholder="Bu Ay Ödenecek Maaş" readonly>
        </div>

        <div class="form-group">
            <label for="odenecek_tutar">Ödenecek Tutar</label>
            <input type="text" class="form-control" id="odenecek_tutar" name="odenecek_tutar" placeholder="Ödenecek Tutar">
        </div>
        
        <div class="form-group">
            <label for="tarih">Tarih</label>
            <input type="date" class="form-control" id="tarih" name="tarih">
        </div>

        <?php if ($msg) { ?>
            <div class="alert mt-3 <?php echo $status; ?>" role="alert">
                <?php echo $msg; ?>
            </div>
        <?php } ?>

        <button type="submit" class="btn btn-primary mt-3 w-100">Ödeme Ekle</button>
    </form>
</div>

<script>
    function hesaplaOdenecekMaas() {
        // Net maaş inputundaki değeri al
        const netMaas = parseFloat(document.getElementById('net_maas').value);
        const gelmedigiGun = parseFloat(document.getElementById('gelmedigi_gun').value);

        // Gün sayısı ve net maaşın doğruluğunu kontrol et
        if (!isNaN(netMaas) && !isNaN(gelmedigiGun) && gelmedigiGun >= 0) {
            const gunlukMaas = netMaas / 30;
            const kesinti = gelmedigiGun * gunlukMaas;
            const odenecekMaas = netMaas - kesinti;

            // Ödenecek maaş inputunu güncelle
            document.getElementById('bu_ay_maas').value = odenecekMaas.toFixed(2) + " TL";
        }
    }
</script>

<?php require_once 'footer.php'; ?>
