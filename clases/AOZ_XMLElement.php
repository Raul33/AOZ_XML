<?php
	/**
	 * Clase que representa un atributo XML y de la que
	 * heredan los elementos más concretos de XML.
	 */
	abstract class AOZ_XMLElement {
		/**
		 * Nombre del elemento XML.
		 * @var string
		 */
		protected $name;

		/**
		 * Array de atributos XML del elemento.
		 * @var array
		 */
		protected $attributes;

		/**
		 * Crea el elemento XML con el nombre indicado. El nombre
		 * debe de ser una cadena, en caso contrario, su nombre será
		 * 'aoz_xmlelement'. Además, se eliminarán espacios en blanco
		 * del nombre indicado.
		 * @param string $n Nombre del elemento.
		 */
		public function __construct ( $n )
		{
			/* Nombre */
			if ( is_string( $n ) )
				$this->name = str_replace( ' ' , '', $n );
			else
				$this->name = 'aoz_xmlelement';

			/* Atributos */
			$this->attributes = Array();
		}

		/**
		 * Devuelve el nombre del elemento XML.
		 * @return string Nombre del elemento XML.
		 */
		public function getName ()
		{
			return $this->name;
		}

		/**
		 * Permite establecer el valor del nombre del elemento XML.
		 * Indica mediante un booleano si la asignación es correcta.
		 * @param string $n Nuevo nombre del elemento.
		 * @return boolean Retorna true si la asignación es correcta y
		 *                 false en caso contrario.
		 */
		public function setName ( $n )
		{
			$correcto = false;		# Indica si la asignación ha sido correcta.

			if ( is_string( $n ) ) {
				$correcto = true;
				$this->name = str_replace( ' ', '', $n );
			}

			return $correcto;
		}

		/**
		 * Permite añadir un atributo al elemento.
		 * @param Attribute $a Nuevo atributo que se va a añadir.
		 */
		public function addAttribute ( AOZ_XMLAttribute $a )
		{
			$this->attributes[] = clone $a;
		}

		/**
		 * Vacia los atributos del elemento.
		 */
		public function emptyAttributes ()
		{
			$this->attributes = Array();
		}

		/**
		 * Si es posible, elimina el último atributo añadido.
		 * @return boolean Retorna true si se ha podido eliminar
		 *                 y false en caso contrario.
		 */
		public function deleteLastAttribute ()
		{
			$correcto = false;		# Indica si se ha podido eliminar.

			if ( count( $this->attributes ) ) {
				$correcto = true;
				unset( $this->attributes[ count( $this->attributes ) - 1 ] );
			}

			return $correcto;
		}

		/**
		 * Elimina el primer atributo si es posible.
		 * @return boolean Retorna true si se ha podido eliminar
		 *                 y false en caso contrario.
		 */
		public function deleteFirstAttribute ()
		{
			$correcto = false;		# Indica si se ha podido eliminar.

			if ( count( $this->attributes ) ) {
				$correcto = true;
				unset( $this->attributes[ 0 ] );
			}

			return $correcto;
		}

		/**
		 * Permite eliminar el atributo con el índice especificado
		 * si es posible.
		 * @param  integer $index Índice del atributo a eliminar.
		 * @return boolean        Retorna true si se ha eliminado y false
		 *                        en caso contrario.
		 */
		public function deleteAttribute ( $index )
		{
			$correcto = false;

			if ( isset( $this->attributes[ $index ] ) ) {
				$correcto = true;
				unset( $this->attributes[ $index ] );
			}

			return $correcto;
		}

		/**
		 * Reemplaza el atributo del índice pasado como parámetro
		 * por el nuevo atributo indicado.
		 * @param  Attribute $a     Nuevo atributo con el que se reemplaza.
		 * @param  integer    $index Índice del atributo que se va a ser reemplado.
		 * @return boolean           Retorna true si se ha podido reemplazar y false
		 *                           en caso contrario.
		 */
		public function replaceAttribute ( AOZ_XMLAttribute $a, $index )
		{
			$correcto = false;		# Indica si se ha podido reemplazar.

			if ( isset( $this->attributes[ $index ] ) ) {
				$correcto = true;
				$this->attributes[ $index ] = clone $a;
			}

			return $correcto;
		}

		/**
		 * Indica el número de atributos que posee el elemento.
		 * @return integer Número de atributos del elemento.
		 */
		public function countAttributes ()
		{
			return count( $this->attributes );
		}

		/**
		 * Representación del elemento XML en forma de cadena.
		 * @return string Cadena de texto con la representacion del
		 *                elemento XML.
		 */
		public abstract function __toString();
	}
