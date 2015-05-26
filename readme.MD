# Meta Eloquent

Meta Eloquent is an eloquent booster that allows it to easily manage HTTP Meta tags.

# Installation

## 1. Dependecy

Using composer, execute the following command to automatically update your composer.json:

```
composer require dishark/metaeloquent
```
or manually update your composer.json file

```
{
    "require": {
        "dishark/metaeloquent": "dev-master"
    }
}
```

## 2. Provider

You need to update your application configuration in order to register the package, so it can be loaded by Laravel. Just update your config/app.php file adding the following code at the end of your 'providers' section:

```php
// file START omitted
    'providers' => [
        // other providers omitted
        'Dishark\Metaeloquent\MetaEloquentServiceProvider',
    ],
// file END omitted
```

#Usage

Make sure to use `Dishark\Metaeloquent\Traits\MetaTrait` in your model. Then declare the `$metaAttributes` property specifying the metatag as the key and the column as the value.

Example 1:

````php
<?php App\Post;

use Dishark\Metaeloquent\Traits\MetaTrait;

class Post {
	use MetaTrait;

	protected $metaAttributes = [
		'author' => 'author',
		'description' => 'title',
		'keywords' => 'keywords',
	];
}
```

Sometimes the column isn't enough. Let's create some Meta accessor:

Example 2:

```php
<?php App\Post;

use Dishark\Metaeloquent\Traits\MetaTrait;

class Post {
	use MetaTrait;

	protected $metaAttributes = [
		'author' => 'author',
		'description' => 'title',
		'keywords' => 'keywords',
	];

	public function getMetaAuthor()
	{
		return $this->author->name;
	}
}
```

## View

In your view:

```php
@extends ('layout')

@section ('metadata')
{!! $post->meta() !!}
@endsection
```

The layout:

```php
<head>
@yield('metadata')
</head>
```

So now the author attribute will be called through this method instead.

## OpenGraph

```php
<?php App\Post;

use Dishark\Metaeloquent\Traits\MetaTrait;

class Post {
	use MetaTrait;

	protected $metaAttributes = [
		'author' => 'author',
		'description' => 'title',
		'keywords' => 'keywords',

		'og:title' => 'name',
		'og:image' => 'image',
		'og:type' => 'article',
		'og:url' => 'url'
	];

	public function getMetaImage()
	{
		return asset('images_path/' . $this->image);
	}

	public function getMetaUrl()
	{
		return route('articles', $this->slug);
	}
}
```