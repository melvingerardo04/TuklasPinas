<?php
class NExcelFormat {
    private $format = array("font" => array(), "borders" => array("style"=>array()), "numberformat" => array(), "alignment"=>array("horizontal"=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,"vertical"=>PHPExcel_Style_Alignment::VERTICAL_CENTER,"wrap"=>true));
    private $_isLocked = 0;

    public function __construct($options, $new = false) {
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
    public function setWrap($wrap=true){
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

class nExcel extends PHPExcel {
    private $filename = "report";
    private $newSheet = "";
    private $_isSent="";
    function __construct() {
        parent::__construct();
    }
    public function __call($method, $args) {
        switch ($method) {
            case "freezePane":
                $this->getActiveSheet()->freezePane($args[0]);
            break;

            case "write":
            case "writeFormula":
            $cell = $this->getActiveSheet()->setCellValueByColumnAndRow($args[1], $args[0] + 1, $args[2], 1);
            if (is_array($args[3])) {
                $cell->getStyle()->applyFromArray($args[3]);
            } else if ($args[3] instanceof NExcelFormat) {
                $cell->getStyle()->applyFromArray($args[3]->getFormat());
            }
            break;

            case "writeString":
            $cell = $this->getActiveSheet()->setCellValueByColumnAndRow($args[1], $args[0] + 1, $args[2], 1);
            if (is_array($args[3])) {
                $cell->getStyle()->applyFromArray($args[3]);
            } else if ($args[3] instanceof NExcelFormat) {
                $cell->getStyle()->applyFromArray($args[3]->getFormat());
            }

          #  $cell->getActiveSheet()
            break;

            case "writeBlank":
                $cell = $this->getActiveSheet()->setCellValueByColumnAndRow($args[1], $args[0] + 1, "", 1);
                if (is_array($args[2])) {
                    $cell->getStyle()->applyFromArray($args[2]);
                } else if ($args[2] instanceof NExcelFormat) {
                    $cell->getStyle()->applyFromArray($args[2]->getFormat());
                }
                break;

            case "setMerge": 
            case "mergeCells":
            $this->getActiveSheet()->mergeCellsByColumnAndRow($args[1], $args[0] + 1, $args[3], $args[2] + 1);
            break;
            case "insertBitmap":
            $size = getimagesize($args[2]);

            $scale = array("w" => !empty($args[5]) ? $args[5] : 1, "h" => !empty($args[6]) ? $args[6] : 1);
            $offset = array("x" => !empty($args[4]) ? $args[4] : 0, "y" => !empty($args[3]) ? $args[3] : 0);

            $img = new PHPExcel_Worksheet_Drawing();
            $img->setPath($args[2]);

            $img->setCoordinates(PHPExcel_Cell::stringFromColumnIndex($args[1]) . ($args[0] + 1));

            $img->setWidth($size[0] * $scale["w"])->setHeight($size[1] * $scale["h"]);

            $img->setOffsetX($offset["x"])->setOffsetY($offset["y"]);

            $img->setWorksheet($this->getActiveSheet());

            break;
            case "send":
            $filename = array_pad(explode(".", $args[0]),2,"xlsx");
            $filename[1] = "xlsx";
            $filename = implode(".", $filename);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
            $this->_isSent = true;
            break;
            case "close":
            if (!$this->_isSent) {
                $this->send($this->filename);
            }
            $xls = PHPExcel_IOFactory::createWriter($this, 'Excel2007');
            $xls->save('php://output');
            break;
            case "setColumn":
            for ($i = $args[0]; $i <= $args[1]; $i++) {
                $cell = $this->getActiveSheet()->getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($i));
                $cell->setAutoSize(is_string($args[2]) && $args[2] == "auto");
                if (floatval($args[2])) {
                    $cell->setWidth($args[2]);
                }
            }
            break;
            case "addWorksheet":
            if (!$this->newSheet) {
                $sheet = $this->getActiveSheet();
            } else {
                $sheet = $this->createSheet();
            }
            $sheet->setTitle($args[0]);
            $this->newSheet = 1;

            $this->setActiveSheetIndexByName($args[0]);
            break;
            case "addFormat":
                return  new NExcelFormat($args[0]);
            break;


        }
        return $this;
    }
    public function fixstr($value) {
        $response = stripslashes($value);
        $chars = array(
            "&iuml;&iquest;&frac12;" => "Ñ",
            "&Atilde;&lsquo;" => "Ñ",
            "&Atilde;&plusmn;" => "ñ",
            "&Ntilde;" => "Ñ",
            "&ntilde;" => "ñ",
            "&rsquo;" => "'",
            "&lsquo;" => "`",
            "&frac12;" => "½",
            );
        $response = (htmlentities($response, ENT_QUOTES, 'UTF-8'));
        foreach ($chars as $k => $c) {
            $response = str_replace($k, $c, $response);
        }
        $response = utf8_decode(html_entity_decode($response, ENT_QUOTES, 'ISO-8859-15'));
        return $response;
    }
}







?>