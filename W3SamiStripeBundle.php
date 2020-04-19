<?php
namespace W3Sami\StripeBundle;

use W3Sami\StripeBundle\DependencyInjection\W3SamiStripeExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class W3SamiStripeBundle extends Bundle
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
            $this->extension = new W3SamiStripeExtension();
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
