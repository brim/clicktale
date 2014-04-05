<?php

class Brim_ClickTale_Model_Observer {

    public function saveResponseToCache(Varien_Event_Observer $observer) {
        if (($hash = Mage::registry('clicktale_hash'))) {

            try {
                $response       = $observer->getFront()->getResponse();

                $cacheProvider  = ClickTale_CacheFactory::DefaultCacheProvider();
                $config         = ClickTale_Settings::Instance()->getCacheProviderConfig();

                // remove clicktale blocks
                $body = $response->getBody();

                $newBody = preg_replace('/\<!\-\- ClickTale ([\w\d\s]+) \-\-\>(.*)\<!\-\- ClickTale end of \1 \-\-\>/siU', '', $body);

                $cacheProvider->store($hash, $newBody, $config);
            } catch (Exception $e) {
                Mage::logException($e);
            }
        }
    }
}