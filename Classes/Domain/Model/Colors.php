<?php
namespace Piramidex\Mscolors\Domain\Model;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Alfredo A. Villalba Castro <piramidex@gmail.com>, Viboo Technologies
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Colors
 */
class Colors extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * name
	 *
	 * @var string
	 */
	protected $name = '';

	/**
	 * code
	 *
	 * @var string
	 */
	protected $code = '';

	/**
	 * image
	 *
	 * @var string
	 */
	protected $image = '';

	/**
	 * attributeId
	 *
	 * @var integer
	 */
	protected $attributeId = 0;

	/**
	 * productId
	 *
	 * @var integer
	 */
	protected $productId = 0;

	/**
	 * Returns the name
	 *
	 * @return string $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Returns the code
	 *
	 * @return string $code
	 */
	public function getCode() {
		return $this->code;
	}

	/**
	 * Sets the code
	 *
	 * @param string $code
	 * @return void
	 */
	public function setCode($code) {
		$this->code = $code;
	}

	/**
	 * Returns the image
	 *
	 * @return string $image
	 */
	public function getImage() {
		return $this->image;
	}

	/**
	 * Sets the image
	 *
	 * @param string $image
	 * @return void
	 */
	public function setImage($image) {
		$this->image = $image;
	}

	/**
	 * Returns the attributeId
	 *
	 * @return integer attributeId
	 */
	public function getAttributeId() {
		return $this->attributeId;
	}

	/**
	 * Sets the attributeId
	 *
	 * @param integer $attributeId
	 * @return integer attributeId
	 */
	public function setAttributeId($attributeId) {
		$this->attributeId = $attributeId;
	}

	/**
	 * Returns the productId
	 *
	 * @return integer $productId
	 */
	public function getProductId() {
		return $this->productId;
	}

	/**
	 * Sets the productId
	 *
	 * @param integer $productId
	 * @return void
	 */
	public function setProductId($productId) {
		$this->productId = $productId;
	}

}