
<?php
require_once 'header.php';
require_once 'navbar.php';
$serino="";
        
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $serino =$_POST["seri"];
    $birim=$_POST["b1"];
    $islem=$_POST["i1"];
    $fiyat=$_POST["f1"];
  
    
 if (empty($serino) || empty($birim) || empty($fiyat) || empty($islem) ) {
        $msg = 'Alanları doldurun.';
        $status = 'alert-danger';
    } else {
        $kdv = ((intval($fiyat)*intval($birim)) * 20) / 100;
        $toplam = (intval($fiyat)*intval($birim))+ $kdv;

        try {
            $islem_ekle = $db->prepare("INSERT INTO islemler ( serino, birim,fiyat,kdv,toplam,islem) VALUES ( ?, ?, ?, ?, ?, ?)");
            $result = $islem_ekle->execute(array($serino,$birim,$fiyat,$kdv,$toplam,$islem));
            
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
    <h1 class="text-center mt-5">Yapılan İşlemler</h1>
 <form method="post" action="">
        <div class="form-group">
            <label for="marka">Seri No</label>
            <input type="text" class="form-control" name="seri" aria-describedby="emailHelp" placeholder="">
        </div>
        <div class="form-group">
            <label for="marka">İşlem</label>
            <input type="text" class="form-control" name="i1" aria-describedby="emailHelp" placeholder="">
        </div>
          <div class="form-group">
            <label for="marka">Birim</label>
            <input type="text" class="form-control" name="b1" aria-describedby="emailHelp" placeholder="">
        </div>
          <div class="form-group">
            <label for="marka">Fiyat</label>
            <input type="text" class="form-control" name="f1" aria-describedby="emailHelp" placeholder="">
        </div>
               <?php
        if (isset($msg)) { ?>
            <div class="alert mt-3 <?php echo $status; ?>" role="alert">
                <?php echo $msg; ?>
            </div>
        <?php } ?>
        <button type="submit" class="btn btn-primary mt-3 w-100">İşlem Ekle </button>
    </form>
     <form method="post" action="servis_listesi.php">
                        <button class="btn btn-danger mt-3 w-100">Bitir</button>
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

