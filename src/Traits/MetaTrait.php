<?php namespace Dishark\Metaeloquent\Traits;

trait MetaTrait {
	public function parseMetaAttributes()
	{
		if(! is_array($this->metaAttributes)) return;

		foreach ($this->metaAttributes as $key => $attribute) {
			if (method_exists($this, 'getMeta' . $attribute)) {
				$this->metaAttributes[$key] = $this->{'getMeta' . $attribute}();

				continue;
			}

			$this->metaAttributes[$key] = ($this->$attribute) ? : $attribute;
		}

		return $this->metaAttributes;
	}

	public function meta()
	{
		$this->metaProviders = $this->metaProviders?:['w3c', 'og'];
		$metaAttributes = $this->parseMetaAttributes();
		$metaTags = '';

		foreach ($this->metaProviders as $provider) {
			if (app()->bound($provider)) {
				$metaTags .= app($provider)->provide($metaAttributes);

				continue;
			}

			if (app()->bound('dishark.metaeloquent.' . $provider)) {
				$metaTags .= app('dishark.metaeloquent.' . $provider)->provide($metaAttributes);
			}
		}

		return $metaTags;
	}
}