<?php

  class Test extends Controller
  {
    function index()
    {
      $link = array(
        '' => 'home',
        'test/form' => 'Form Test',
        'test/xml' => 'RPC Test',
        'test/cache' => 'Cache Test',
        'test/menu' => 'Menu test',
      );
      $url = $this->load->helper('Url_helper');
      foreach($link as $path => $title){
        print "<li>".$url->l($path, $title)."</li>";
      }
    }
    
    function menu()
    {
      $menu = array(
        array(
          'title' => 'Home',
          'url' => '',
        ),
        array(
          'title' => 'Test Index',
          'url' => 'test',
          'children' => array(
            array(
              'title' => 'Test Form',
              'url' => 'test/form',
            ),
            array(
              'title' => 'Test Cache',
              'url' => 'test/cache',
            ),
            array(
              'title' => 'Test Menu',
              'url' => 'test/menu',
            ),
            array(
              'title' => 'Test xml',
              'url' => 'test/xml',
            ),
          ),
        ),
      );
      $m = $this->load->helper('Menu_helper');
      print $m->build($menu);
    }
    
    function form()
    {      
      $form = array(
        'method' => 'POST',
        'action' => 'test/post',
        '#form_id' => 'form_id',
        'name' => 'form_id',
        '#elements' => array(
          array(
            'type' => 'label',
            'for' => 'Location',
            'title' => 'Location:',
            '#prefix' => '<div class="Location">',
          ),
          array(
            'type'=> 'text', 
            'name' => 'Location', 
            'value' => '',
            '#attributes' => array(
              'class' => 'TextBox',
              'id' => 'Location',
              'title' => 'Enter a Location',
            ),
            '#suffix' => '</div>',
          ),
          array(
            'type' => 'hidden',
            'name' => 'numberOfItems',
            'value' => '1',
            '#attributes' => array(
              'id' => 'numberOfItems',
            ),
            '#prefix' => '<div class="hiddenItem">',
            '#suffix' => '</div>',
          ),
          array(
            'type' => 'label',
            'for' => 'SubmitForm',
            'title' => 'Search:',
          ),
          array(
            'type'=> 'submit', 
            'name' => 'submit', 
            'value' => 'submit',
            '#attributes' => array(
              'id' => 'SubmitForm',
            ),
            '#prefix' => '<div class="submit">',
            '#suffix' => '</div>',
          ),
          array(
            'type' => 'radio',
            'name' => 'radiobutton',
            'options' => array(
              'red',
              'blue',
              'green',
            ),
            'checked' => 'green',
            '#attributes' => array(
              'id' => 'color'
            ),
            '#prefix' => '<div class="colorSelect">',
            '#suffix' => '</div>',
          ),
          array(
            'type' => 'checkbox',
            'name' => 'colorSelectBox',
            'value' => 'red',
            'checked' => true,
            '#attributes' => array(
              'id' => 'colorBoxes'
            ),
            '#prefix' => '<div class="colorSelectBox">',
            '#suffix' => '</div>',
          ),
          array(
            'type' => 'checkbox',
            'name' => 'colorSelectBox2',
            'value' => 'blue',
            'checked' => false,
            '#attributes' => array(
              'id' => 'colorBoxes2'
            ),
            '#prefix' => '<div class="colorSelectBox2">',
            '#suffix' => '</div>',
          ),
          array(
            'type' => 'markup',
            'markup' => '<a id="addItem" href="#">Add Item</a> | <a id="removeItem" href="#">Remove item</a>',
          ),
        ),
      );
      $f = $this->load->helper('Form');
      print $f->build($form);
      $radio = array(
            'type' => 'radio',
            'name' => 'numberSelect',
            'options' => array(
              'seven',
              'eight',
              'nine',
            ),
            'checked' => 'eight',
            '#attributes' => array(
              'id' => 'number'
            ),
            '#prefix' => '<div class="numberSelect">',
            '#suffix' => '</div>',
          );
      print $f->radio($radio);
    }
    
    function cache()
    {
      $cache = $this->load->model('cache_model');
      $cache->set('bob', time());
      $bob = $cache->get('bob');
      print $bob->html;
    }
    
    public function xml()
    {
      $url = 'http://www.engadget.com/rss.xml';
      $http = $this->load->model('http_model');
      $utils = $this->load->helper('utility_helper');
      $xml = $http->request($url);
      $utils->debug($utils->xml_to_array($xml));
    }
   
 }

?>
