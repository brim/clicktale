<?php



class Brim_ClickTale_Block_Bottom extends Brim_ClickTale_Block_Abstract {

    protected function _output() {

        $settings = ClickTale_Settings::Instance();

        $hash = $settings->UseStaticHash ? $settings->StaticHash : ClickTale_RandHash(20);

        Mage::register('clicktale_hash', $hash);

        $output = $this->ctData['BottomScript'];
        // Filter rules applied before cache pages
        foreach($this->ctRules as $rule)
        {
            $regnorm    = $rule["Pattern"];
            $regrep     = $rule["ReplaceWith"];
            $output     = preg_replace($regnorm,$regrep,$output,1);
        }

        // create token replacements arrays
        $tokens = array();

        $tokens["%FetchFromUrl%"] = str_replace(
            array("%CacheToken%","%ClickTaleCacheUrl%"),
            array($hash, Mage::getBaseUrl() . 'lib/ClickTale'),
            $settings->CacheFetchingUrl
        );
        $tokens["\\"] = "\\\\";
        $tokens["$"] = "\\$";

        $tokenKeys = array_keys($tokens);
        $tokenValues = array_values($tokens);

        $output = str_replace($tokenKeys, $tokenValues, $output);

        return $output;

    }
}