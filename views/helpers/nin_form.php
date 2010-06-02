<?php
/**
 * NIN Form helper.
 *
 * Biblioteca extendida do Form Helper para auxiliar construção de formulários.
 *
 * @package       NIN
 * @subpackage    cake.scpg.view.helpers
 */
class NinFormHelper extends FormHelper {

/**
 * Outros Helpers utilizados
 *
 * @var array
 * @access public
 */
	//var $helpers = array('Html', 'Javascript', 'Form');

	/**
	 * Criação de campos lado a lado
	 *
	 * @access public
	 * @param array $fields Array contendo os fields e seus options
	 * @author Kataoka <kataoka@gmail.com>
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
	 * @author FelipeVR <felipevr@gmail.com>
	 */
	function buttonM($buttons = null) {
	    $ret = "";
	    if ($buttons) {
		$buttons_content = "";
		foreach ($buttons as $button) {
		    if (!$button['options']) { $button['options'] = array(); }
		    $buttons_content .= $this->button($button['title'], $button['options']) . ' &nbsp; ';
		}
		$ret = $this->Html->div("submit", $buttons_content);
	    }
	    return $ret;
	}

}
?>