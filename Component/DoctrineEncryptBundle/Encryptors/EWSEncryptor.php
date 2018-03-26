<?php

namespace EWS\Component\DoctrineEncryptBundle\Encryptors;

/**
 * Class for EWSEncryptor encryption
 * 
 * @author Andrey Gachev andrey.gachev@gmail.com
 */
class EWSEncryptor implements EncryptorInterface {

    /**
     * @var string
     */
    private $secretKey;

    /**
     * @var string
     */
    private $initializationVector;

    /**
     * {@inheritdoc}
     */
    public function __construct($key) {
        $this->secretKey = md5($key);

    }

    /**
     * {@inheritdoc}
     */
    public function encrypt($data) {
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($data, $cipher, $this->secretKey, $options=OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $this->secretKey, $as_binary=true);
        $ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
        return $ciphertext;
    }

    /**
     * {@inheritdoc}
     */
    public function decrypt($data) {
        $c = base64_decode($data);
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len=32);
        $ciphertext_raw = substr($c, $ivlen+$sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $this->secretKey, $options=OPENSSL_RAW_DATA, $iv);
        // $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
        return $original_plaintext;
    }
}
