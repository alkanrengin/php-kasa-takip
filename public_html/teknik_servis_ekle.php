<?php
require_once 'header.php';
require_once 'navbar.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $yil =strtoupper($_POST["yil"]);
    $musteri =strtoupper($_POST["musteri"]);
    $tarih=date('Y-m-d H:i:s');
    $tel =strtoupper($_POST["tel"]);
    $cihaz =strtoupper($_POST["cihaz"]);
    $serino =$_POST["serino"];
    $yuzde=$_POST["yuzde"];
    $sarf=$_POST["sarf"];
    $kontrol=$_POST["kontrol"];
    $sikayet=$_POST["sikayet"];
    $yaninda=$_POST["yaninda"];
    $ariza=$_POST["ariza"];
    $musteri_geldi=$_POST["musteri_geldi"];
    
 if (empty($yil) || empty($musteri) || empty($tel) || empty($cihaz) || empty($serino) || empty($sarf) || empty($kontrol) || empty($yaninda) || empty($musteri_geldi) ) {
        $msg = 'Alanları doldurun.';
        $status = 'alert-danger';
    } else {
        try {
            $servis_ekle = $db->prepare("INSERT INTO teknikservis (musteri_adi,  telefon, cihaz, serino, sikayet,ariza, sarf_durumu,sarf_yuzde, urun_kontrol, urun_yaninda,  musteri_geldi, tarih, yil) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
            $result = $servis_ekle->execute(array($musteri, $tel, $cihaz, $serino, $sikayet,$ariza, $sarf, $yuzde,$kontrol, $yaninda,  $musteri_geldi, $tarih, $yil));
            
            if ($result) {
                $msg = 'Kayıt işlemi tamamlandı.';
                $status = 'alert-success';
            } else {
                $msg = 'Servis kaydı başarısız. Bir sorun oluştu.';
                $status = 'alert-danger';
            }
        } catch (PDOException $e) {
            $msg = 'Veritabanı hatası: ' . $e->getMessage();
            $status = 'alert-danger';
        }
    }
}
?>
<div class="container" >
    <h1 class="text-center mt-5">Teknik Servis Ekle</h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="urun_kodu">Müşteri Adı/Firma Adı</label>
            <input type="text" class="form-control" name="musteri" aria-describedby="emailHelp" placeholder="Müşteri Adı">
        </div>
        <div class="form-group">
            <label for="isim">Telefon</label>
            <input type="text" class="form-control" name="tel" aria-describedby="emailHelp" placeholder="Telefon">
        </div>
        <div class="form-group">
            <label for="adet">Cihaz Bilgisi</label>
            <input type="text" class="form-control" name="cihaz" aria-describedby="emailHelp" placeholder="Cihaz Bilgisi">
        </div>
        <div class="form-group">
            <label for="fiyat"> Seri No</label>
            <input type="text" class="form-control" name="serino" aria-describedby="emailHelp" placeholder="Seri No">
        </div>
         <div class="form-group">
            <label for="fiyat"> Şikayet</label>
            <input type="text" class="form-control" name="sikayet" aria-describedby="emailHelp" placeholder="Şikayet">
        </div>
     
        <div class="form-group">
            <label for="fiyat">Ürün Sarf Durumu</label>
            <select class="form-select form-select-lg mb-3" name="sarf" aria-label=".form-select-lg example">
                <option selected> Seç</option>
               
                <option value="var">Var</option>
                 <option value="yok">Yok</option>
                 <option value="orjinal">Orjinal</option>
                 <option value="muadil ">Muadil</option>
                
            </select>
        </div>
         <div class="form-group" id="conditionalInput" style="display: none;">
            <label for="model">Sarf Yüzdesi</label>
            <input type="text" class="form-control" name="yuzde" aria-describedby="emailHelp" placeholder="Sarf Yüzdesi">
        </div>
          <div class="form-group">
            <label for="fiyat">Ürün Kontrolü</label>
             <input type="text" class="form-control" name="kontrol" aria-describedby="emailHelp" placeholder="Ürün Kontrolü">
        </div>
        <div class="form-group">
            <label for="model">Ürün Yanında</label>
            <input type="text" class="form-control" name="yaninda" aria-describedby="emailHelp" placeholder="Ürün Yanında">
        </div>
          <div class="form-group">
            <label for="adet">Arıza Tespit Ücreti</label>
            <input type="text" class="form-control" name="ariza" aria-describedby="emailHelp" placeholder="rıza Tespit Ücreti">
        </div>
          <div class="form-group">
            <label for="fiyat">Yıl</label>
            <select class="form-select form-select-lg mb-3" name="yil" aria-label=".form-select-lg example">
                <option selected> Seç</option>
                <option value="2024">2024</option>
                 <option value="2025">2025</option>
                 <option value="2026">2026</option>
 
            </select>
        </div>
             <div class="form-group">
            <label for="fiyat">Müşteri Teslim Etti</label>
            <select class="form-select form-select-lg mb-3" name="musteri_geldi" aria-label=".form-select-lg example">
                <option selected> Seç</option>
                <option value="evet">Evet</option>
                 <option value="hayir">Hayır</option>
            </select>
        </div>
        <?php
        if (isset($msg)) { ?>
            <div class="alert mt-3 <?php echo $status; ?>" role="alert">
                <?php echo $msg; ?>
            </div>
        <?php } ?>
        <button type="submit" class="btn btn-primary mt-3 w-100" name="devam">Devam </button>
    </form>
     <form method="post" action="islemler.php">
                        <button class="btn btn-danger mt-3 w-100">İşlem Ekle</button>
</form>


</div>
 <script>
        function toggleInput() {
            var selectElement = document.querySelector('select[name="sarf"]');
            var inputElement = document.getElementById('conditionalInput');

            if (selectElement.value === "var") {
                inputElement.style.display = 'block';
            } else {
                inputElement.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            var selectElement = document.querySelector('select[name="sarf"]');
            selectElement.addEventListener('change', toggleInput);
            toggleInput();  // Sayfa yüklendiğinde inputun durumunu kontrol et
        });
    </script>

<?php
require_once 'footer.php';

?>
