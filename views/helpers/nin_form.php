<?php
/**
 * NIN Form helper.
 *
 * Biblioteca extendida do Form Helper para auxiliar construção de formulários.
 *
 * @package     NIN
 * @subpackage  cake.app.view.helpers
 * @author	FelipeVR <github@felipevr.eti.br>
 *		Kataoka <kataoka@gmail.com>
 * @license	http://www.opensource.org/licenses/gpl-3.0.html GPLv3
 */
class NinFormHelper extends FormHelper {

/**
 * Outros Helpers utilizados
 *
 * @var array
 * @access public
 */
	var $helpers = array('Html', 'Javascript');

    

	function beforeRender() {
	   if ( ClassRegistry::getObject('view') ) {
		$this->Javascript->link('jquery', false);
		//$this->Javascript->link('jquery.form', false);
	   }
	}

	/**
	 * Criação de campos lado a lado
	 *
	 * @access public
	 * @param array $fields Array contendo os fields e seus options
	 * @author Kataoka
	 * @return string Tags dos campos formatadas.
	 */
	function inputM($fields = array(), $submit = '') {
		$ret = "";
		foreach($fields as $field => $options) {
			if (!isset($options['width'])) $options['width'] = '80%';
			$style = "padding:0px;width:{$options['width']};float:left;margin:0px;";
			$op = $options;
			unset($op['width']);
			$ret .= $this->Html->div("", parent::input($field, $op), array('style' => $style));
		}
		if (!empty($submit)) {
		    $ret .= $this->Html->div("", parent::submit($submit), array('style' => 'padding:0px;float:left;margin:0px;'));
		}
		return $ret . $this->Html->div("", "", array('style' => 'clear:both;')); //"<div style='clear:both;'></div>";
	}

	/**
	 * Exibe multiplos botões no formulário
	 * @param Array $buttons
	 * @return string Tags contendo os códigos HTML dos botões
	 * @author FelipeVR
	 */
	function buttonM($buttons = null) {
	    $ret = "";
	    if ($buttons) {
		$buttons_content = "";
		foreach ($buttons as $button) {
		    if (!$button['options']) $button['options'] = array();
		    if(isset($button['options']['action'])) {
			$button['options']['type'] = 'submit';
			if($button['options']['type'] == 'redirect') {
			    $button['options']['onclick'] = "location.href='{$button['options']['action']}'";
			    unset($button['options']['action']);
			} else {
			    $button['options']['action'] = h(Router::url($button['options']['action'], false));
			    //TODO check if jquery is linked
			    $button['options']['onclick'] = "$('form').attr('action', $(this).attr('action'));";
			}
		    }
		    $buttons_content .= $this->button($button['title'], $button['options']) . ' &nbsp; ';
		}
		$ret = $this->Html->div("submit", $buttons_content);
	    }
	    return $ret;
	}

}
?>