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

	/**
	 * Clase que representa un elemento XML que solo tiene
	 * atributos.
	 */
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

	/**
	 * Clase que representa un elemento de XML capaz de conetener
	 * otros elementos.
	 */
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

	/**
	 * Clase que representa un documento XML.
	 */
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