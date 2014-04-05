<?php

if (!defined('ClickTale_Root')) {
	define ("ClickTale_Root", Mage::getBaseDir().'/lib/ClickTale/');
}

require_once 'ClickTale'.DS.'ClickTale.inc.php';

abstract class Brim_ClickTale_Block_Abstract extends Mage_Core_Block_Abstract {

    abstract protected function _output();


    protected function _toHtml() {

//        if(!ClickTale_CheckQueryStringParamsForRecording())
//       	{
//       		if (ClickTale_CheckCookieFlagForRecording())
//       		{
//       			return '';
//       		}
//       	}

        try
       	{
       		// Data contains data from the scripts file.
       		$this->ctData = ClickTale_LoadScripts(ClickTale_Settings::Instance()->ScriptsFile);
       		// Filtering rules from XML file
       		$this->ctRules = ClickTale_LoadRules(ClickTale_Settings::Instance()->FilterRulesFile);
       	}
       	catch (Exception $ex)
       	{
            Mage::logException($ex);
            return '';
       	}


        return $this->_output();
    }
}