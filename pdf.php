<?php
require_once 'header.php';
require_once 'navbar.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cat_name =strtoupper($_POST["kategori"]);
    $kod =strtoupper($_POST["urun_kodu"]);
    $tarih=date('Y-m-d H:i:s');
    $marka =strtoupper($_POST["marka"]);
    $model =strtoupper($_POST["model"]);
    $isim =strtoupper($_POST["isim"]);
    $adet =$_POST["adet"];
    $bayi=$_POST["bayi-fiyat"];
    $gelis=$_POST["gelis-fiyat"];
    $fiyat=$_POST["fiyat"];
    if (empty($cat_name) ||empty($marka)  ||empty($isim) ||empty($fiyat) ||empty($adet) ||empty($kod)  ) {
        $msg = 'Alanları doldurun.';
        $status = 'alert-danger';
    } else {

        $ayni_urun_varmi = $db->prepare("SELECT * FROM urunler WHERE kod = ?");
        $ayni_urun_varmi->execute([$kod]);
        if ($ayni_urun_varmi->rowCount()) {
            $msg = 'Bu ürün mevcut.';
            $status = 'alert-danger';
        }
        else{
            $urun_ekle = $db->prepare("INSERT INTO urunler (kod,tarih,marka,model,isim,adet,gelis_fiyat,bayi_fiyat,fiyat,kategori) VALUES (?,?,?,?,?,?,?,?,?,?)");
            $urun_ekle->execute(array($kod,$tarih,$marka,$model,$isim,$adet,$gelis,$bayi,$fiyat,$cat_name));
            if ($urun_ekle) {
                $msg = 'Kayıt işlemi tamamlandı.';
                $status = 'alert-success';
            }
            else {
                $msg = 'Üye kaydı başarısız. Bir sorun oluştu.';
                $status = 'alert-danger';
            }
        }


    }

}
?>
<div class="container" id="content">
    <h1 class="text-center mt-5">Ürün Ekle</h1>
    <form method="post" action="" id="pdf-section">
        <div class="form-group">
            <label for="urun_kodu">Ürün Kodu</label>
            <input type="text" class="form-control" name="urun_kodu" aria-describedby="emailHelp" placeholder="Ürün Kodu">
        </div>

        <div class="form-group">
            <label for="marka">Marka</label>
            <input type="text" class="form-control" name="marka" aria-describedby="emailHelp" placeholder="Marka">
        </div>
        <div class="form-group">
            <label for="isim">İsim</label>
            <input type="text" class="form-control" name="isim" aria-describedby="emailHelp" placeholder="İsim">
        </div>
        <div class="form-group">
            <label for="adet">Adet</label>
            <input type="text" class="form-control" name="adet" aria-describedby="emailHelp" placeholder="Adet">
        </div>
        <div class="form-group">
            <label for="fiyat"> Geliş Fiyatı</label>
            <input type="text" class="form-control" name="gelis-fiyat" aria-describedby="emailHelp" placeholder=" Geliş Fiyatı">
        </div>
        <div class="form-group">
            <label for="fiyat"> Bayi Fiyatı</label>
            <input type="text" class="form-control" name="bayi-fiyat" aria-describedby="emailHelp" placeholder=" Bayi Fiyatı">
        </div>
        <div class="form-group">
            <label for="fiyat">Kullanıcı Satış Fiyatı</label>
            <input type="text" class="form-control" name="fiyat" aria-describedby="emailHelp" placeholder="Fiyat">
        </div>
        <div class="form-group">
            <label for="fiyat">Kategori</label>
            <select class="form-select form-select-lg mb-3" name="kategori" aria-label=".form-select-lg example">
                <option selected>Kategori Seç</option>
                <?php
                $cat_listele = $db->prepare("SELECT  kategori_adi FROM kategoriler");
                $cat_listele->execute();
                while ($res = $cat_listele->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <option value="<?php echo $res["kategori_adi"] ?>"><?php echo $res["kategori_adi"] ?></option>
                <?php }?>
            </select>
        </div>
        <div class="form-group">
            <label for="model">Açıklama</label>
            <input type="text" class="form-control" name="model" aria-describedby="emailHelp" placeholder="Açıklama">
        </div>
        <?php
        if (isset($msg)) { ?>
            <div class="alert mt-3 <?php echo $status; ?>" role="alert">
                <?php echo $msg; ?>
            </div>
        <?php } ?>
        <button type="submit" class="btn btn-primary mt-3 w-100" >Ürün Ekle </button>
    </form>
    

</div>
 <button id="download-pdf">PDF Olarak İndir</button>
   <script>
        document.getElementById('download-pdf').addEventListener('click', function() {
            var element = document.getElementById('pdf-section');

            html2canvas(element).then(function(canvas) {
                var imgData = canvas.toDataURL('image/png');
                var pdf = new jspdf.jsPDF();

                // Padding değerlerini belirleyin (mm cinsinden)
                var padding = 10;
                
                var pdfWidth = pdf.internal.pageSize.getWidth();
                var pdfHeight = pdf.internal.pageSize.getHeight();
                var imgWidth = canvas.width;
                var imgHeight = canvas.height;

                // Görüntüyü PDF sayfasına sığacak şekilde ölçekleyin, padding ekleyerek
                var ratio = Math.min((pdfWidth - 2 * padding) / imgWidth, (pdfHeight - 2 * padding) / imgHeight);
                var width = imgWidth * ratio;
                var height = imgHeight * ratio;

                // Görüntüyü PDF'e ekleyin, padding ekleyerek
                pdf.addImage(imgData, 'PNG', padding, padding, width, height);
                pdf.save('ornek.pdf');
            });
        });
    </script>

<?php
require_once 'footer.php';

?>
