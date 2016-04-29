<?php
namespace Janis\Api\Product;

class ProductRepository
{
	/**
	 * @var \PDO
	 */
	protected  $_pdo;

	public function __construct( \PDO $pdo )
	{
		$this->_pdo = $pdo;
	}

	const PRODUCT_TYPE_LEISURE = 'leisure';
	const PRODUCT_TYPE_HOTEL   = 'hotel';

	/**
	 * @param string $id
	 * @param string $type
	 *
	 * @return \Janis\Api\Product\ProductList
	 */
	public function find( $id = null, $type = null )
	{
		$from = microtime(true);
		$products = new \Janis\Api\Product\ProductList();

		switch( $type ) {
			case self::PRODUCT_TYPE_HOTEL:
				$products->setProducts( $this->_getHotelProducts($id) );
				break;
			case self::PRODUCT_TYPE_LEISURE:
				$products->setProducts( $this->_getLeisureProducts($id) );
				break;
			default:
				$products->setProducts( $this->_getHotelProducts($id) );
				$products->setProducts( $this->_getLeisureProducts($id) );
		}

		$done = (microtime(true) - $from);

		return $products;

	}

	private function _getHotelProducts( $id = null )
	{
		$sql = "
			SELECT
				ID,
				SUPPLIER,
				SUPPLIER_HOTEL,
				INTERNAL_HOTEL,
				RACS_HOTEL
			FROM
				jaros_purchase.supplier_interface_hotel
		";

		$where = array();
		$bind  = array();

		if( is_string( $id ) ) {
			$where[]    = " ID = :id ";
			$bind["id"] = $id;
		}

		if( ! empty( $where ) ) {
			$sql .= " WHERE " . implode( " AND ", $where );
		}

		$stmt = $this->_pdo->prepare($sql);
		$stmt->execute($bind);

		$products = array();

		while ( $row = $stmt->fetch() ) {
			$product = new \Janis\Api\Product\Product();

			$product->setId( $row["ID"] );
			$product->setType( self::PRODUCT_TYPE_HOTEL );
			$product->setSupplierCode( $row["SUPPLIER"] );
			$product->setSupplierProductCode( $row["SUPPLIER_HOTEL"] );
			$product->setInternalProductCode( $row["INTERNAL_HOTEL"] );
			$product->setExternalProductCode( $row["RACS_HOTEL"] );

			$products[] = $product;
		}

		return $products;
	}

	private function _getLeisureProducts( $id = null )
	{
		$sql = "
			SELECT
				ID,
				SUPPLIER,
				SUPPLIER_LEISURE,
				INTERNAL_LEISURE
			FROM
				jaros_purchase.supplier_interface_leisure
		";

		$where = array();
		$bind  = array();

		if( is_string( $id ) ) {
			$where[]    = " ID = :id ";
			$bind["id"] = $id;
		}

		if( ! empty( $where ) ) {
			$sql .= " WHERE " . implode( " AND ", $where );
		}

		$stmt = $this->_pdo->prepare( $sql );
		$stmt->execute( $bind );

		$products = array();

		while ( $row = $stmt->fetch() ) {
			$product = new \Janis\Api\Product\Product();

			$product->setId( $row["ID"] );
			$product->setType( self::PRODUCT_TYPE_LEISURE );
			$product->setSupplierCode( $row["SUPPLIER"] );
			$product->setSupplierProductCode( $row["SUPPLIER"] );
			$product->setInternalProductCode(  $row["SUPPLIER_LEISURE"]);

			$products[] = $product;
		}

		return $products;
	}
}