<?php
namespace Janis\Api\Product;

class Product
{
	protected $_properties;

	public function __construct()
	{
		$this->_properties = array(
			"productId"           => null,
			"productType"         => null,
			"supplierCode"        =>null,
			"supplierProductCode" => null,
			"internalProductCode" => null,
			"externalProductCode" => null,
		);
	}

	public function setId( $id )
	{
		$this->_properties["productId"] = $id;
	}

	public function getId()
	{
		return $this->_properties["productId"];
	}

	public function setType( $type )
	{
		$this->_properties["productType"] = $type;
	}

	public function getType()
	{
		return $this->_properties["productType"];
	}

	public function setSupplierCode( $code )
	{
		$this->_properties["supplierCode"] = $code;
	}

	public function getSupplierCode()
	{
		return $this->_properties["supplierCode"];
	}

	public function setSupplierProductCode( $code )
	{
		$this->_properties["supplierProductCode"] = $code;
	}

	public function getSupplierProductCode()
	{
		return $this->_properties['supplierProductCode'];
	}

	public function setInternalProductCode( $code )
	{
		$this->_properties["internalProductCode"] = $code;
	}

	public function getInternalProductCode()
	{
		return $this->_properties["internalProductCode"];
	}

	public function setExternalProductCode( $code )
	{
		$this->_properties["externalProductCode"] = $code;
	}

	public function getExternalProductCode()
	{
		return $this->_properties["externalProductCode"];
	}

	/**
	 * @return array
	 */
	public function toArray()
	{
		return $this->_properties;
	}
}