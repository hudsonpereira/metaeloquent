<?php namespace Dishark\Metaeloquent\Providers;

class W3cProvider implements MetaProviderInterface {
	public function provide($attributes)
	{
		$output = '';

		$output .= (isset($attributes['author'])) ? "<meta name=\"author\" content=\"{$attributes['author']}\">" : '';
		$output .= (isset($attributes['description'])) ? "<meta name=\"description\" content=\"{$attributes['description']}\">" : '';
		$output .= (isset($attributes['keywords'])) ? "<meta name=\"keywords\" content=\"{$attributes['keywords']}\">" : '';

		return $output;
	}
}