# AOZ_XML
Libreria XML

<div>
  <h3>La librería proporciona una serie de clases para la creación de documentos XML:</h3>

  <div>
    <ul>
      <li>
        AOZ_XMLAttribute: Un atributo de un elemento XML.
      </li>
      <li>
        AOZ_XMLElement: Clase abstracta de la que heredan de la que heredan las demás clases.
      </li>
      <li>
        AOZ_XMLTextElement: Elemento XML que sólo puede contener texto y atirbutos.
      </li>
      <li>
        AOZ_XMLSimpleElement: Elemento XML que sólo tiene atributos.
      </li>
      <li>
        AOZ_XMLComplexElement:Elemento complejo XML que puede contener otros elementos.
      </li>
      <li>
        AOZ_XMLComment: Comentario XML.
      </li>
      <li>
        AOZ_XMLDocument: Documento XML con un nodo principal del tipo AOZ_XMLComplexElement al que se le pueden añadir más nodos.
      </li>
    </ul>
  <div>
  <div>
    <p>
      En la carpeta clases se encuentran todas las clases por separada, sin embargo,
      para importar la librería basta con importar el fichero AOZ_XML.php que contiene
      todas las clases.
    </p>
  </div>
  <div>
    <h3>Ejemplo de Código:</h3>
    <div>
    <pre>
      &lt;?php

        $documento = new AOZ_XMLDocument( 'persona' );
        $documento->append( new AOZ_XMLTextElement( 'nombre', 'miNombre' ) );
        $documento->append( new AOZ_XMLTextElement( 'apellidos', 'misApellidos' ) );

        echo $documento;

       ?&gt;
      </pre>
    <div>
    <div>
      <h4>Resultado:</h4>
      <pre>
      &lt;?xml version="1.0" encoding="utf-8" ?&gt;
        &lt;persona&gt;
          &lt;nombre&gt;miNombre&lt;/nombre&gt;
          &lt;apellidos&gt;misApellidos&lt;/apellidos&gt;
        &lt;/persona&gt;
      </pre>
    </div>
  </div>
</div>
