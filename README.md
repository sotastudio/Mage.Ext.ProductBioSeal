# Product Bio Seal

## What does it do?

Displays a Bio Seal on a per Product level.

## How to use?

The module already injects a template file where you can achieve most stuff. But if you are planning to remove the cart button for example, you can even more by implementing the Block Class into other views by doing the following magic:

	<?php $pbs_className = Mage::getConfig()->getBlockClassName('sota_pbs/view'); ?>
	<?php $pbs_block = new $pbs_className(); ?>
	<?php if ($pbs_block->isApplicable()): ?>
		<p>Crazy stuff hapening here…</p>
	<?php endif; ?>


## Dependencies

* Mage_Catalog
* Mage_CatalogInventory


## Known problems

Just one: please adjust your attribute set name in /app/code/community/SotaStudio/ProductBioSeal/sql/productbioseal_setup/mysql4-install-1.0.0.php on line 26. It defaults to "Default", but maybe it is called "Standard" or something else within your project.