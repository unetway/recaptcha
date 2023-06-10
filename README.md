# Recaptcha

Пакет позволяет производить проверку reCAPTCHA на вашем сайте


## Установка

````
$ composer require unetway/recaptcha
````

## Использование

```
use Unetway\Recaptcha;

$secretKey = 'Ваш секретный ключ рекапчи';
$response = 'Значение response';
$ip = $_SERVER['HTTP_CLIENT_IP'];

$recaptcha = new Recaptcha($secretKey);
if ($recaptcha->siteVerify($response, $ip)) {
 echo 'Вы человек :)';
} else {
 echo 'Вы бот!';
}

```
