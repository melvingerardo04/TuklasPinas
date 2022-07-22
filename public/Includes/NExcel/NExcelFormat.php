<?php
namespace App\Includes\NExcel;
use PHPExcel;
class NExcelFormat {
    
    private $format = array("font" => array(), "borders" => array("style"=>array()), "numberformat" => array(), "alignment"=>array("horizontal"=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,"vertical"=>PHPExcel_Style_Alignment::VERTICAL_CENTER,"wrap"=>true));
    private $_isLocked = 0;

    function __construct($options, $new = false) {

        if ($new) {
            $this->format = $options;
        } else if (!$new) {
            foreach ($options as $k => $v) {
                switch (strtolower($k)) {
                case "bold":
                    $this->setBold($v);
                    break;
                case "size":
                    $this->setSize($v);
                    break;
                case "border":
                    $this->setBorder($v);
                    break;
                }
            }
        }
    }

    public function setAlign($align=''){
        switch($align){
            case "left":
            $this->format["alignment"]["horizontal"] = PHPExcel_Style_Alignment::HORIZONTAL_LEFT;
            break;
            case "right":
            $this->format["alignment"]["horizontal"] = PHPExcel_Style_Alignment::HORIZONTAL_RIGHT;
            break;
            case "center":
            $this->format["alignment"]["horizontal"] = PHPExcel_Style_Alignment::HORIZONTAL_CENTER;
            break;
            default:
            $this->format["alignment"]["horizontal"] = PHPExcel_Style_Alignment::HORIZONTAL_LEFT;
        }
        return $this;
    }

    public function setBgColor($color){
            
            if($color):
                $this->format["fill"]["color"]['rgb'] = $color;
                $this->format["fill"]["type"] = PHPExcel_Style_Fill::FILL_SOLID;
            endif;
        return $this;
    }
    // public function setFgColor($color){
        
    //         if($color):
    //             $this->format["fill"]["color"]['rgb'] = $color;
    //             $this->format["fill"]["type"] = PHPExcel_Style_Fill::FILL_SOLID;
    //         endif;
    //     return $this;
    // }
    public function setWrap($wrap=true){
        $this->format["alignment"]["wrap"] = $wrap;
        return $this;
    }
    public function setTextWrap($wrap=true){
        $this->format["alignment"]["wrap"] = $wrap;
        return $this;
    }
    public function setBold($val = 1) {
        if (!$this->_isLocked) {
            $this->format["font"]["bold"] = (bool) $val;
        }
        return $this;
    }
    public function setItalic($val = 1) {
        if (!$this->_isLocked) {
            $this->format["font"]["italic"] = (bool) $val;
        }
        return $this;
    }
    public function setSize($val = 10) {
        if (!$this->_isLocked) {
            $this->format["font"]["size"] = floatval($val);
        }
        return $this;
    }
    public function setFont($font) {
        if (!$this->_isLocked) {
            $this->format["font"]["name"] = $font;
        }
        return $this;
    }
    public function getSize() {
        return $this->format["font"]["size"];
    }
    public function setNumFormat($format) {
        $this->format["numberformat"]["code"] = $format;
        return $this;
    }

    public function setBottom($style) {
        $style = $this->_getStyleClass($style);
        if (!$this->_isLocked) {
            $this->format["borders"]["bottom"]["style"] = $style;
        }
    }
    public function setTop($style) {
        $style = $this->_getStyleClass($style);
        if (!$this->_isLocked) {
            $this->format["borders"]["top"]["style"] = $style;
        }
    }
    public function setLeft($style) {
        $style = $this->_getStyleClass($style);
        if (!$this->_isLocked) {
            $this->format["borders"]["left"]["style"] = $style;
        }
    }

    public function setRight($style) {
        $style = $this->_getStyleClass($style);
        if (!$this->_isLocked) {
            $this->format["borders"]["right"]["style"] = $style;
        }
    }

    public function setBorder($style) {
        if (!$this->_isLocked) {
            $this->setBottom($style);
            $this->setTop($style);
            $this->setLeft($style);
            $this->setRight($style);
        }
    }
    private function _getStyleClass($style){
        switch($style){
            case 2:
            $style = PHPExcel_Style_Border::BORDER_THICK;
            break;
            default:
            $style = PHPExcel_Style_Border::BORDER_THIN;
        }
        return $style;
    }

    public function getFormat() {
        return array_filter($this->format);
    }

    public function setLocked() {
        $this->_isLocked = 1;
        return $this;
    }
    public function setUnlocked() {
        $this->_isLocked = 0;
        return $this;
    }
    public function __clone() {
        $this->setUnlocked();
    }

}

?>