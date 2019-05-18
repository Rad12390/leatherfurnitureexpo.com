<?php

require_once(DIR_SYSTEM . 'library/device_detect/Mobile_Detect.php');

class DeviceDetect extends Mobile_Detect {

    private $screen;

    public function __construct($registry) {
        parent::__construct();
        $this->request = $registry->get('request');
        $this->screen = ($this->isMobile()) ? ($this->isTablet()) ? 'tablet' : 'phone' : 'computer';
    }

    public function body_class($classes = array()) {

// top level
        if ($this->ishandheld()) {
            $classes[] = "handheld";
        };
        if ($this->isMobile()) {
            $classes[] = "phone";
        };
        if ($this->is_ios()) {
            $classes[] = "ios";
        };
        if ($this->isTablet()) {
            $classes[] = "tablet";
        };

        // specific
        /*  if ( is_iphone() ) { $classes[] = "iphone"; };
          if ( is_ipad() ) { $classes[] = "ipad"; };
          if ( is_ipod() ) { $classes[] = "ipod"; };
          if ( is_android() ) { $classes[] = "android"; };
          if ( is_blackberry() ) { $classes[] = "blackberry"; };
          if ( is_opera_mobile() ) { $classes[] = "opera-mobile";}
          if ( is_webos() ) { $classes[] = "webos";}
          if ( is_symbian() ) { $classes[] = "symbian";}
          if ( is_windows_mobile() ) { $classes[] = "windows-mobile"; }
          if ( is_motorola() ) { $classes[] = "motorola"; }
          if ( is_samsung() ) { $classes[] = "samsung"; }
          if ( is_samsung_tablet() ) { $classes[] = "samsung-tablet"; }
          if ( is_sony_ericsson() ) { $classes[] = "sony-ericsson"; }
          if ( is_nintendo() ) { $classes[] = "nintendo"; } */
        //if (is_lg()) { $classes[] = "lg"; }
        //if (is_smartphone()) { $classes[] = "smartphone"; }
        //if (is_nokia()) { $classes[] = "nokia"; }
        // bonus
        if (!$this->ishandheld()) {
            $classes[] = "computer";
        }



        /* if ( $is_lynx ) { $classes[] = "lynx"; }
          if ( $is_gecko ) { $classes[] = "gecko"; }
          if ( $mobble_detect->is( 'Gecko' ) ) { $classes[] = "gecko"; }
          if ( $is_opera ) { $classes[] = "opera"; }
          if ( $mobble_detect->is( 'Opera' ) ) { $classes[] = "opera"; }
          if ( $is_NS4 ) { $classes[] = "ns4"; }
          if ( $is_safari ) { $classes[] = "safari"; }
          if ( $mobble_detect->is( 'Safari' ) ) { $classes[] = "safari"; }
          if ( $is_chrome ) { $classes[] = "chrome"; }
          if ( $mobble_detect->is( 'Chrome' ) ) { $classes[] = "chrome"; }
          if ( $is_IE ) { $classes[] = "ie"; }
          if ( $mobble_detect->is( 'IE' ) ) { $classes[] = "ie"; } */

        return $classes;
    }

    public function getScreen() {
//        if($this->request->get['screen']) {
//        return $this->request->get['screen'];
//    }
        return $this->screen;
    }
}
