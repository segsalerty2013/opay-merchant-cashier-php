<?php

namespace Opay\Utility;

class AesCipher {

    private const OPENSSL_CIPHER_NAME = "aes-128-cbc";
    private const CIPHER_KEY_LEN = 16; //128 bits

    private $key;
    private $iv;

    public function __construct(string $iv, string $key)
    {
        $this->iv = $iv;
        $this->key = AesCipher::fixKey($key);
    }

    private static function fixKey(string $key) : string {

        if (strlen($key) < AesCipher::CIPHER_KEY_LEN) {
            //0 pad to len 16
            return str_pad("$key", AesCipher::CIPHER_KEY_LEN, "0");
        }

        if (strlen($key) > AesCipher::CIPHER_KEY_LEN) {
            //truncate to 16 bytes
            return substr($key, 0, AesCipher::CIPHER_KEY_LEN);
        }
        return $key;
    }

    /**
     * Encrypt data using AES Cipher (CBC) with 128 bit key
     * @param type $data - data to encrypt
     */
    public final function encrypt(string $data) : string {
        return base64_encode(openssl_encrypt($data, AesCipher::OPENSSL_CIPHER_NAME, $this->key, OPENSSL_RAW_DATA, $this->iv));
    }

    /**
     * Decrypt data using AES Cipher (CBC) with 128 bit key
     */
    public final function decrypt(string $data) : string {
        return openssl_decrypt(base64_decode($data), AesCipher::OPENSSL_CIPHER_NAME, $this->key, OPENSSL_RAW_DATA, $this->iv);
    }
}
