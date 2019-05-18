<?php
final class Encryptioner {
	private static $key;
	private static $iv ;
        
	private function __construct() {
        
	}
        
        private static function key() {
            $key = 'd0e55861b0902ac16012ce53daf174c4';
            if(!self::$key) {
                self::$key = hash('sha256', $key, true);
            }
            if(!self::$iv) {
		self::$iv = mcrypt_create_iv(32, MCRYPT_RAND);
            }
	}
	
	public static function encrypt($value) {
                self::key();
               return strtr(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, self::$key, $value, MCRYPT_MODE_ECB, self::$iv)), '+/=', '-_,');
	}
	
	public function decrypt($value) {
                 self::key();
		return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, self::$key, base64_decode(strtr($value, '-_,', '+/=')), MCRYPT_MODE_ECB, self::$iv));
	}
}

?>