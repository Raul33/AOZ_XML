<?php
	class AOZ_XMLComplexElement extends AOZ_XMLElement {
		/**
		 * Array con los elementos que contiene.
		 * @var array
		 */
		protected $elements;

		/**
		 * Crea un elemento complejo XML capaz de contener
		 * otros elementos.
		 * @param string $name Nombre de la etiqueta. Si hay error de
		 *                     parámetro, se inicializa a 'aoz_xmlelement'.
		 */
		public function __construct ( $name )
		{
			parent::__construct( $name );

			$this->elements = Array();
		}

		/**
		 * Permite añadir un nuevo elemento XML.
		 * @param  AOZ_XMLElement $e Elemento XML que va a ser añadido.
		 */
		public function append ( AOZ_XMLElement $e )
		{
			$this->elements[] = clone $e;
		}

		/**
		 * Vacía el contenido del elemento.
		 */
		public function emptyAll ()
		{
			$this->elements = Array();
		}

		/**
		 * Añade un comentario XML a los elementos contenidos.
		 * @param  AOZ_XMLComment $c Comentario XML que va a ser añadido.
		 */
		public function appendComment ( AOZ_XMLComment $c )
		{
			$this->elements = clone $c;
		}

		/**
		 * Elimina el último elemento añadido si es posible.
		 * Indica mediante un booleano si se ha podido añadir.
		 * @return boolean Retorna true si es posible añadir el elemento
		 *                 y false en caso contrario.
		 */
		public function deleteLastElement ()
		{
			$correcto = false;		# Indica si se ha eliminado el elemento.

			if ( count( $this->elements ) ) {
				$correcto = true;
				unset( $this->elements[ count( $this->elements - 1 ) ] );
			}

			return $correcto;
		}

		/**
		 * Elimina el primer elemento.
		 * @return boolean Retorna true si es posible eliminarlo
		 *                 y false en caso contrario.
		 */
		public function deleteFirstElement ()
		{
			$correcto = false;		# Indica si se ha podido eliminarlo.

			if ( count( $this->elements ) ) {
				$correcto = true;
				unset( $this->elements[ 0 ] );
			}

			return $correcto;
		}

		/**
		 * Elimina el elemento del índice indicado si es posible.
		 * Indica mediante un booleano si ha sido posible eliminarlo.
		 * @param  integer $index Índice del elemento que se desea borrar.
		 * @return boolean        Retorna true si ha sido posible eliminarlo
		 *                        y false en caso contrario.
		 */
		public function deleteElement ( $index )
		{
			$correcto = false;		# Indica si es posible eliminar el elemento.

			if ( isset( $this->elements[ $index ] ) ) {
				$correcto = true;
				unset( $this->elements[ $index ] );
			}

			return $correcto;
		}

		/**
		 * Reemplaza el elemento del índice especificado por el elemento pasado
		 * como parámetro.
		 * @param  AOZ_XMLElement $e     Elemento XML para reemplazar.
		 * @param  integer         $index Índice del elemento que se desea
		 *                                eliminar.
		 * @return boolean                Retorna true si es posible reemplazar
		 *                                el elemento y false en caso contrario.
		 */
		public function replaceElement ( AOZ_XMLElement $e, $index )
		{
			$correcto = false;		# Indica si es posible el reemplazo.

			if ( isset( $this->elements[ $index ] ) ) {
				$correcto = true;
				$this->elements[ $index ] = clone $e;
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

			$xml_string .= ">";

			/* Elementos */
			foreach ($this->elements as $value) {
				$xml_string .= $value;
			}

			$xml_string .= "</".$this->name.">";

			return $xml_string;
		}
	}