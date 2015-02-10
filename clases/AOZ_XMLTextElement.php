<?php
	/**
	 * Clase que representa un elemento XML que solo
	 * puede contener texto.
	 */
	class AOZ_XMLTextElement extends AOZ_XMLElement {
		/**
		 * Valor del texto interno del elemento XML.
		 * @var mixed
		 */
		protected $value;

		/**
		 * Crea un elemento de XML con el nombre indicado y el
		 * texto indicado. Por defecto, en caso de que el nombre
		 * no sea una cadena de texto, se inicializa el nombre a
		 * 'aoz_xmlelement'.
		 * @param string $name  Nombre de la etiqueta.
		 * @param mixed $value Valor de la etiqueta. Puede ser un número,
		 *                     un booleano o una cadena de texto. Por defecto
		 *                     es una cadena vacía.
		 */
		public function __construct ( $name, $value = '' )
		{
			parent::__construct( $name );

			if ( is_string( $value ) || is_bool( $value ) || is_numeric( $value ) )
				$this->value = $value;
			else
				$this->value = '';
		}

		/**
		 * Devuelve el valor interno del elemento XML.
		 * @return mixed Valor del elemento XML, puede ser un número,
		 *               un booleano o una cadena de texto.
		 */
		public function getValue ()
		{
			return $this->value;
		}

		/**
		 * Permite establecer el valor de la etiqueta XML.
		 * Indica mediante un booleano si es posible establecer
		 * el nuevo valor.
		 * @param mixed $value Nuevo valor de la etiqueta. Puede ser un booleano
		 *                     un número o una cadena de texto.
		 * @return  boolean Retorna true si es posible establecer el valor y false
		 *                  en caso contrario.
		 */
		public function setValue ( $value )
		{
			$correcto = false;		# Indica si se ha podido establecer el nuevo valor.

			if ( is_string( $value ) || is_bool( $value ) || is_numeric( $value ) ) {
				$correcto = true;
				$this->value = $value;
			}

			return $correcto;
		}

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

			$xml_string .= ">".$this->value."</".$this->name.">";

			return $xml_string;
		}
	}