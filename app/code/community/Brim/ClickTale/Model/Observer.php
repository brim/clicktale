<?php

class Brim_ClickTale_Model_Observer {

    public function saveResponseToCache(Varien_Event_Observer $observer) {
        if (($hash = Mage::registry('clicktale_hash'))) {

            $response       = $observer->getFront()->getResponse();

            $cacheProvider  = ClickTale_CacheFactory::DefaultCacheProvider();
            $config         = ClickTale_Settings::Instance()->getCacheProviderConfig();

            $cacheProvider->store($hash, $response->getBody(), $config);
        }
    }
}