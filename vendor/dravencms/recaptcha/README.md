# DravenCMS recaptcha meta package

This is a Draven CMS recaptcha metapackage

## Instalation

The best way to install dravencms/recaptcha is using  [Composer](http://getcomposer.org/):


```sh
$ composer require dravencms/recaptcha
```

After installation add this code to your `app/config/settings.neon`

```neon
recaptcha:
	secretKey: 6Lfv2A4UAAAAAPg8HMcwsXXXXXXXXXXXXXXX  # Use your own secretKey
	siteKey: 6Lfv2A4UAAAAAKkmkrDnXXXXXXXXXXXXXXX  # Use your own site key
```
