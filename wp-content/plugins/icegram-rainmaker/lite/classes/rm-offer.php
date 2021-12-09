<?php

// bfcm 2021 Campaign
if ( ( get_option( 'rm_offer_bfcm_2021_icegram' ) !== 'yes' ) && Rainmaker::is_offer_period( 'bfcm') ) { 
    $img_url = $this->plugin_url . '../assets/images/bfcm2021.png';
    $ig_rm_plan = get_option( 'ig_rm_plan', 'lite' );
    if( 'lite' === $ig_rm_plan ){
        $img_url = $this->plugin_url .'../assets/images/bfcm2021_lite.png';
    }elseif( 'plus' === $ig_rm_plan || 'pro' === $ig_rm_plan ){
        $img_url = $this->plugin_url .'../assets/images/bfcm2021_pro.png';
    }
?>
    <style type="text/css">
        .ig_es_offer {	
			width:70%;
			margin: 0 auto;
			text-align: center;
			padding-top: 0.8em;
		}

    </style>
    <div class="ig_es_offer">
        <a target="_blank" href="?rm_dismiss_admin_notice=1&rm_option_name=rm_offer_bfcm_2021"><img style="margin:0 auto" src="<?php echo $img_url; ?>"/></a>
    </div>
<?php } ?>

