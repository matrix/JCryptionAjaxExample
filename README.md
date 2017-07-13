# JCryptionAjaxExample
Simple AJAX website to testing **jCryption Handler** Burp Suite Extender.
<br>
<br>
You can find the extension source code here
<br>
https://github.com/matrix/Burp-JCryption-Handler
<br>
or directly inside Burp Suite Free/Professional (BApp Store section).

## Usage
Get a copy of **JCryptionAjaxExample** repository
```sh
$ git clone https://github.com/matrix/JCryptionAjaxExample
```

Generate RSA Private/Public keys
```sh
$ ./genrsapubpriv.sh
Generating RSA private key, 1024 bit long modulus
....................++++++
.............++++++
e is 65537 (0x10001)
writing RSA key
```

Setup a web server with PHP
```sh
$ cd v3/www/
$ php -S 127.0.0.1:8888
PHP 5.5.38 Development Server started at Thu Jul 13 21:10:17 2017
Listening on http://127.0.0.1:8888
Document root is [PATH TO]/JCryptionAjaxExample/v3/www
Press Ctrl-C to quit.
```

Use a browser :)

Bye,
<br>
Matrix