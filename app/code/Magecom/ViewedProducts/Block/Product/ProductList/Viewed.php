<?php

namespace Magecom\ViewedProducts\Block\Product\ProductList;

/**
 * Viewed products on product page
 *
 * @category Magecom
 * @package Magecom\ViewedProducts\Block\Product\ProductList
 * @author  Magecom
 */
class Viewed extends \Magento\Catalog\Block\Product\AbstractProduct
{
    /**
     * Viewed item collection
     *
     * @var \Magento\Catalog\Model\ResourceModel\Product\Link\Product\Collection
     */
    protected $_itemCollection;

    protected $_productLinkFactory;

    protected $_productRepository;

    /**
     * Prepare viewed items data
     *
     * @return $this
     */
    protected function _prepareData()
    {
        $product = $this->_coreRegistry->registry('product');
        /* @var $product \Magento\Catalog\Model\Product */

        $this->_itemCollection = $product->getViewedProductCollection();

        $this->_addProductAttributesAndPrices($this->_itemCollection);

        $this->_itemCollection->load();

        return $this;
    }

    /**
     * Before rendering html process
     * Prepare items collection
     *
     * @return $this
     */
    protected function _beforeToHtml()
    {
        $this->_prepareData();
        return $this;
    }

    /**
     * Retrieve viewed items collection
     *
     * @return array|\Magento\Framework\DataObject[]
     */
    public function getItems()
    {
        if (is_null($this->_itemCollection)) {
            $this->_prepareData();
        }

        $viewedProducts = $this->_itemCollection->getItems();
        $position = [];
        foreach ($viewedProducts as $viewedId => $viewedProduct) {
            $position[$viewedId] = $viewedProduct->getPosition();
        }

        array_multisort($position, SORT_ASC, $viewedProducts);

        return $viewedProducts;
    }
}