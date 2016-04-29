<?php
namespace Janis\Api;

use Janis\Api\Product\ProductRepository;
class Finance extends AbstractApi
{


	/**
	 * Example of an Endpoint
	 */
	protected function product() {
		if ($this->method == 'GET') {

			$db = new \PDO(
				'mysql:host=mysqldev.jetair.be;port=3306;dbname=*****;charset=UTF8;',
				'****',
				'****'
			);

			$repo = new ProductRepository( $db );

			$id = null;
			if( isset( $this->args[0] ) ) {
				$id = $this->args[0];
			}

			$type = null;
			if( isset( $this->args[1] ) ) {
				$type = $this->args[1];
			}

			$productList = $repo->find( $id, $type );

			return $productList->toArray();
		} else {
			return "Only accepts GET requests";
		}
	}
}