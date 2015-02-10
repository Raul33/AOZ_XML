<?php
	/**
	 * Atributo de XML.
	 */
	class AOZ_XMLAttribute {
		/**
		 * Nombre de la propiedad.
		 * @var string
		 */
		protected $name;

		/**
		 * Valor de la propiedad.
		 * @var mixed
		 */
		protected $value;

		/**
		 * Crea la propiedad XML con el nombre y el valor pasados como
		 * parametro. En caso de error de parametro el nombre es 'data'
		 * y el valor es una cadena vacia.
		 * @param string $n Nombre del atributo, si se pasa un valor distinto a
		 *                  una cadena, el nombre por defecto es 'data'.
		 * @param mixed $v Valor de cadena, booleano o numerico del atributo.
		 *                 Por defecto es una cadena vacía.
		 */
		public function __construct ( $n, $v = "" )
		{
			$this->name = is_string( $n ) ? $n : "data";

			if ( is_string( $v ) || is_numeric( $v ) || is_bool( $v ) )
				$this->value = $v;
			else
				$this->value = "";
		}

		/**
		 * Devuelve el nombre de la propiedad XML.
		 * @return string Nombre de la propiedad XML.
		 */
		public function getName ()
		{
			return $this->name;
		}

		/**
		 * Devuelve el valor de la propiedad XML.
		 * @return mixed Numero, cadena o booleano.
		 */
		public function getValue ()
		{
			return $this->value;
		}

		/**
		 * Permite establecer un nuevo nombre al atributo XML.
		 * Indica mediante un booleano si la asignacion es correcta.
		 * @param string $n Nuevo nombre de la propiedad; debe ser un string.
		 * @return  booleano Retorna true si la asignacion es correcta
		 *                   y false en caso contrario.
		 */
		public function setName ( $n )
		{
			$correcto = false;	# Indica si la asignacion es correcta.

			if ( is_string( $n ) ) {
				$correcto = true;
				$this->name = $n;
			}

			return $correcto;
		}

		/**
		 * Permite establecer el valor de la propiedad XML, indicando
		 * mediante un booelano si ha sido posible la asignacion.
		 * @param mixed $v Nuevo valor del atributo; debe de ser un string,
		 *                 un booleano o un numero.
		 * @return boolean Retorna true si ha sido posible la asignacion
		 *                 y false en caso contrario.
		 */
		public function setValue ( $v )
		{
			$correcto = false;

			if ( is_string( $v ) || is_numeric( $v ) || is_bool( $v ) ) {
				$correcto = true;
				$this->value = $v;
			}

			return $correcto;		
		}

		/**
		 * Retorna la representacion del objeto en forma de cadena
		 * con el formato nombre="valor".
		 * @return string Representacion del objeto en forma de cadena.
		 */
		public function __toString ()
		{
			return $this->name."=\"".$this->value."\"";
		}
	}