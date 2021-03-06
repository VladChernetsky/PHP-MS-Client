<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 1/13/2018
 * Time: 12:50 PM
 */

namespace SphereMall\MS\Lib\Prices;

use SphereMall\MS\Exceptions\SMSDKException;

/**
 * Class PriceConfigurationFilter
 * @package SphereMall\MS\Lib\Prices
 * @property PriceProduct[] $products;
 */
class PriceConfigurationFilter
{
    #region [Properties]
    protected $products;
    #endregion

    #region [Public methods]
    public function addProduct(PriceProduct $product)
    {
        $this->products[] = $product;
    }

    /**
     * @throws SMSDKException
     */
    public function getData()
    {
        if (empty($this->products)) {
            throw new SMSDKException("Property products is empty. Add at least one product for filtering");
        }

        $data = [];
        foreach ($this->products as $product) {
            $data[] = [
                'priceTypeId' => $product->priceTypeId,
                'productId'   => $product->productId,
            ];
        }

        return ['filters' => json_encode($data)];
    }

    #endregion
}