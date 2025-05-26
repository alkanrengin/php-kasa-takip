
<?php
require_once 'header.php';
require_once 'navbar.php';
$seri=$_POST["guncel"];
$ariza="";
?>
<style>
    .form-group{
        font-size:20px ;
    }
     .form-group input{
        font-size:25px !important;
    }
       .form-group select{
        font-size:25px !important;
    }
    
</style>
<div class="container" id="content">
    <div id="pdf-section">
    <img src="dd.PNG" style="width:80%; height:200px; object-fit:cover;"/>
    <h1 class="text-center mt-5">Teknik Servis Formu</h1>
    <form method="post" action=""  >
          <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $buttonValue = $_POST["guncel"];
            $s_getir = $db->prepare("SELECT * FROM teknikservis WHERE serino = ?");
            $s_getir ->execute([$buttonValue]);
            $sorgu = $s_getir ->fetch(PDO::FETCH_ASSOC);
            $ariza=$sorgu["ariza"];
            ?>
        <div class="form-group">
            <label for="urun_kodu">Tarih</label>
            <input disabled  type="text" class="form-control" name="id" aria-describedby="emailHelp" value="<?php echo $sorgu["tarih"]?>"placeholder="İd">
        </div>
        <div class="form-group">
            <label for="urun_kodu">Müşteri Adı</label>
            <input disabled  type="text" class="form-control" name="musteri" aria-describedby="emailHelp" value="<?php echo $sorgu["musteri_adi"]?>"placeholder="Müşteri Adı">
        </div>
        <div class="form-group">
            <label for="isim">Telefon</label>
            <input disabled  type="text" class="form-control" name="tel" aria-describedby="emailHelp"  value="<?php echo $sorgu["telefon"]?>" placeholder="Telefon">
        </div>
        <div class="form-group">
            <label for="adet">Cihaz Bilgisi</label>
            <input disabled  type="text" class="form-control" name="cihaz" aria-describedby="emailHelp" value="<?php echo $sorgu["cihaz"]?>" placeholder="Cihaz Bilgisi">
        </div>
        <div class="form-group">
            <label for="fiyat"> Seri No</label>
            <input disabled  type="text" class="form-control" name="serino" aria-describedby="emailHelp" value="<?php echo $sorgu["serino"]?>" placeholder="Seri No">
        </div>
         <div class="form-group">
            <label for="fiyat"> Şikayet</label>
            <input disabled  type="text" class="form-control" name="sikayet" aria-describedby="emailHelp" value="<?php echo $sorgu["sikayet"]?>" placeholder="Şikayet">
        </div>
     
        <div class="form-group">
            <label for="fiyat">Ürün Sarf Durumu</label>
            <select disabled class="form-select form-select-lg mb-3" name="sarf" aria-label=".form-select-lg example">
                <option selected><?php echo $sorgu["sarf_durumu"]?></option>
                <option value="var">Var</option>
                 <option value="yok">Yok</option>
                 <option value="orjinal">Orjinal</option>
                 <option value="muadil ">Muadil</option>
                
            </select>
        </div>
          <div class="form-group">
            <label for="fiyat">Ürün Kontrolü</label>
            <select disabled class="form-select form-select-lg mb-3" name="kontrol" aria-label=".form-select-lg example">
                <option selected><?php echo $sorgu["urun_kontrol"]?></option>
                <option value="var">Yapıldı</option>
                 <option value="yok">Yapılmadı</option>
            </select>
        </div>
        <div class="form-group">
            <label for="model">Ürün Yanında</label>
            <input disabled  type="text" class="form-control" name="yaninda" aria-describedby="emailHelp" value="<?php echo $sorgu["urun_yaninda"]?>" placeholder="Ürün Yanında">
        </div>
          <div class="form-group">
            <label for="fiyat">Yıl</label>
            <select disabled class="form-select form-select-lg mb-3" name="yil" aria-label=".form-select-lg example">
                <option selected> <?php echo $sorgu["yil"]?></option>
                <option value="2024">2024</option>
                 <option value="2025">2025</option>
                 <option value="2026">2026</option>
 
            </select>
        </div>
             <div class="form-group">
            <label for="fiyat">Müşteri Teslim Etti</label>
            <select disabled class="form-select form-select-lg mb-3" name="musteri_geldi" aria-label=".form-select-lg example">
                <option selected> <?php echo $sorgu["musteri_geldi"]?></option>
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
            <?php }?>
      <table class="table">
        <thead class="thead-dark" style="--bs-table-bg:black; --bs-table-color:white;">
            <tr style="text-align: center">
    <th scope="col">İşlem</th>
    <th scope="col">Birim</th>
    <th scope="col">Fiyat</th>
    <th scope="col">Kdv</th>
    <th scope="col">Toplam</th>
  </tr>
  </thead>
        <tbody>
        <?php  
        
        
            $i_getir = $db->prepare("SELECT * FROM islemler WHERE serino = ?");
                $i_getir->execute([$seri]);

                while ($islemler = $i_getir->fetch(PDO::FETCH_ASSOC)) {
        ?>

   <tr style="text-align: center">
    <td><?php echo $islemler["islem"]?></td>
    <td><?php echo $islemler["birim"]?></td>
    <td><?php echo $islemler["fiyat"]?></td>
     <td><?php echo $islemler["kdv"]?></td>
      <td><?php echo $islemler["toplam"]?></td>
  </tr>
  <?php }?>
  </tbody>
</table>
       
    </form>
    <img src="xx.PNG" style="width:100%;  object-fit:contain;"/ >
    <p style="font-size:25px; padding-left:25px; margin:15px 0px;"><b>TEKNİK SERVİSİMİZDE YAPILAN ARIZA TESPİT ÜCRETİ <?php echo $ariza ?> TL'DİR MÜŞTERİ KABUL ETMİŞTİR</b></p>
    <img src="s.PNG" style=""/>
    
    </div>

 <button id="download-pdf" class="btn btn-primary mt-3 w-100" >Pdf İndir </button>
</div>
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

            // Görüntüyü PDF sayfasına sığacak şekilde ölçekleyin
            var ratio = Math.min((pdfWidth - 2 * padding) / imgWidth, (pdfHeight - 2 * padding) / imgHeight);
            var width = imgWidth * ratio;
            var height = imgHeight * ratio;

            // Görüntünün ortalanması için boşlukları hesaplayın
            var xOffset = (pdfWidth - width) / 2;
            var yOffset = (pdfHeight - height) / 2;

            // Görüntüyü PDF'e ekleyin, ortalayarak
            pdf.addImage(imgData, 'PNG', xOffset, yOffset, width, height);
            pdf.save('ornek.pdf');
        });
    });
</script>


<?php
require_once 'footer.php';

?>

