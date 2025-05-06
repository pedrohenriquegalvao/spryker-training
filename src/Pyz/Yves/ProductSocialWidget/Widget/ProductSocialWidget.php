<?php

namespace Pyz\Yves\ProductSocialWidget\Widget;

use Generated\Shared\Transfer\ProductViewTransfer;
use Spryker\Yves\Kernel\Widget\AbstractWidget;

class ProductSocialWidget extends AbstractWidget {

 
    protected const PARAMETER_PRODUCT_NAME = 'productName';
    protected const PARAMETER_PRODUCT_URL = 'productUrl';
    protected const PARAMETER_SOCIALICONS = 'socialIcons';

    /**
     * @param string $productName
     * @param string $productUrl
     * @param array<string> $socialIcons An array of social media icons to be displayed.
     */
    public function __construct(string $productName, string $productUrl, array $socialIcons) {
        $this->addProductNameParameter($productName);
        $this->addProductUrlParameter($productUrl);
        $this->addSocialIconsParameter($socialIcons);
    }

    public static function getName(): string
    {
        return 'ProductSocialWidget';
    }

    public static function getTemplate(): string
    {
        return '@ProductSocialWidget/views/product-social-widget/product-social-widget.twig';
    }

    public function addProductNameParameter(string $productName): void
    {
        $this->addParameter(static::PARAMETER_PRODUCT_NAME, $productName);
    }

    public function addProductUrlParameter(string $productUrl): void
    {
        $this->addParameter(static::PARAMETER_PRODUCT_URL, $productUrl);
    }

    public function addSocialIconsParameter(array $socialIcons): void {
        $this->addParameter(static::PARAMETER_SOCIALICONS, $socialIcons);
    }

}