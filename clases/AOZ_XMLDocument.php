<?php
	class AOZ_XMLDocument {
		/**
		 * Cabecera de un documento XML.
		 */
		const XML_HEADER = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>";

		/**
		 * Nodo principal del documento XML.
		 * @var AOZ_XMLComplexElement
		 */
		protected $main_node;

		/**
		 * Crea un documento XML a partir del nodo pasado como parametro.
		 * @param AOZ_XMLComplexElement|null $e Nodo principal. Si es null,
		 *                                      se crea un nodo con nombre
		 *                                      'aoz'.
		 */
		public function __construct ( AOZ_XMLComplexElement $e = null )
		{
			if ( is_null( $e ) )
				$this->main_node = new AOZ_XMLComplexElement( 'aoz' );
			else
				$this->main_node = clone $e;
		}

		/**
		 * Devuelve el nombre del elemento principal XML.
		 * @return string Nombre del elemento principal XML.
		 */
		public function getName ()
		{
			return $this->main_node->getName();
		}

		/**
		 * Permite establecer el valor del nombre del elemento principal XML.
		 * Indica mediante un booleano si la asignación es correcta.
		 * @param string $n Nuevo nombre del elemento.
		 * @return boolean Retorna true si la asignación es correcta y
		 *                 false en caso contrario.
		 */
		public function setName ( $n )
		{
			return $this->main_node->setName( $n );
		}

		/**
		 * Permite añadir un atributo al elemento principal.
		 * @param Attribute $a Nuevo atributo que se va a añadir.
		 */
		public function addAttribute ( AOZ_XMLAttribute $a )
		{
			$this->main_node->addAttribute( $a );
		}

		/**
		 * Vacia los atributos del elemento principal.
		 */
		public function emptyAttributes ()
		{
			$this->main_node->emptyAttributes();
		}

		/**
		 * Si es posible, elimina el último atributo añadido al elemento
		 * principal.
		 * @return boolean Retorna true si se ha podido eliminar
		 *                 y false en caso contrario.
		 */
		public function deleteLastAttribute ()
		{
			return $this->main_node->deleteLastAttribute();
		}

		/**
		 * Elimina el primer atributo del elemento principal si es posible.
		 * @return boolean Retorna true si se ha podido eliminar
		 *                 y false en caso contrario.
		 */
		public function deleteFirstAttribute ()
		{
			return $this->main_node->deleteFirstAttribute();
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
			return $this->main_node->deleteAttribute( $index );
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
			return $this->main_node->replaceAttribute( $a, $index );
		}

		/**
		 * Indica el número de atributos que posee el elemento principal.
		 * @return integer Número de atributos del elemento.
		 */
		public function countAttributes ()
		{
			return $this->main_node->countAttributes();
		}

		/**
		 * Permite añadir un nuevo elemento XML al nodo principal.
		 * @param  AOZ_XMLElement $e Elemento XML que va a ser añadido.
		 */
		public function append ( AOZ_XMLElement $e )
		{
			$this->main_node->append( $e );
		}

		/**
		 * Vacía el contenido del elemento principal.
		 */
		public function emptyAll ()
		{
			$this->main_node->emptyAll();
		}

		/**
		 * Añade un comentario XML a al elemento principal.
		 * @param  AOZ_XMLComment $c Comentario XML que va a ser añadido.
		 */
		public function appendComment ( AOZ_XMLComment $c )
		{
			$this->main_node->appendComment( $c );
		}

		/**
		 * Elimina el último del nodo principal añadido si es posible.
		 * Indica mediante un booleano si se ha podido añadir.
		 * @return boolean Retorna true si es posible añadir el elemento
		 *                 y false en caso contrario.
		 */
		public function deleteLastElement ()
		{
			return $this->main_node->deleteLastElement();
		}

		/**
		 * Elimina el primer elemento del nodo principal.
		 * @return boolean Retorna true si es posible eliminarlo
		 *                 y false en caso contrario.
		 */
		public function deleteFirstElement ()
		{
			return $this->main_node->deleteFirstElement();
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
			return $this->main_node->deleteElement( $index );
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
			return $this->main_node->replaceElement( $e, $index );
		}

		/**
		 * Representación del elemento XML en forma de cadena.
		 * @return string Cadena de texto con la representacion del
		 *                elemento XML.
		 */
		public function __toString ()
		{
			return self::XML_HEADER."\n".$this->main_node;
		}
	}