<?php

class Form
{

  private static $instance = NULL;

  // get Singleton instance of Form class

  public static function getInstance()
  {
    if (self::$instance === NULL)
    {
      self::$instance = new self;
    }
    return self::$instance;

  }


  public static function build($form)
  {
    //print_r($form);
    $html = '';
    foreach($form as $element => $attributes)
    {
      $prefix = isset($attributes['#prefix']) ? $attributes['#prefix'] : '';
      $suffix = isset($attributes['#suffix']) ? $attributes['#suffix'] : '';
      switch($attributes['type'])
      {
        case "textarea":
          break;
        default:
          $html .= $prefix . '<input type="'.$attributes['type'].'" name="'.$attributes['name'].'" value="'.$attributes['value'].'" />' . $suffix;
          break;
      }
    }
    
    return $html;
  }


  // render <form> opening tag

  public static function open(array $attributes)
  {             
    $html = '<form';

    if (!empty($attributes))
      {
      foreach ($attributes as $attribute => $value)
      {
        if (in_array($attribute, array('action', 'method', 'id', 'class', 'enctype')) and !empty($value))
        {
          // assign default value to 'method' attribute
          if ($attribute === 'method' and ($value !== 'post' or $value !== 'get'))
          {
            $value = 'post';
          }
          $html .= ' ' . $attribute . '="' . $value . '"';
        }
      }
    }

    return $html . '>';

  }



  // render <input> tag

  public static function input(array $attributes)
  {             
    $html = '<input';

    if (!empty($attributes))
    {
      foreach ($attributes as $attribute => $value)
      {
        if (in_array($attribute, array('type', 'id', 'class', 'name', 'value')) and !empty($value))
        {
          $html .= ' ' . $attribute . '="' . $value . '"';
        }
      }
    }
    return $html . '>';

  }



  // render <textarea> tag

  public static function textarea(array $attributes)
  {             
    $html = '<textarea';
    $content = '';

    if (!empty($attributes))
    {
      foreach ($attributes as $attribute => $value)
      {
        if (in_array($attribute, array('rows', 'cols', 'id', 'class', 'name', 'value')) and !empty($value))
        {
          if ($attribute === 'value')
          {
            $content = $value;
            continue;
          }
          $html .= ' ' . $attribute . '="' . $value . '"';
        }
      }
    }
    return $html . '>' . $content . '</textarea>';

  }



  // render </form> closing tag

  public static function close()
  {
      return '</form>';
  }

}// End Form class


//Read more at http://www.devshed.com/c/a/PHP/Finishing-a-Form-Helper-Class-for-an-MVCbased-Framework-in-PHP-5/3/#SEYmZJmprYq3Yo00.99
