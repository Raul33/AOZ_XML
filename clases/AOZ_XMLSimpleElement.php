<?php
	class AOZ_SimpleElement extends AOZ_XMLElement {
		/**
		 * Representación del elemento XML en forma de cadena.
		 * @return string Cadena de texto con la representacion del
		 *                elemento XML.
		 */
		public function __toString ()
		{
			$xml_string = "<".$this->name;

			/* Atributos */
			foreach ($this->attributes as $value) {
				$xml_string .= " ".$value;
			}

			$xml_string .= "/>";

			return $xml_string;
		}
	}