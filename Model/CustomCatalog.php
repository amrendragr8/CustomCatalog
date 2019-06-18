<?php
/**
 * @category   Amrendra
 * @package    Amrendra_CustomCatalog
 * @author     sachin.bluethink@gmail.com
 * @copyright  This file was generated by using Module Creator(http://code.vky.co.in/magento-2-module-creator/) provided by VKY <viky.031290@gmail.com>
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Amrendra\CustomCatalog\Model;

use Magento\Framework\Model\AbstractModel;

class CustomCatalog extends AbstractModel
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('Amrendra\CustomCatalog\Model\ResourceModel\CustomCatalog');
    }
}