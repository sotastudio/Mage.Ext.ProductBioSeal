<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    SotaStudio
 * @package     SotaStudio_AvailabilityTimeLapse
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Product View block
 *
 * @author   Andy Hausmann <andy@sota-studio.de>
 */
class SotaStudio_ProductBioSeal_Block_View extends Mage_Catalog_Block_Product_Abstract
{
	// Field definitions
	const attrName				= 'display_bio_seal';
	// System Config Paths for this module
	const confPath_Enable 		= 'cataloginventory/bio_seal/enable';
	const confPath_LinkUrl 		= 'cataloginventory/bio_seal/link_url';
	const confPath_LinkTarget	= 'cataloginventory/bio_seal/link_target';

	protected $isApplicable		= null;


	public function __construct()
	{
		if ($this->isEnabled() && $this->getProductSealState()) {
			$this->isApplicable = true;
		} else {
			$this->isApplicable = false;
		}
	}


	public function isApplicable()
	{
		return ($this->isApplicable != null) ? $this->isApplicable : false;
	}

	/**
	 * Checks whether the module is enabled or not.
	 * This is being set up via backend (System -> Config).
	 *
	 * @return bool
	 */
	protected function isEnabled()
	{
		return ($this->getStoreConfig(self::confPath_Enable)) ? true : false;
	}

	/**
	 * Small helper to check whether it is allowed to display the seal at the product.
	 *
	 * @return string
	 */
	protected function getProductSealState()
	{
		return $this->getProduct()->getData(self::attrName);
	}

	public function getLinkUrl()
	{
		return $this->getStoreConfig(self::confPath_LinkUrl);
	}

	public function getLinkTarget()
	{
		return $this->getStoreConfig(self::confPath_LinkTarget);
	}

	/**
	 * Small helper to get Store Config Flags.
	 *
	 * @param $flag
	 * @return bool
	 */
	protected function getStoreConfig($flag)
	{
		return Mage::getStoreConfig($flag);
	}

	/**
	 * Retrieve current product model
	 *
	 * @return Mage_Catalog_Model_Product
	 */
	public function getProduct()
	{
		if (!Mage::registry('product') && $this->getProductId()) {
			$product = Mage::getModel('catalog/product')->load($this->getProductId());
			Mage::register('product', $product);
		}
		return Mage::registry('product');
	}

}