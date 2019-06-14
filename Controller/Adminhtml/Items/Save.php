<?php
/**
 * @category   Amrendra
 * @package    Amrendra_CustomCatalog
 * @author     sachin.bluethink@gmail.com
 * @copyright  This file was generated by using Module Creator(http://code.vky.co.in/magento-2-module-creator/) provided by VKY <viky.031290@gmail.com>
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Amrendra\CustomCatalog\Controller\Adminhtml\Items;

class Save extends \Amrendra\CustomCatalog\Controller\Adminhtml\Items
{
    public function execute()
    {
        if ($this->getRequest()->getPostValue()) {
            try {
                $custom_catalog_model = $this->_objectManager->create('Amrendra\CustomCatalog\Model\CustomCatalog');
                $data = $this->getRequest()->getPostValue();
                $product_id = $this->getRequest()->getParam('id');
                if ($product_id) {
                    $custom_catalog_model->load($product_id);
                    if ($product_id != $custom_catalog_model->getId()) {
                        throw new \Magento\Framework\Exception\LocalizedException(__('The wrong item is specified.'));
                    }
                }

                $product_model = $this->_objectManager->create('Magento\Catalog\Model\Product')->load($data['product_id']);
                $product_model->setCopywriteinfo($data['copy_write_info']);
                $product_model->setVpn($data['vpn']);
                $product_model->save();

                $custom_catalog_model->setData($data);

                $session = $this->_objectManager->get('Magento\Backend\Model\Session');
                $session->setPageData($custom_catalog_model->getData());
                $custom_catalog_model->save();
                $this->messageManager->addSuccess(__('You saved the Catalog.'));
                $session->setPageData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('amrendra_customcatalog/*/edit', ['id' => $custom_catalog_model->getId()]);
                    return;
                }
                $this->_redirect('amrendra_customcatalog/*/');
                return;
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
                $id = (int)$this->getRequest()->getParam('id');
                if (!empty($id)) {
                    $this->_redirect('amrendra_customcatalog/*/edit', ['id' => $product_id]);
                } else {
                    $this->_redirect('amrendra_customcatalog/*/new');
                }
                return;
            } catch (\Exception $e) {
                $this->messageManager->addError(
                    __('Something went wrong while saving the item data. Please review the error log.')
                );
                $this->_objectManager->get('Psr\Log\LoggerInterface')->critical($e);
                $this->_objectManager->get('Magento\Backend\Model\Session')->setPageData($data);
                $this->_redirect('amrendra_customcatalog/*/edit', ['id' => $this->getRequest()->getParam('id')]);
                return;
            }
        }
        $this->_redirect('amrendra_customcatalog/*/');
    }
}
