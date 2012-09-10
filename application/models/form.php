<?php

class Form extends Model
{

  private function setAttributes($attributes = array())
  {
    
    $attr = array();
    
    if(!empty($attributes)){ 
      foreach($attributes as $key => $val){
        $attr[] = '"'.$key.'"="'.$val.'"';
      }
    }
    
    return implode(' ', $attr);
  }
  /*
   * if we use this, we can detect a session form build error, rebuild the form, and if ERROR = true
   * we can rebuild the form with the session data vars already filled in. also, we could highlight the error areas.
   */
  public function build($form)
  {

    $html = '';
    
    $html .= $this->open($form);
    $form['#elements'][] = array('type' => 'hidden', 'name' => 'form_id', 'value' => $form['#form_id']);
    foreach($form['#elements'] as $element => $attributes)
    {
      $prefix = isset($attributes['#prefix']) ? $attributes['#prefix'] : '';
      $suffix = isset($attributes['#suffix']) ? $attributes['#suffix'] : '';
      switch($attributes['type'])
      {
        case 'markup':
          $html .= $attributes['markup'];
          break;
        case "textarea":
          $html .= $prefix . $this->textarea($attributes) . $suffix;
          break; 
        case "label":
          $html .= $prefix . $this->label($attributes) . $suffix;
          break;
        case "select":
          $html .= $prefix . $this->select($attributes) . $suffix;
          break;
        case "input":
        case "hidden":
        default:
          $html .= $prefix . $this->input($attributes) . $suffix;
          break;
      }
    }
    $html .= $this->close();
    return $html;
  }
  
  private function input($attributes)
  {
    return '<input type="'.$attributes['type'].'" name="'.$attributes['name'].'" value="'.$attributes['value'].'" '.$this->setAttributes($attributes['#attributes']).' />';
  }
  
  private function textarea($attributes)
  {
    return '<'.$attributes['type'].' name="'.$attributes['name'].'" value="'.$attributes['value'].'" rows="'.$attributes['rows'].'" cols="'.$attributes['cols'].'" />';
  }
  
  private function label($attributes)
  {
    return '<' . $attributes['type'] . ' for="' . $attributes['for'] . '" >' . $attributes['title'] . '</label>';
  }
  
  private function select($attributes)
  {
    $html = '';
    
    $html = '<select name="' . $attributes['name'] . '" ' .$this->setAttributes($attributes['#attributes']) . '">';
    foreach($attributes['options'] as $option => $value){
      $html .= '<option value="'.$option.'">'.$value.'</option>';
    }
    $html .= '</select>';
    
    return $html;
  }


  // render <form> opening tag

  public function open($form)
  {             
    $html = '<form name="'.$form['name'].'" method="'.$form['method'].'" action="'.$form['action'].'" >';
    return $html;
  }


  // render </form> closing tag

  public static function close()
  {
      return '</form>';
  }

}// End Form class

