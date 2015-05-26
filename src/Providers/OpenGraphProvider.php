<?php namespace Dishark\Metaeloquent\Providers;

class OpenGraphProvider implements MetaProviderInterface {
	public function provide($attributes)
	{
		$output = '';

		$ogKeys = array_filter(array_flip($attributes), function($key){
			return strpos($key, 'og:') === 0;
		});

		$ogKeys = array_flip($ogKeys);

		foreach ($ogKeys as $key => $value) {
			$output .= "<meta property=\"{$key}\" content=\"{$value}\" />";
		}

		return $output;
	}
}