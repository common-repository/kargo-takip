<?php
/*
Plugin Name: Kargo Takip
Support: https://www.biuzman.com
Description: Kullanıcılarınızın aras, mng, yurtiçi ve sürat kargo gönderilerini takip edebileceği Woocommerce eklentisidir. Ücretli bir eklentidir. Api bilgisi gereklidir. Api kimlik bilgisi temini için 0530 960 07 07 whatsapptan ulaşınız.
Version: 1.2
Author: Uzman Bilişim
Author URI: https://www.uzman-bilisim.com
License: Tek Domain
Text Domain: karg-takip
*/
add_action("admin_menu","KRGTKP_admin_menu_ekle");

function KRGTKP_admin_menu_ekle(){
    add_submenu_page("options-general.php","Uzman Bilişim Kargo Takip Modülü","Kargo Takip","manage_options",__FILE__,"KRGTKP_settings_section");

}
add_action("admin_init","KRGTKP_api_ayar");

function KRGTKP_settings_section(){
?>

<h1>Kargo Takip</h1>
<hr>
<form action="options.php" method="post">
    <?php settings_fields("api_ayar");?>
    <?php do_settings_sections("api_ayar");?>
    <table class="form-table">
        <div style="margin:5px;">                  
            <label style="font-size:10pt;">Api bilgilerinizi girip değişiklikleri kaydet butonunu tıklayınız. </label>
        </div>


        <tr>
            <th scope="row">
                <label for="api_url">Api Url</label>
            </th>
            <td>
                <input size="60" type="text" value="<?php echo get_option("kt_api_url");?>" placeholder="Api Url Adresini Giriniz" name="kt_api_url" >
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="api_user">Api Kullanıcı Adı</label>
            </th>
            <td>
                <input size="60" type="text" value="<?php echo get_option("kt_api_user");?>" placeholder="Api User Name" name="kt_api_user" >
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="api_url">Api Şifre</label>
            </th>
            <td>
                <input size="60" type="text" value="<?php echo get_option("kt_api_pass");?>" placeholder="Api Password" name="kt_api_pass">
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="api_url">Lisans Domain</label>
            </th>
            <td>
                <input size="60" readonly type="text" value="<?php echo get_option("siteurl");?>" placeholder="http://www.yourdomain.com" name="kt_domain">
            </td>
        </tr>
    </table>

    <label style="font-size:10pt;">Eğer api kimlik bilginiz yok ise  satın almak için <strong>duranun@gmail.com</strong> mail adresinden edinebilir veya <strong>0530 960 07 07</strong> numaralı telefonu arayabilirsiniz</label>

    <?php submit_button();?>

</form>
<?php
                   }
function KRGTKP_api_ayar(){
    register_setting("api_ayar","kt_api_user");
    register_setting("api_ayar","kt_api_pass");
    register_setting("api_ayar","kt_api_url");
    register_setting("api_ayar","kt_domain");



}
function KRGTKP_add_metabox(){
    global $woocommerce, $order, $post;
    add_meta_box(
        "kargo-takip",
        "Kargo Takip",
        "KRGTKP_kargo_takip_no_icerik",
        "shop_order",
        "side",
        "high"
    );
}
add_action("add_meta_boxes","KRGTKP_add_metabox");

function KRGTKP_kargo_takip_no_icerik(){
    wp_nonce_field(basename(__FILE__), "kargo-box-nonce");
    global $woocommerce, $order, $post;
    $takip_no = get_post_meta( $post->ID, 'kargo_takip_no', true );
    $kargo_firmasi = get_post_meta( $post->ID, 'kargo_firmasi', true );

?>
<div>


    <label for="kargo_takip_no">Takip No:</label>
    <input name="kargo_takip_no" type="text" value="<?php echo $takip_no ?>">
    <br>

    <label for="kargo_firmasi">Kargo Firması</label>
    <select name="kargo_firmasi">
        <?php 
        $option_values = array("aras", "yk", "surat","mng");

    foreach($option_values as $key => $value) 
    {
        if($value == $kargo_firmasi)
        {
            $selected = "selected";
        }
        else
        {
            $selected ="";
        }
   
        ?>
        <option <?php echo $selected?> value ="<?php echo $value; ?>">
            <?php    
    if($value=="aras") echo "Aras Kargo";
    if($value=="yk") echo "Yurtiçi Kargo";
    if($value=="mng") echo "MNG Kargo";
    if($value=="surat") echo "Sürat Kargo";
            ?>
        </option>
        <?php
         }
    ?>
    </select>

    <br>


</div>
<?php  

  

}



function KRGTKP_kaydet( $post_id, $post ) {
    if (!isset($_POST["kargo-box-nonce"]) || !wp_verify_nonce($_POST["kargo-box-nonce"], basename(__FILE__)))
        return $post_id;

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;


    $kargo_takip_no = "";
    $kargo_firmasi = "";
    $meta_box_checkbox_value = "";

    if(isset($_POST["kargo_takip_no"]))
    {
        $meta_box_text_value =  sanitize_text_field($_POST["kargo_takip_no"]);
        


    }   
   /* Kargo numarası girilmişse sipariş durumunu otomatik olarak tamamlandı yapar
   
   if(""!= $meta_box_text_value){
        $order = new WC_Order($post_id);
        $order->update_status('completed');
    }*/
    
    update_post_meta($post_id, "kargo_takip_no", $meta_box_text_value);

    if(isset($_POST["kargo_firmasi"]))
    {
        $meta_box_dropdown_value = sanitize_text_field($_POST["kargo_firmasi"]);
    }   
    update_post_meta($post_id, "kargo_firmasi", $meta_box_dropdown_value);


}


add_action( 'save_post', 'KRGTKP_kaydet', 10, 3 );

add_filter( 'manage_edit-shop_order_columns', 'KRGTKP_order_list_col',30,1);

function KRGTKP_order_list_col($columns){


    $columns['takip-no'] = __( 'Kargo Takip No','kargo-takip');
    return $columns;
}

add_action( 'manage_shop_order_posts_custom_column' , 'KRGTKP_order_list_col_content', 1000, 2 );
function KRGTKP_order_list_col_content( $column ){
    global $post, $woocommerce, $the_order,$firm;
    $order_id = $the_order->id;
add_thickbox();
    switch ( $column )
    {
        case 'kargo-firmasi' :


            break;

        case 'takip-no' :

            $takip_no = get_post_meta( $order_id, 'kargo_takip_no', true );
            //echo '<a data-lity width="1024" href="http://api.biuzman.com/test.php" rel="lightframe[|width:800px;height:700px]">Search</a>';

            $firm = get_post_meta( $order_id, 'kargo_firmasi', true );
            if($firm =="yk") 
                $firma ="Yurtiçi Kargo";
            if($firm =="aras") 
                $firma ="Aras Kargo";
            if($firm =="mng") 
                $firma ="MNG Kargo";
            if($firm =="surat") 
                $firma ="Sürat Kargo";

            echo $firma."<br/>";
?>



<a title="KARGO TAKİP" class="thickbox"  href="<?php echo plugin_dir_url(__FILE__)?>/ui/decodeandview.php?api_url=<?php echo get_option("kt_api_url")?>&takip_no=<?php echo $takip_no ?>&api_user=<?php echo get_option("kt_api_user")?>&api_pass=<?php echo get_option("kt_api_pass")?>&firma=<?php echo $firm ?>&TB_iframe=true&width=600&height=800" data-lity  ><?php echo$takip_no?> </a>
<?php
                break;
    }


}
function KRGTKP_my_admin_scripts() {

     wp_enqueue_script( 'tb_window', plugin_dir_url( __FILE__ ) . 'ui/js/tb_window.js', array( 'jquery','thickbox' ) );

}
add_action( 'admin_enqueue_scripts', 'KRGTKP_my_admin_scripts' );



add_action( 'woocommerce_order_items_table', 'KRGTKP_add_order_shipping_details', 10, 1 ); 

function KRGTKP_wptuts_scripts_with_jquery()
{
      wp_enqueue_script( 'tb_window', plugin_dir_url( __FILE__ ) . 'ui/js/tb_window.js', array( 'jquery','thickbox' ) );
   
}
add_action( 'wp_enqueue_scripts', 'KRGTKP_wptuts_scripts_with_jquery' );
function KRGTKP_add_order_shipping_details ( $order ) {
    $order_id= $order->id;
   add_thickbox();
    $takip_no = get_post_meta( $order_id, 'kargo_takip_no', true );

    $firm = get_post_meta( $order_id, 'kargo_firmasi', true );
    if($firm =="yk") 
        $firma ="Yurtiçi Kargo";
    if($firm =="aras") 
        $firma ="Aras Kargo";
    if($firm =="mng") 
        $firma ="MNG Kargo";
    if($firm =="surat") 
        $firma ="Sürat Kargo";

    echo '';
    if(""!=$takip_no){
 
?>


<div class="' . $container_class . '"> Siparişiniz <b><?php echo$firma?></b> ile tarafınıza kargolanmıştır. Kargo Takip Numaranız:  <a title="KARGO TAKİP" class="thickbox"  href="<?php echo plugin_dir_url(__FILE__)?>/ui/decodeandview.php?api_url=<?php echo get_option("kt_api_url")?>&takip_no=<?php echo $takip_no ?>&api_user=<?php echo get_option("kt_api_user")?>&api_pass=<?php echo get_option("kt_api_pass")?>&firma=<?php echo $firm ?>&TB_iframe=true" data-lity  ><b> <?php echo$takip_no?> </b> </a>. </br>Detaylar için kargo takip numaranızı veya <a title="KARGO TAKİP" class="thickbox"  href="<?php echo plugin_dir_url(__FILE__)?>/ui/decodeandview.php?api_url=<?php echo get_option("kt_api_url")?>&takip_no=<?php echo $takip_no ?>&api_user=<?php echo get_option("kt_api_user")?>&api_pass=<?php echo get_option("kt_api_pass")?>&firma=<?php echo $firm ?>&TB_iframe=true" data-lity  > <b>burayı</b> </a> tıklayınız.  </div></br></br>




<?php

}
        


}
/**
*Shortcode tanımlamaları
*/
//-----------Aras kargo----------------

function KRGTKP_aras_kargo( ){
add_thickbox();
?>
 <script>
     function get_aras(){
              var aras_takip_no = document.getElementById("aras_takip_no").value;
         
              var html ='<?php echo plugin_dir_url(__FILE__)?>ui/decodeandview.php?api_url=<?php echo get_option("kt_api_url")?>&takip_no='+aras_takip_no+'&api_user=<?php echo get_option("kt_api_user")?>&api_pass=<?php echo get_option("kt_api_pass")?>&firma=aras&TB_iframe=true&width=700&height=700';
         document.getElementById("aras_tracker").setAttribute("href",html);
         

     }
     
</script>
 <table class="form-table">
       
        <tr>
          
            <td>
  <input id="aras_takip_no" placeholder="Aras kargo takip Numaranızı Giriniz." style="width:256px" type="text" > <a title="ARAS KARGO TAKİP" onclick="get_aras()" id="aras_tracker" class="button thickbox">Kargom Nerede</a>
            </td>
        </tr>
    
    </table>
   <?php
    
}

 add_shortcode( 'aras_kargo_takip' , 'KRGTKP_aras_kargo' );

//----------Yurtiçi kargo--------------

function KRGTKP_yurtici_kargo( ){
add_thickbox();
?>
 <script>
     function get_yk(){
              var yk_takip_no = document.getElementById("yk_takip_no").value;
         
              var html ='<?php echo plugin_dir_url(__FILE__)?>ui/decodeandview.php?api_url=<?php echo get_option("kt_api_url")?>&takip_no='+yk_takip_no+'&api_user=<?php echo get_option("kt_api_user")?>&api_pass=<?php echo get_option("kt_api_pass")?>&firma=yk&TB_iframe=true&width=700&height=700';
         document.getElementById("yk_tracker").setAttribute("href",html);
         console.log(html);
         

     }
     
</script>
 <table class="form-table">
       
        <tr>
          
            <td>
  <input id="yk_takip_no" placeholder="Yurtiçi kargo takip Numaranızı Giriniz." style="width:256px" type="text" > <a title="YURTİÇİ KARGO TAKİP" onclick="get_yk()" id="yk_tracker" class="button thickbox">Kargom Nerede</a>
            </td>
        </tr>
    
    </table>
   <?php
    
}

 add_shortcode( 'yk_kargo_takip' , 'KRGTKP_yurtici_kargo' );

//----------MNG Kargo ------------------

function KRGTKP_mng_kargo( ){
add_thickbox();
?>
 <script>
     function get_mng(){
              var mng_takip_no = document.getElementById("mng_takip_no").value;
         
              var html ='<?php echo plugin_dir_url(__FILE__)?>ui/decodeandview.php?api_url=<?php echo get_option("kt_api_url")?>&takip_no='+mng_takip_no+'&api_user=<?php echo get_option("kt_api_user")?>&api_pass=<?php echo get_option("kt_api_pass")?>&firma=mng&TB_iframe=true&width=700&height=700';
         document.getElementById("mng_tracker").setAttribute("href",html);
         console.log(html);
         

     }
     
</script>
 <table class="form-table">
       
        <tr>
          
            <td>
  <input id="mng_takip_no" placeholder="MNG kargo takip Numaranızı Giriniz." style="width:256px" type="text" > <a title="MNG KARGO TAKİP" onclick="get_mng()" id="mng_tracker" class="button thickbox">Kargom Nerede</a>
            </td>
        </tr>
    
    </table>
   <?php
    
}

 add_shortcode( 'mng_kargo_takip' , 'KRGTKP_mng_kargo' );

//----------Sürat Kargo ------------------

function KRGTKP_surat_kargo( ){
add_thickbox();
?>
 <script>
     function get_surat(){
              var surat_takip_no = document.getElementById("surat_takip_no").value;
         
              var html ='<?php echo plugin_dir_url(__FILE__)?>ui/decodeandview.php?api_url=<?php echo get_option("kt_api_url")?>&takip_no='+surat_takip_no+'&api_user=<?php echo get_option("kt_api_user")?>&api_pass=<?php echo get_option("kt_api_pass")?>&firma=surat&TB_iframe=true&width=700&height=700';
         document.getElementById("surat_tracker").setAttribute("href",html);
         

     }
     
</script>
 <table class="form-table">
       
        <tr>
          
            <td>
  <input id="surat_takip_no" placeholder="Sürat kargo takip Numaranızı Giriniz." style="width:256px" type="text" > <a title="SÜRAT KARGO TAKİP" onclick="get_surat()" id="surat_tracker" class="button thickbox">Kargom Nerede</a>
            </td>
        </tr>
    
    </table>
   <?php
    
}

 add_shortcode( 'surat_kargo_takip' , 'KRGTKP_surat_kargo' );