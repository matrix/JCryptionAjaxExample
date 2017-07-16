# JCryptionAjaxExample
Simple AJAX and PHP Web App to testing **jCryption-Handler** Burp Suite Extension.
<br>
<br>
You can find the extension source code here
<br>
https://github.com/matrix/Burp-JCryption-Handler
<br>
or you can load it directly from *Burp Suite Free/Professional* (BApp Store section).
<br>
For use the *Active Scanner* you need obviously the Professional edition.

**Note for Burp Suite users**:
<br>
there's a bug (probably generated by my extension) that causes the Active Scanner stop.
<br>
The workaround is disable the *Suspicious input transformation* from the *Active Scanner Areas* settings.

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
PHP 7.1.6 Development Server started at Sun Jul 16 09:19:46 2017
Listening on http://127.0.0.1:8888
Document root is [PATH TO]/JCryptionAjaxExample/v3/www
Press Ctrl-C to quit.
```

### jCryption v2.x / v1.x
If you want some fresh keys you can use the **generator.php** but you need also the following packages:
#### Linux (apt-get)
- php7.0
- php7.0-gmp
- php7.0-bcmath
#### OSX (brew)
- php71
- php71-gmp

You can use the following command:
#### Linux
```sh
$ apt-get install php7.0 php7.0-gmp php7.0-bcmath
$ php7.0 generator.php
```
#### OSX
```sh
$ brew tap homebrew/homebrew-php
==> Tapping homebrew/php
Cloning into '/usr/local/Homebrew/Library/Taps/homebrew/homebrew-php'...
remote: Counting objects: 757, done.
remote: Compressing objects: 100% (525/525), done.
remote: Total 757 (delta 496), reused 296 (delta 223), pack-reused 0
Receiving objects: 100% (757/757), 309.13 KiB | 0 bytes/s, done.
Resolving deltas: 100% (496/496), done.
Tapped 723 formulae (772 files, 1.4MB)
$ brew install php71
==> Installing php71 from homebrew/php
==> Installing dependencies for homebrew/php/php71: libpng, freetype, icu4c, jpeg, unixodbc
==> Installing homebrew/php/php71 dependency: libpng
[...]
$ brew install php71-gmp
==> Installing php71-gmp from homebrew/php
[...]
$ export PATH="$(brew --prefix homebrew/php/php71)/bin:$PATH"
$ php -v
PHP 7.1.6 (cli) (built: Jun 23 2017 08:42:20) ( NTS )
Copyright (c) 1997-2017 The PHP Group
Zend Engine v3.1.0, Copyright (c) 1998-2017 Zend Technologies
$ php generator.php
```

The file named **100_1024_keys.inc.php**, present in **(v1|v2)/www/include** directories, will be replaced with a fresh one.

#### Setup a web server with PHP and jCryption v2.x
```sh
$ cd v2/www/
$ php -S 127.0.0.1:8888
PHP 7.1.6 Development Server started at Sun Jul 16 09:18:58 2017
Listening on http://127.0.0.1:8888
Document root is [PATH TO]/JCryptionAjaxExample/v2/www
Press Ctrl-C to quit.
```

#### Setup a web server with PHP and jCryption v1.x
```sh
$ cd v1/www/
$ php -S 127.0.0.1:8888
PHP 7.1.6 Development Server started at Sun Jul 16 09:18:34 2017
Listening on http://127.0.0.1:8888
Document root is [PATH TO]/JCryptionAjaxExample/v1/www
Press Ctrl-C to quit.
```

Now you can use a browser :)

Bye,
<br>
Matrix
