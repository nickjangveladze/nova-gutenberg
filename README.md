# Nova Gutenberg

A nova field for Laraberg

## Installation

Install via composer

```bash
composer require jangvel/nova-gutenberg
```

Publish Laraberg files

```bash
php artisan vendor:publish --provider="VanOns\Laraberg\LarabergServiceProvider"
```
Laraberg provides a CSS file that should be present on the page you want to render content on:

```html
<link rel="stylesheet" href="{{ asset('vendor/laraberg/css/laraberg.css') }}">
```
## Usage

Simply register the field in your Resource

```php
use Jangvel\NovaGutenberg\NovaGutenberg;

public function fields(Request $request)
{
    return [
        NovaGutenberg::make(__('Content'), 'content'),
    ];
}
```
Add the `RendersContent` trait to your model. And optionally define the `$contentColumn` property to point to the column that holds your Laraberg content, this defaults to `content`.

```php
use Illuminate\Database\Eloquent\Model;
use VanOns\Laraberg\Traits\RendersContent;

class Post extends Model
{
    use RendersContent;
    
    protected $contentColumn = 'content';
       
    ...
}
```

Call the render method on your model in a template.


```php
{!! $model->render() !!}
```

### Options

The field has a few options you can configure.

#### Height

You can customize the height of the editor.

```php
NovaGutenberg::make(__('Content'), 'content')->height(600)
```