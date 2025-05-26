<?php
require_once 'header.php';
require_once 'navbar.php';
$msg = '';
$status = '';

if (isset($_POST["dene"])) {
    $id = $_POST["id"];
    $servis_sil = $db->prepare("DELETE FROM teknikservis WHERE servis_id = ?");
    $servis_sil->execute([$id]);
    if ($servis_sil) {
        $msg = 'Silme işlemi tamamlandı.';
        $status = 'alert-success';
        header('Location: urun-listesi.php');
        exit;
    } else {
        $msg = 'Üye kaydı başarısız. Bir sorun oluştu.';
        $status = 'alert-danger';
    }
}
?>
<div class="container">
    <h1 class="text-center mt-5">Teknik Servis Güncelle</h1>
    <form method="post" action="">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sil"])) {
            $buttonValue = $_POST["sil"];
            $s_getir = $db->prepare("SELECT * FROM teknikservis WHERE servis_id = ?");
            $s_getir->execute([$buttonValue]);
            $sorgu = $s_getir->fetch(PDO::FETCH_ASSOC);
            ?>
            <div class="form-group">
                <label for="urun_kodu">İd</label>
                <input type="text" class="form-control" name="id" aria-describedby="emailHelp" value="<?php echo htmlspecialchars($sorgu["servis_id"]); ?>" placeholder="İd">
            </div>
            <div class="form-group">
                <label for="urun_kodu">Müşteri Adı</label>
                <input type="text" class="form-control" name="musteri" aria-describedby="emailHelp" value="<?php echo htmlspecialchars($sorgu["musteri_adi"]); ?>" placeholder="Müşteri Adı">
            </div>
            <div class="form-group">
                <label for="marka">Adres</label>
                <input type="text" class="form-control" name="adres" aria-describedby="emailHelp" value="<?php echo htmlspecialchars($sorgu["adres"]); ?>" placeholder="Adres">
            </div>
            <div class="form-group">
                <label for="isim">Telefon</label>
                <input type="text" class="form-control" name="tel" aria-describedby="emailHelp" value="<?php echo htmlspecialchars($sorgu["telefon"]); ?>" placeholder="Telefon">
            </div>
            <div class="form-group">
                <label for="adet">Cihaz Bilgisi</label>
                <input type="text" class="form-control" name="cihaz" aria-describedby="emailHelp" value="<?php echo htmlspecialchars($sorgu["cihaz"]); ?>" placeholder="Cihaz Bilgisi">
            </div>
            <div class="form-group">
                <label for="fiyat">Seri No</label>
                <input type="text" class="form-control" name="serino" aria-describedby="emailHelp" value="<?php echo htmlspecialchars($sorgu["serino"]); ?>" placeholder="Seri No">
            </div>
            <div class="form-group">
                <label for="fiyat">Şikayet</label>
                <input type="text" class="form-control" name="sikayet" aria-describedby="emailHelp" value="<?php echo htmlspecialchars($sorgu["sikayet"]); ?>" placeholder="Şikayet">
            </div>
            <div class="form-group">
                <label for="fiyat">Ürün Sarf Durumu</label>
                <select class="form-select form-select-lg mb-3" name="sarf" aria-label=".form-select-lg example">
                    <option selected><?php echo htmlspecialchars($sorgu["sarf_durumu"]); ?></option>
                    <option value="var">Var</option>
                    <option value="yok">Yok</option>
                    <option value="orjinal">Orjinal</option>
                    <option value="muadil">Muadil</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fiyat">Ürün Kontrolü</label>
                <select class="form-select form-select-lg mb-3" name="kontrol" aria-label=".form-select-lg example">
                    <option selected><?php echo htmlspecialchars($sorgu["urun_kontrol"]); ?></option>
                    <option value="var">Yapıldı</option>
                    <option value="yok">Yapılmadı</option>
                </select>
            </div>
            <div class="form-group">
                <label for="model">Ürün Yanında</label>
                <input type="text" class="form-control" name="yaninda" aria-describedby="emailHelp" value="<?php echo htmlspecialchars($sorgu["urun_yaninda"]); ?>" placeholder="Ürün Yanında">
            </div>
            <div class="form-group">
                <label for="adet">Yapılan İşlem</label>
                <input type="text" class="form-control" name="islem" aria-describedby="emailHelp" value="<?php echo htmlspecialchars($sorgu["islem1"]); ?>" placeholder="Yapılan İşlem">
            </div>
            <div class="form-group">
                <label for="adet">Birim</label>
                <input type="text" class="form-control" name="birim" aria-describedby="emailHelp" value="<?php echo htmlspecialchars($sorgu["birim"]); ?>" placeholder="Birim">
            </div>
            <div class="form-group">
                <label for="adet">Fiyat</label>
                <input type="text" class="form-control" name="fiyat" aria-describedby="emailHelp" value="<?php echo htmlspecialchars($sorgu["fiyat"]); ?>" placeholder="Fiyat">
            </div>
            <div class="form-group">
                <label for="fiyat">Yıl</label>
                <select class="form-select form-select-lg mb-3" name="yil" aria-label=".form-select-lg example">
                    <option selected><?php echo htmlspecialchars($sorgu["yil"]); ?></option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fiyat">Müşteri Teslim Etti</label>
                <select class="form-select form-select-lg mb-3" name="musteri_geldi" aria-label=".form-select-lg example">
                    <option selected><?php echo htmlspecialchars($sorgu["musteri_geldi"]); ?></option>
                    <option value="evet">Evet</option>
                    <option value="hayir">Hayır</option>
                </select>
            </div>
            <?php
        }
        ?>
        <?php
        if (isset($msg)) { ?>
            <div class="alert mt-3 <?php echo $status; ?>" role="alert">
                <?php echo $msg; ?>
            </div>
        <?php } ?>
        <button type="submit" class="btn btn-primary mt-3 w-100" name="dene">Teknik Servis Sil</button>
    </form>
    <a class="btn btn-primary mt-3 w-100" href="urun-listesi.php">Geri Dön</a>
</div>

<?php
require_once 'footer.php';
?>
