<?php
/*
 * Form class
 *
 * A form helper. Will render a full form, or basic form elements. Beta-ish. I wouldn't use this.
 *
 * @author Bryan Trudel https://github.com/thezombieguy
 */
class Form
{

  public function setAttributes($attributes = array())
  {
    
    $attr = array();
    
    if(!empty($attributes)){ 
      foreach($attributes as $key => $val){
        $attr[] = '"'.$key.'"="'.$val.'"';
      }
    }
    
    return implode(' ', $attr);
  }
  
  public function formSource()
  {
    $url = '';
    // Get request url and script url
	  $request_url = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '';
	  $script_url  = (isset($_SERVER['PHP_SELF'])) ? $_SERVER['PHP_SELF'] : '';
      	
	  // Get our url path and trim the / of the left and the right
	  if($request_url != $script_url) $url = trim(preg_replace('/'. str_replace('/', '\/', str_replace('index.php', '', $script_url)) .'/', '', $request_url, 1), '/');
	  
	  return $url;
  }

  /*
   *
    array(
      'method' => 'POST', //form method
      'action' => 'test/post', //action
      '#form_id' => 'form_id', //unique form id
      'name' => 'form_id', //name of form. 
      '#source' => 'test', //where the form originates
      '#elements' => array() //array of elements for each field
    );
  
  #elements is an erray of elements for each form field for the form.
  */
  public function build($form)
  {

    $html = '';
    
    if(empty($form['#source'])){
      $form['#source'] = $this->formSource();//this is for redirecting back to a form after a failed validation. needs work.
    }
    
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
        case "radio":
          $html .= $prefix . $this->radio($attributes) . $suffix;
          break;
        case "checkbox":
          $html .= $prefix . $this->checkbox($attributes) . $suffix;
          break;
        case "text":
        case "hidden":
        default:
          $html .= $prefix . $this->input($attributes) . $suffix;
          break;
      }
    }
    $html .= $this->close();
    return $html;
  }
  /*
    array(
      'type'=> 'text', //type of field  text/hidden
      'name' => 'Location', //name
      'value' => '', //value for default value.
    )
  */
  public function input($attributes)
  {
    $att = (!empty($attributes['#attributes'])) ? $this->setAttributes($attributes['#attributes']) : '';
    return '<input type="'.$attributes['type'].'" name="'.$attributes['name'].'" value="'.$attributes['value'].'" '.$att.' />';
  }
  
  public function textarea($attributes)
  {
    $att = (!empty($attributes['#attributes'])) ? $this->setAttributes($attributes['#attributes']) : '';
    return '<textarea name="'.$attributes['name'].'" value="'.$attributes['value'].'" rows="'.$attributes['rows'].'" cols="'.$attributes['cols'].'" '.$att.'/>';
  }
  /*
    array(
      'type' => 'label', //type for label
      'for' => 'Location', //for what field
      'title' => 'Location:', //title value
    ),
  */
  public function label($attributes)
  {
    $att = (!empty($attributes['#attributes'])) ? $this->setAttributes($attributes['#attributes']) : '';
    return '<label for="' . $attributes['for'] . '" '.$att.'>' . $attributes['title'] . '</label>';
  }
  
  public function select($attributes)
  {
    $html = '';
    $att = (!empty($attributes['#attributes'])) ? $this->setAttributes($attributes['#attributes']) : '';
    $html = '<select name="' . $attributes['name'] . '" ' .$att . '">';
    foreach($attributes['options'] as $value => $option){
      $html .= '<option value="'.$value.'">'.$option.'</option>';
    }
    $html .= '</select>';
    
    return $html;
  }
  
  public function radio($attributes)
  {
    $html = '';
    $att = (!empty($attributes['#attributes'])) ? $this->setAttributes($attributes['#attributes']) : '';
    foreach($attributes['options'] as $value){
      $checked = ($value == $attributes['checked']) ? 'checked' : '' ;
      $html .= '<input type="radio" name="'.$attributes['name'].'" value="'.$value.'" '.$att.' '.$checked.'/>'.$value;
    }
    
    return $html;
    
  }
  
  public function checkbox($attributes)
  {
    $att = (!empty($attributes['#attributes'])) ? $this->setAttributes($attributes['#attributes']) : '';
    $checked = (!empty($attributes['checked'])) ? 'checked' : '' ;
    return '<input type="'.$attributes['type'].'" name="'.$attributes['name'].'" value="'.$attributes['value'].'" '.$checked .' '.$att.' />'.$attributes['value']; 
  }

  public function open($form)
  {             
    $html = '<form name="'.$form['name'].'" method="'.$form['method'].'" action="'.$form['action'].'" >';
    $html.= $this->input(array('type' => 'hidden', 'name' => 'source', 'value' => $form['#source']));
    return $html;
  }

  public static function close()
  {
      return '</form>';
  }

}// End Form class

