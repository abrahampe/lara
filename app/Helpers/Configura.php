<?php

namespace App\Helpers;

use Illuminate\Filesystem\Filesystem;


class Configura 
{
	
public function read($path = '')
	{
		$path = storage_path() . '/settings2.json';
		$data = json_decode(file_get_contents($path), true);


		if ($data === null) {
			throw new \RuntimeException("Invalid JSON in {$path}");
		}

			$collection = collect((object) $data);
		return $collection->pluck($path)->implode('');
	}


    	/**
	 * {@inheritdoc}
	 */
	protected function write(array $data)
	{
		$path = storage_path() . '/settings2.json';
		if ($data) {
			$contents = json_encode($data);
		} else {
			$contents = '{}';
		}


    $newJsonString = json_encode($contents, JSON_PRETTY_PRINT);

    file_put_contents($path, stripslashes($newJsonString));

	}

}