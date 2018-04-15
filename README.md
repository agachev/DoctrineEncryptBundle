# DoctrineEncryptBundle
Symfony Bundle allows to create doctrine entities with fields that will be protected with help of some encryption algorithm in database and it will be clearly for developer, because bundle is uses doctrine life cycle events. Suitable for PHP 7.1+ since use openssl
There is perfect such bundle https://github.com/vmelnik-ukraine/DoctrineEncryptBundle . Unfortunatelly it used mycrypt php library that is deprecashed from PHP 7.1 so I use http://php.net/manual/en/book.openssl.php instead. In all other I follow architecture of V Melnik bundle. So users of vmelnik have just to change bundle name
# Usage
1 Dounload directories and files in your symfony project

2 Add Appkernel 
new EWS\Component\DoctrineEncryptBundle\EWSDoctrineEncryptBundle()

3 Add to config.yml 

```yaml
ews_doctrine_encrypt:
    secret_key: "%card_secret%"
    encryptor: "aes256"
    encryptor_class: ~
    encryptor_service: ~
    db_driver: "orm"
```
4 in parameters.yml

```card_secret: "yoursecretkey"```

in Entity
add 

```php
use EWS\Component\DoctrineEncryptBundle\Configuration\Encrypted;
```

and in filed that is encrypted 

```php
 /** 
  * @ORM\Column(name="trans_label", type="string", length=255, nullable=true)
  * @Encrypted
  */
    private $transLabel;
```    
Do not forget to given enough length to encrypted field since openssl long enough data 

I will add composer and examples soon
