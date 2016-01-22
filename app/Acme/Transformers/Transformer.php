<?php  namespace App\Acme\Transformers;

abstract class Transformer{

	/**
	 * Tranform a array of items
	 * @param  $items
	 * @return array
	 */
	public function tranformArray($items)
	{
		return array_map([$this,'transform'], $items);
	}

	public abstract function transform($item);
}

?>