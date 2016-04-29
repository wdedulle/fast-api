<?php
namespace Janis\Api\Product;

class ProductList
{
	protected $_properties = array();

	public function setProducts( array $products = array() )
	{
		foreach( $products as $product ) {
			$this->addProduct( $product );
		}
	}

	public function addProduct( \Janis\Api\Product\Product $product )
	{
		$this->_properties[] = $product->toArray();
	}

	/**
	 * @return array
	 */
	public function toArray()
	{
		return $this->_properties;
	}
}