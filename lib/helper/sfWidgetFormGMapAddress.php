<?php 
class sfWidgetFormGMapAddress extends sfWidgetForm 
{
  public function configure($options = array(), $attributes = array()) 
  {  
    $this->addOption('address.options', array('style'=>'width:512px'));

    $this->setOption('default', array(
            'address' => $attributes['address'] ? strip_tags($attributes['address']) : 'ulaanbaatar',
            'latitude' => $attributes['lat'] ? $attributes['lat'] : '47.916793494995744',
            'longitude' => $attributes['lng'] ? $attributes['lng'] : '106.91794193121336'
    ));
    
    $this->addOption('div.class', 'sf-gmap-widget');
    $this->addOption('map.height', '400px');
    $this->addOption('map.width', '800px');
    $this->addOption('map.style', "");
    $this->addOption('lookup.name', "Lookup");

    $this->addOption('template.html', '
      <div id="{div.id}" class="{div.class}">
        {input.search} <input type="submit" value="{input.lookup.name}"  id="{input.lookup.id}" /> <br />
        {input.longitude}
        {input.latitude}
        <div id="{map.id}" style="width:{map.width};height:{map.height};{map.style}"></div>
      </div>
    ');
  }

  public function getJavascripts() {
    return array(
            'http://maps.google.com/maps/api/js?sensor=true',
            'sf.widget.gmap.address.js');
  }

  public function render($name, $value = null, $attributes = array(), $errors = array()) {
    // define main template variables
    $template_vars = array(
            '{div.id}'             => $this->generateId($name),
            '{div.class}'          => $this->getOption('div.class'),
            '{map.id}'             => $this->generateId($name.'[map]'),
            '{map.style}'          => $this->getOption('map.style'),
            '{map.height}'         => $this->getOption('map.height'),
            '{map.width}'          => $this->getOption('map.width'),
            '{input.lookup.id}'    => $this->generateId($name.'[lookup]'),
            '{input.lookup.name}'  => $this->getOption('lookup.name'),
            '{input.address.id}'   => $this->generateId($name.'[address]'),
            '{input.latitude.id}'  => $this->generateId($name.'[latitude]'),
            '{input.longitude.id}' => $this->generateId($name.'[longitude]'),
    );

    // define the address widget
    $address = new sfWidgetFormInputText(array(), $this->getOption('address.options'));
    $template_vars['{input.search}'] = $address->render($name.'[address]', $value['address']);

    // define the longitude and latitude fields
    $hidden = new sfWidgetFormInputHidden;
    $template_vars['{input.longitude}'] = $hidden->render($name.'[longitude]', $value['longitude']);
    $template_vars['{input.latitude}']  = $hidden->render($name.'[latitude]', $value['latitude']);

    // merge templates and variables
    return strtr(
            $this->getOption('template.html').$this->getOption('template.javascript'),
            $template_vars
    );
  }

}