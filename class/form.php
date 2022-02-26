<?php 

class Form {

    public $data = null;

    public function __construct($data = array()){
        $this->data = $data;
    }  

    protected function surround($html){
        return "<div class=\"form-group\">{$html}</div>\n\t";
    }

    protected function getValue($index){
        return isset($this->data[$index]) ? $this->data[$index] : null;
    }

    public function input($name, $type, $label){
        return $this->surround('<label>'. $label .'</label><input type="' . $type . '" class="form-control" name="' . $name . '" value="' . $this->getValue($name) . '" required>');
    }

    public function select($name, $choices, $label){
        $options = ["\n\t\t<option disabled selected value> -- Choississez une option -- </option>"];
        foreach ($choices as $choice => $value) {
            array_push($options,'<option value="'. $choice ."\">". $value . '</option>');
        }
        return $this->surround(
            "\n\t<label>". $label ."</label><select name=\"". $name .'" class="form-control" autocomplete="off" required>' . implode("\n\t\t",$options) . "\n\t</select>\n\t"
        );
    }

    public function submit($name){
        return $this->surround('<button type="submit" class="btn btn-info" name="'. $name . '">Envoyer</button>');
    }

}
?>