<?php

  class Test extends Controller
  {
    function index()
    {
      $template = $this->load->view('main_view');
      $menu = $this->load->helper('Menu_helper');
      $items = $menu->load('test_menu');
      $template->set('nav', $menu->build($items));
      $template->set('content', 'Test suite. Use menus to navigate');
		  $template->render();
    }
    
    function menu()
    {
      $template = $this->load->view('main_view');
      $menu = $this->load->helper('Menu_helper');
      $items = $menu->load('test_menu');
      $mitems = $menu->load('main_menu');
      print_r($menu->build($mitems));
      $template->set('nav', $menu->build($items));
      $template->set('content', 'Menu Test');
		  $template->render();
    }
    
    function form()
    {      
      $template = $this->load->view('main_view');
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
      $form = $f->build($form);
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
      $radioform = $f->radio($radio);
      
      $menu = $this->load->helper('Menu_helper');
      $items = $menu->load('test_menu');
      $template->set('nav', $menu->build($items));
      $template->set('content', 'Form Test<br />'.$form.$radioform);
		  $template->render();
    }
    
    function cache()
    {
      $cache = $this->load->model('cache_model');
      $cache->set('bob', time());
      $bob = $cache->get('bob');
      $template = $this->load->view('main_view');
      
      $menu = $this->load->helper('Menu_helper');
      $items = $menu->load('test_menu');
      $template->set('nav', $menu->build($items));
      $template->set('content', 'Cache Test<br />'.$bob->html);
		  $template->render();
    }
    
    public function xml()
    {
      $url = 'http://www.engadget.com/rss.xml';
      $http = $this->load->model('http_model');
      $utils = $this->load->helper('utility_helper');
      $xml = $http->request($url);
            
      $template = $this->load->view('main_view');

      $menu = $this->load->helper('Menu_helper');
      $items = $menu->load('test_menu');
      $template->set('nav', $menu->build($items));
      $template->set('content', 'xml Test<br />'.print_rr($utils->xml_to_array($xml)));
		  $template->render();
    
    }
    
    public function cron()
    {
	    $cache = $this->load->model('Cache_model');
	    $cache->set('cron_main', 'testing cron from test class' . time());
    }
    

   
 }

?>
