## Arquivos para OlCms

### Instalar o FileCms

```console
$ composer require orlandolibardi/filescms
```
### Configure o [intervention.io](http://intervention.io)
Abra o arquivo "config\app.php" e adicione a line em "aliases".
```php
...
'aliases' => [
...
'Image' => Intervention\Image\Facades\Image::class,
...
```
```console
$ php artisan vendor:publish --provider="Intervention\Image\ImageServiceProviderLaravel5"
```
### Storage
```console
$ php artisan storage:link
```
### Atualize a aplicação
```console
$ composer dump-autoload
```
### Seeder
```
$ php artisan db:seed --class=AdminFilesCmsTableSeeder
```

