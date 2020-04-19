<?php
namespace W3sami\StripeBundle;

use W3sami\StripeBundle\DependencyInjection\W3samiStripeExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class W3samiStripeBundle extends Bundle
{
    /**
     * {@inheritDoc}
     * @version 0.0.1
     * @since 0.0.1
     */
    public function getContainerExtension()
    {
        // this allows us to have custom extension alias
        // default convention would put a lot of underscores
        if (null === $this->extension) {
            $this->extension = new W3samiStripeExtension();
        }

        return $this->extension;
    }

    /**
     * @inheritDoc
     */
    public function getParent()
    {
        // TODO: Implement getParent() method.
    }
}
