<?php
error_reporting(0);
$url=$_GET["api_url"];
$user=$_GET["api_user"];
$pass=$_GET["api_pass"];
$firma=$_GET["firma"];
$takip_no=$_GET["takip_no"];


$uri = $url."?user=".$user."&pass=".$pass."&firma=".$firma."&kod=".$takip_no; 
//echo $uri;
 function connect($a){
            $firma = $_GET["firma"];
            $ch	= curl_init();
            curl_setopt($ch, CURLOPT_URL, $a);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_REFERER, $_SERVER['HTTP_HOST']);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
            curl_setopt($ch, CURLOPT_ENCODING ,"UTF-8");
            $isle = curl_exec($ch);
            curl_close($ch); 
            return $isle;


        }

$data = connect($uri);
$veri = json_decode($data);
if(isset($veri->auth)){
   
   echo $veri->auth;
}else{
    if('yk'==$firma){

        if(isset($veri->veri[0]->gonderi_belge_no)){
            $islem_tarihi = $veri->veri[0]->islem_tarihi;
            $sevk_tarihi = $veri->veri[0]->sevk_tarihi;
            $gonderi_belge_no = $veri->veri[0]->gonderi_belge_no;
            $gonderi_kodu = $veri->veri[0]->gonderi_kodu;
            $teslim_subesi = $veri->veri[0]->teslim_subesi;
            $gonderici = $veri->veri[0]->gonderici;
            $gonderici_adresi = $veri->veri[0]->gonderici_adresi;
            $alici = $veri->veri[0]->alici;
            $alici_adresi = $veri->veri[0]->alici_adresi;
            $belge_turu = $veri->veri[0]->belge_turu;
            $odeme_turu = $veri->veri[0]->odeme_turu;
            $kargo_tipi = $veri->veri[0]->kargo_tipi;
            $kargo_adedi = $veri->veri[0]->kargo_adedi;
            $kargo_desi = $veri->veri[0]->kargo_desi;
            $durumu = $veri->veri[0]->durumu;
            $teslim_tipi = $veri->veri[0]->teslim_tipi;
            if(isset($veri->veri[0]->teslim_alan)){
                $teslim_edildi = 1;
                $teslim_tarihi = $veri->veri[0]->teslim_tarihi;
                $teslimat_subesi = $veri->veri[0]->teslimat_subesi;
                $teslim_alan = $veri->veri[0]->teslim_alan;
            }else{
                $tahmini_teslim_tarihi= $veri->veri[0]->tahmini_teslim_tarihi;
                $tahmini_teslim_zamani= $veri->veri[0]->tahmini_teslim_zamani;
                $teslim_edildi = 0; 

            }
?>
<link rel="stylesheet" href="css/style.css">
<meta name="viewport" content="width=device-width, initial-scale=0.5">

<table style="margin-top:10px;margin-bottom:30px;" width=100% cellspacing='0'> 
    <tr>
        <th colspan="2" scope="col" style="text-align:center; width:100%" ><img src="images/yk.png" style="width:200px;"></th>

    </tr>
    <tr>
        <th colspan="2" scope="col" style="font-size:18px;color:red;font-weight:bold;text-align:center;" ><strong><?php echo  $durumu?> </strong></th>

    </tr>

    <tr>
        <td style="font-size: 14px;font-weight:bold">İşlem Tarihi</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $islem_tarihi?></td>

    </tr>
    <tr class='even'>
        <td style="font-size: 14px;font-weight:bold">Sevk Tarihi</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $sevk_tarihi?></td>

    </tr>

    <tr>
        <td style="font-size: 14px;font-weight:bold">Gönderi Belge No</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $gonderi_belge_no?></td>

    </tr>
    <tr class='even'>
        <td style="font-size: 14px;font-weight:bold">Gönderi Kodu</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $gonderi_kodu?></td>

    </tr>

    <tr>
        <td style="font-size: 14px;font-weight:bold">Teslim Şubesi</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $teslim_subesi?></td> 

    </tr>
    <tr class='even'>
        <td style="font-size: 14px;font-weight:bold">Gönderici</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $gonderici?></td>

    </tr>

    <tr>
        <td style="font-size: 14px;font-weight:bold">Alıcı</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $alici?></td>

    </tr>
    <tr class='even'>
        <td style="font-size: 14px;font-weight:bold">Belge Türü</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo  $belge_turu ?></td>


    </tr>
    <tr>
        <td style="font-size: 14px;font-weight:bold">Ödeme Türü</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo  $odeme_turu ?></td>

    </tr>
    <tr class='even'>
        <td style="font-size: 14px;font-weight:bold">Kargo Tipi</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo  $kargo_tipi ?></td>


    </tr>
    <tr>
        <td style="font-size: 14px;font-weight:bold">Kargo Adedi</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo  $kargo_adedi ?></td>

    </tr>
    <tr class='even'>
        <td style="font-size: 14px;font-weight:bold">Kargo Desi/Kg</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo  $kargo_desi ?></td>


    </tr>

    <tr>
        <td style="font-size: 14px;font-weight:bold">Teslim Tipi</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo  $teslim_tipi ?></td>

    </tr>
    <?php
                if(1==$teslim_edildi){
    ?>  

    <tr class='even'>
        <td style="font-size: 14px;font-weight:bold">Teslim Tarihi</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo  $teslim_tarihi ?></td>


    </tr>
    <tr>
        <td style="font-size: 14px;font-weight:bold">Teslim Şubesi</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo  $teslimat_subesi ?></td>

    </tr>
    <tr class='even'>
        <td style="font-size: 14px;font-weight:bold">Teslim Alan</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo  $teslim_alan ?></td>


    </tr>
    <?php
                }
            else{
    ?>
    <tr class='even'>
        <td style="font-size: 14px;font-weight:bold">Tahmini Teslim Tarihi</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo  $tahmini_teslim_tarihi ?></td>


    </tr> <tr>
    <td style="font-size: 14px;font-weight:bold">Tahmini Teslim Zamanı</td>
    <td style="font-size: 14px;font-weight:bold"><?php echo  $tahmini_teslim_zamani ?></td>

    </tr>
    <?php
            }
    ?>
</table>


<?php
        }
        else{
            echo "Geçersiz Kargo Takip Numarası";
        }

    }elseif("aras"==$firma){
		//	print_r ($veri->message);
	//	die();
	
		$durum = $veri->message;
		
        if(trim($durum) == "Succes"){
            $IRSALIYE_NUMARA = $veri->cargoDetails->cargoDetail[0]->waybillNo;
            $GONDERICI = $veri->cargoDetails->cargoDetail[0]->senderAccountName;
            $ALICI = $veri->cargoDetails->cargoDetail[0]->receiverAccountName;
            $KARGO_TAKIP_NO = $veri->cargoDetails->cargoDetail[0]->trackingNumber;
            $CIKIS_SUBE = $veri->cargoDetails->cargoDetail[0]->initialUnit;
            $VARIS_SUBE = $veri->cargoDetails->cargoDetail[0]->arrivalUnit;
            $CIKIS_TARIH = $veri->cargoDetails->cargoDetail[0]->unitLeaveDate;
            $CIKIS_TARIH =substr($CIKIS_TARIH,0,11);
            $ADET = $veri->cargoDetails->cargoDetail[0]->ADET;
            $DESI = $veri->cargoDetails->cargoDetail[0]->DESI;
            $ODEME_TIPI = $veri->cargoDetails->cargoDetail[0]->paymentType;
            $DURUMU = $veri->cargoDetails->cargoDetail[0]->cargoStatus;
			

          if($veri->cargoDetails->cargoDetail[0]->cargoStatus=="TESLİM EDİLDİ"){
               $teslim_edildi = 1;
              $TESLIM_ALAN = $veri->cargoDetails->cargoDetail[0]->deliveredCustomerName;
               $TESLIM_TARIHI = substr($veri->cargoDetails->cargoDetail[0]->actualDeliveryDate,0,11);
               $TESLIM_SAATI = $veri->cargoDetails->cargoDetail[0]->actualDeliveryTime;
          }else{
            $PLANLANAN_TESLIMTARIHI = substr($veri->cargoDetails->cargoDetail[0]->estimatedDeliveryDate,0,11);

              $teslim_edildi = 0; 

           }
		
?>
<link rel="stylesheet" href="css/style.css">
<table style="margin-top:10px;margin-bottom:30px;" width=100% cellspacing='0'> 
    <tr>
        <th colspan="2" scope="col" style="text-align:center; width:100%" ><img src="images/aras.png" style="width:200px;"></th>

    </tr>
    <tr>
        <th colspan="2" scope="col" style="font-size:18px;color:red;font-weight:bold;text-align:center;" ><strong><?php echo  $DURUMU?> </strong></th>

    </tr>

    <tr>
        <td style="font-size: 14px;font-weight:bold">İrsaliye Numarası</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $IRSALIYE_NUMARA?></td>

    </tr>
    <tr class='even'>
        <td style="font-size: 14px;font-weight:bold">Gönderici</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $GONDERICI?></td>

    </tr>

    <tr>
        <td style="font-size: 14px;font-weight:bold">Alıcı</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $ALICI?></td>

    </tr>
    <tr class='even'>
        <td style="font-size: 14px;font-weight:bold">Kargo Takip No</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $KARGO_TAKIP_NO?></td>

    </tr>

    <tr>
        <td style="font-size: 14px;font-weight:bold">Çıkış Şubesi</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $CIKIS_SUBE?></td> 

    </tr>
    <tr class='even'>
        <td style="font-size: 14px;font-weight:bold">Çıkış Tarihi</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $CIKIS_TARIH?></td>

    </tr>

    <tr>
        <td style="font-size: 14px;font-weight:bold">Varış Şubesi</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $VARIS_SUBE?></td>

    </tr>
    <tr class='even'>
        <td style="font-size: 14px;font-weight:bold">Ödeme Türü</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $ODEME_TIPI ?></td>


    </tr>
    <tr>
        <td style="font-size: 14px;font-weight:bold">Desi / Kg</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $DESI ?></td>

    </tr>
    <tr class='even'>
        <td style="font-size: 14px;font-weight:bold">Adet </td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $ADET ?></td>


    </tr>

    <?php
                if(1==$teslim_edildi){
    ?>  

    <tr >
        <td style="font-size: 14px;font-weight:bold">Teslim Tarihi</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $TESLIM_TARIHI ?></td>


    </tr>
    <tr class='even'>
        <td style="font-size: 14px;font-weight:bold">Teslim Alan</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $TESLIM_ALAN ?></td>

    </tr>
    <tr >
        <td style="font-size: 14px;font-weight:bold">Teslim Saati</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $TESLIM_SAATI ?></td>


    </tr>
    <?php
                }
            else{
    ?>
    <tr>
        <td style="font-size: 14px;font-weight:bold">Planlanan Teslim Tarihi</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $PLANLANAN_TESLIMTARIHI ?></td>


    </tr>
    <?php
            }
    ?>
</table>


<?php
        }
        else{
            echo "Geçersiz Kargo Takip Numarası";
        }
    }elseif("surat"==$firma){

        if(!isset($veri->error)){
            $gonderici_adi= $veri->gonderici->gonderici_adi;
            $gonderici_adres= $veri->gonderici->gonderici_adres;
            $gonderici_tel= $veri->gonderici->gonderici_tel;
            $cikis_subesi= $veri->gonderici->cikis_subesi;
            $cikis_sube_tel= $veri->gonderici->cikis_sube_tel;
            $alici_adi= $veri->alici->alici_adi;
            $alici_adresi= $veri->alici->alici_adresi;
            $alici_tel= $veri->alici->alici_tel;
            $varis_subesi= $veri->alici->varis_subesi;
            $varis_sube_tel= $veri->alici->varis_sube_tel;
            $parca= $veri->durum->parca;
            $sisteme_giris= $veri->durum->sisteme_giris;
            $birim= $veri->durum->birim;
            $tarih= $veri->durum->tarih;
            $muhatap= $veri->durum->muhatap;
            $durumu= $veri->durum->durumu;
            $son_islem= $veri->durum->son_islem;
            $son_bulundugu_yer= $veri->durum->son_bulundugu_yer;
            $barkod= $veri->durum->barkod;


?>
<link rel="stylesheet" href="css/style.css">
<table style="margin-top:10px;margin-bottom:30px;" width=100% cellspacing='0'> 
    <tr>
        <th colspan="2" scope="col" style="text-align:center; width:100%" ><img src="images/surat.png" style="width:200px;"></th>

    </tr>
    <tr>
        <th colspan="2" scope="col" style="font-size:18px;color:red;font-weight:bold;text-align:center;" ><strong><?php echo $durumu?> </strong></th>

    </tr>

    <tr>
        <td style="font-size: 14px;font-weight:bold">Gönderici Adı</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $gonderici_adi ?></td>

    </tr>
    <tr class='even'>
        <td style="font-size: 14px;font-weight:bold">Gönderici Adresi</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $gonderici_tel ?></td>

    </tr>

    <tr>
        <td style="font-size: 14px;font-weight:bold">Gönderici Tel</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $gonderici_adres ?></td>

    </tr>
    <tr class='even'>
        <td style="font-size: 14px;font-weight:bold">Çıkış Şubesi</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $cikis_subesi ?></td>

    </tr>

    <tr>
        <td style="font-size: 14px;font-weight:bold">Çıkış Şubesi Tel</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $cikis_sube_tel ?></td> 

    </tr>
    <tr class='even'>
        <td style="font-size: 14px;font-weight:bold">Alıcı Adı</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $alici_adi ?></td>

    </tr>

    <tr>
        <td style="font-size: 14px;font-weight:bold">Alıcı Adresi</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $alici_adresi ?></td>

    </tr>
    <tr class='even'>
        <td style="font-size: 14px;font-weight:bold">Alıcı Tel</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $alici_tel ?></td>


    </tr>
    <tr>
        <td style="font-size: 14px;font-weight:bold">Varış Şubesi</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $varis_subesi ?></td>

    </tr>
    <tr class='even'>
        <td style="font-size: 14px;font-weight:bold">Varış Şube Tel </td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $varis_sube_tel ?></td>


    </tr>


    <tr >
        <td style="font-size: 14px;font-weight:bold">Parça</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $parca ?></td>


    </tr>
    <tr class='even'>
        <td style="font-size: 14px;font-weight:bold">Sisteme Giriş Tarihi</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $sisteme_giris ?></td>

    </tr>
    <tr >
        <td style="font-size: 14px;font-weight:bold">Birim</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $birim ?></td>


    </tr>

    <tr class='even'>
        <td style="font-size: 14px;font-weight:bold">Teslim Tarihi</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $tarih ?></td>


    </tr>
    <tr >
        <td style="font-size: 14px;font-weight:bold">Teslim Alan</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $muhatap ?></td>


    </tr>
    <tr class='even'>
        <td style="font-size: 14px;font-weight:bold">Son İşlem</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $son_islem ?></td>


    </tr>
    <tr >
        <td style="font-size: 14px;font-weight:bold">Son Bulunduğu Yer</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $son_bulundugu_yer ?></td>


    </tr>
    <tr class='even'>
        <td style="font-size: 14px;font-weight:bold">Barkod</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $barkod ?></td>


    </tr>
</table>


<?php
        }else{
            echo "Geçersiz Kargo Takip Numarası";
        }

    }
    elseif("mng"==$firma){

        if(!empty($veri->info[0])&&!isset($veri->info[0]->Sonuc)){
            $Teslim_Tarihi = $veri->info[0]->Teslim_Tarihi;
            $Teslim_Saati = $veri->info[0]->Teslim_Saati;
            $Teslim_Birimi = $veri->info[0]->Teslim_Birimi;
            $Teslim_Birimi_Adres = $veri->info[0]->Teslim_Birimi_Adres;
            $Teslim_Birimi_Telefon = $veri->info[0]->Teslim_Birimi_Telefon;
            $Teslim_Alan = $veri->info[0]->Teslim_Alan;
            $Fatura_No = $veri->info[0]->Fatura_No;
            $Cikis_Birimi = $veri->info[0]->Cikis_Birimi;
            $Cikis_Birimi_Adres = $veri->info[0]->Cikis_Birimi_Adres;
            $Cikis_Birimi_Telefon = $veri->info[0]->Cikis_Birimi_Telefon;
            $Cikis_Tarihi = $veri->info[0]->Cikis_Tarihi;
            $Hareket_Turu_Mobil = $veri->info[0]->Hareket_Turu_Mobil;
            $Hareket_Aciklama = $veri->info[0]->Hareket_Aciklama;
            if( $Hareket_Turu_Mobil==5){
                $durumu="Teslim Edildi";
            }else if( $Hareket_Turu_Mobil==4){
                $durumu="Dağıtımda";

            }else if( $Hareket_Turu_Mobil==3){
                $durumu="Varış Şubesinde";
            }else if( $Hareket_Turu_Mobil==2){
                $durumu="Taşıma Durumunda";
            }else if( $Hareket_Turu_Mobil==1){
                $durumu="Gönderiniz Hazırlanıyor";
            }

?>
<link rel="stylesheet" href="css/style.css">
<table style="margin-top:10px;margin-bottom:30px;" width=100% cellspacing='0'> 
    <tr>
        <th colspan="2" scope="col" style="text-align:center; width:100%" ><img src="images/mng.png" style="height:120px;"></th>

    </tr>
    <tr>
        <th colspan="2" scope="col" style="font-size:18px;color:red;font-weight:bold;text-align:center;" ><strong><?php echo $durumu?> </strong></th>

    </tr>

    <tr>
        <td width=250px style="font-size: 14px;font-weight:bold">Hareket Açıklaması</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $Hareket_Aciklama?></td>

    </tr>
    <tr class='even'>
        <td style="font-size: 14px;font-weight:bold">Fatura No</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $Fatura_No?></td>

    </tr>

    <tr>
        <td style="font-size: 14px;font-weight:bold">Çıkış Birimi</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $Cikis_Birimi?></td>

    </tr>
    <tr class='even'>
        <td style="font-size: 14px;font-weight:bold">Çıkış Birimi Adres</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $Cikis_Birimi_Adres?></td>

    </tr>

    <tr>
        <td style="font-size: 14px;font-weight:bold">Çıkış Birimi Tel</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $Cikis_Birimi_Telefon?></td> 

    </tr>
    <tr class='even'>
        <td style="font-size: 14px;font-weight:bold">Çıkış Tarihi</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $Cikis_Tarihi?></td>

    </tr>

    <tr>
        <td style="font-size: 14px;font-weight:bold">Teslim Birimi</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $Teslim_Birimi?></td>

    </tr>
    <tr class='even'>
        <td style="font-size: 14px;font-weight:bold">Teslim Birimi Adres</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $Teslim_Birimi_Adres ?></td>


    </tr>
    <tr>
        <td style="font-size: 14px;font-weight:bold">Teslim Birimi Tel</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $Teslim_Birimi_Telefon ?></td>

    </tr>
    <tr class='even'>
        <td style="font-size: 14px;font-weight:bold">Teslim Tarihi </td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $Teslim_Tarihi ?></td>


    </tr>



    <tr >
        <td style="font-size: 14px;font-weight:bold">Teslim Saati</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $Teslim_Saati ?></td>


    </tr>
    <tr class='even'>
        <td style="font-size: 14px;font-weight:bold">Teslim Alan</td>
        <td style="font-size: 14px;font-weight:bold"><?php echo $Teslim_Alan ?></td>

    </tr>


</table>


<?php


        }
        else{
            echo "Geçersiz Kargo Takip Numarası";

        }
    }
}