<?php
	/**
	 * Comentario en XML.
	 */
	class AOZ_XMLComment {
		/**
		 * Cadena de texto del comentario en XML.
		 * @var string
		 */
		protected $value;

		/**
		 * Crea un comentario de XML con el valor pasado
		 * como parametro. Por defecto en caso de error
		 * es una cadena de texto vacia.
		 * @param string $v Valor del comentario.
		 */
		public function __construct ( $v )
		{
			$this->value = is_string( $v ) ? trim( $v ) : "";
		}

		/**
		 * Devuelve el valor del comentario XML.
		 * @return string Valor del comentario XML.
		 */
		public function getValue ()
		{
			return $this->value;
		}

		/**
		 * Permite establecer un nuevo valor para el
		 * comentario XML. Indica mediante un boolano
		 * si la asignacion es correcta.
		 * @param string $v Valor del nuevo comentario.
		 * @return boolean Retorna true si la asignacion en correcta
		 *                 y false en caso contrario.
		 */
		public function setValue ( $v )
		{
			$correcto = false;		# Indica si la asignacion es correcta.

			if ( is_string( $v ) ) {
				$correcto = true;
				$this->value = trim( $v );
			}

			return $correcto;
		}

		/**
		 * Retorna una representacion en forma de cadena del comentario
		 * XML.
		 * @return string Cadena de texto en representacion del comentario.
		 */
		public function __toString ()
		{
			return "<!-- ".$this->value." -->";
		}
	}