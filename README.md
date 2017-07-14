# JCryptionAjaxExample
Simple AJAX and PHP Web App to testing **jCryption-Handler** Burp Suite Extension.
<br>
<br>
You can find the extension source code here
<br>
https://github.com/matrix/Burp-JCryption-Handler
<br>
or you can load it directly from Burp Suite Free/Professional (BApp Store section).

**Note for Burp Suite users**:
<br>
there's a bug, probably generated by my extension, that causes the Active Scanner stop.
<br>
The workaround is disable the "Suspicious input transformation" from the "Active Scanner Areas" settings.

## Usage
Get a copy of **JCryptionAjaxExample** repository
```sh
$ git clone https://github.com/matrix/JCryptionAjaxExample
```

### jCryption v3.x
Generate RSA Private/Public keys 
```sh
$ ./genrsapubpriv.sh
Generating RSA private key, 1024 bit long modulus
....................++++++
.............++++++
e is 65537 (0x10001)
writing RSA key
```
#### Setup a web server with PHP and jCryption v3.x
```sh
$ cd v3/www/
$ php -S 127.0.0.1:8888
PHP 5.5.38 Development Server started at Thu Jul 13 21:10:17 2017
Listening on http://127.0.0.1:8888
Document root is [PATH TO]/JCryptionAjaxExample/v3/www
Press Ctrl-C to quit.
```

### jCryption v2.x
If you want some fresh keys you can use the **generator.php** but you need also the following packages:
#### Linux (apt-get)
- php7.0
- php7.0-gmp
- php7.0-bcmath
#### OSX (brew)
- php71
- php71-gmp

Then you can use the following command:
#### Linux
```sh
$ php7.0 generator.php
```
#### OSX
```sh
$ export PATH="$(brew --prefix homebrew/php/php71)/bin:$PATH"
$ php -v
PHP 7.1.6 (cli) (built: Jun 23 2017 08:42:20) ( NTS )
Copyright (c) 1997-2017 The PHP Group
Zend Engine v3.1.0, Copyright (c) 1998-2017 Zend Technologies
$ php generator.php
```

The file named **100_1024_keys.inc.php**, present in **v2/www/include** directory, will be replaced with a fresh one.

#### Setup a web server with PHP and jCryption v2.x
```sh
$ cd v2/www/
$ php -S 127.0.0.1:8888
PHP 5.5.38 Development Server started at Fri Jul 14 19:03:54 2017
Listening on http://127.0.0.1:8888
Document root is [PATH TO]/JCryptionAjaxExample/v2/www
Press Ctrl-C to quit.
```

Now you can use a browser :)

Bye,
<br>
Matrix
