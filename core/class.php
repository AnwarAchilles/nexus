<?php
# PHP Bundler version - 0.0.1
# Author: Anwar Achilles | hudorianwar07@gmail.com

new App@{{ HASH-APP }}([
    
]);

class App@{{ HASH-APP }}
{

    private $template = '@{{ TEMPLATE }}';

    /* 
     * MAIN CONSTRUCTOR
     * */
    public function __construct( $APPS )
    {
        $this->__install@{{ HASH-CRYPTION }}("PHP", $this->__bundle_php@{{ HASH-PHP }}() );
        $this->__install@{{ HASH-CRYPTION }}("CSS", $this->__bundle_css@{{ HASH-CSS }}() );
        $this->__install@{{ HASH-CRYPTION }}("JS", $this->__bundle_js@{{ HASH-JS }}() );

        foreach ($this->__bundle_html@{{ HASH-HTML }}() as $base => $bundle ) {
            $this->__install@{{ HASH-CRYPTION }}("HTML-".$base, $bundle );
        }

        eval("?>".$this->__cryption@{{ HASH-CRYPTION }}($this->template, FALSE )."<?php");
    }

    /* 
     * BUNDLE CONTAINER PHP: PROCESSOR
     * */
    private function __bundle_php@{{ HASH-PHP }}()
    {
        $bundle = array();
@{{ PHP }}

        return $bundle;
    }

    /* 
     * BUNDLE CONTAINER HTML: HYPERTEXT
     * */
    private function __bundle_html@{{ HASH-HTML }}()
    {
        $bundle = new StdClass();
        $bundle->head = array();
@{{ HTML-HEAD }}

        $bundle->body = array();
@{{ HTML-BODY }}

        return $bundle;
    }

    /* 
     * BUNDLE CONTAINER CSS: STYLESHEET
     * */
    private function __bundle_css@{{ HASH-CSS }}()
    {
        $bundle = array();
@{{ CSS }}

        return $bundle;
    }

    /* 
     * BUNDLE CONTAINER JS: JAVASCRIPT
     * */
    private function __bundle_js@{{ HASH-JS }}()
    {
        $bundle = array();
@{{ JS }}
        
        return $bundle;
    }

    /* 
     * METHOD CRYPTION
     * */
    private function __cryption@{{ HASH-CRYPTION }}( $data, $state )
    {
        if ($state==TRUE) {
            return base64_encode($data);
        }else {
            return base64_decode($data);
        }
    }

    /* 
     * METHOD INSTALLER
     * */
    private function __install@{{ HASH-CRYPTION }}( $prefix, $bundle )
    {
        $packet=[];
        foreach ($bundle as $packet_encode) {
            $packet[] = $this->__cryption@{{ HASH-CRYPTION }}($packet_encode, FALSE );
        }
        $source = implode("\n", $packet);
        $TEMPLATE = $this->__cryption@{{ HASH-CRYPTION }}($this->template, FALSE );
        $TEMPLATE = str_replace("@{{ ".strtoupper($prefix)." }}", $source, $TEMPLATE);
        $this->template = $this->__cryption@{{ HASH-CRYPTION }}($TEMPLATE, TRUE );
    }
}

?>