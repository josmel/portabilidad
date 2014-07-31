<?php

class Admin_Form_Cp extends Core_Form_Form
{
    public function init() {
        $obj = new Application_Model_DbTable_Cp();
        $primaryKey = $obj->getPrimaryKey();
        $objTypeOperador=new Admin_Model_Operadora();
        $this->setMethod('post');      
        $this->setEnctype('multipart/form-data');
        $this->setAttrib('idtCp',$primaryKey);
        $this->setAction('/cp/new');
        $e = new Zend_Form_Element_Hidden($primaryKey);                         
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Select('CodigoCedente');    
        $e->setMultiOptions($objTypeOperador->getPairsAll());
        $this->addElement($e); 
        
        $e = new Zend_Form_Element_Select('TipoDocumentoIdentidad');
        $e->setMultiOptions(array(
            '01'=>'DNI',
            '02'=> 'Tarjeta de Identificación de Residente Extranjero',
            '03'=> 'Certificado de Nacimiento',
            '04'=> 'Pasaporte',
            '05'=> 'Documento de identidad personal',
        ));
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Select('TipoPortabilidad');
        $e->setMultiOptions(array(
            '02'=> 'Pospago',
            '01'=> 'Prepago',
        ));
        $this->addElement($e);
        
         $e = new Zend_Form_Element_Text('NumeroDocumentoIdentidad');
        $this->addElement($e);
         $e = new Zend_Form_Element_Text('CantidadNumeraciones');
        $this->addElement($e);
         $e = new Zend_Form_Element_Text('NumeracionSolicitada');
        $this->addElement($e);
         $e = new Zend_Form_Element_Text('NombreContacto');
        $this->addElement($e);
         $e = new Zend_Form_Element_Text('EmailContacto');
        $this->addElement($e);
         $e = new Zend_Form_Element_Text('TelefonoContacto');
        $this->addElement($e);
         $e = new Zend_Form_Element_Text('FaxContacto');
        $this->addElement($e);
        $e = new Zend_Form_Element_Select('TipoServicio');
        $e->setMultiOptions(array(
            2 => 'Fijo',
            1 => 'Móvil',
        ));
        $this->addElement($e);
         $e = new Zend_Form_Element_Select('Cliente');
         $e->setMultiOptions(array(
            2 => 'No Especial',
            1 => 'Especial',
        ));
        $this->addElement($e);

        foreach($this->getElements() as $element) {
            $element->removeDecorator('Label');
            $element->removeDecorator('DtDdWrapper');          
            $element->removeDecorator('HtmlTag');
        }
    }
    
    public function populate(array $values) {
        if(isset($values['state'])) 
            $values['state'] = $values['state'] == 1 ? 1 : 0;
        
        parent::populate($values);
    }
}