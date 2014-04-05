<?php

class Brim_ClickTale_Block_Top extends Brim_ClickTale_Block_Abstract {
    protected function _output() {
        return $this->ctData['TopScript'];
    }
}