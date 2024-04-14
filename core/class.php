<?php
# Nexus version - 0.0.1
# Author: Anwar Achilles | hudorianwar07@gmail.com

if (defined('NEXUS')) {
	$GLOBALS['NEXUS_APP'] = 'Nexus_App_@{{ HASH-APP }}';
}else if (defined('NEXUS_PROTECT')) {
	$GLOBALS['NEXUS_APP'] = 'Nexus_App_@{{ HASH-APP }}';
	@{{ PROTECT-RUN }}
}else {
    new App@{{ HASH-APP }}( $NEXUS );
}

class App@{{ HASH-APP }}
{

    private $manifest = [];
    
    private $template = '@{{ TEMPLATE }}';

    /* 
     * MAIN CONSTRUCTOR
     * */
    public function __construct( $NEXUS )
    {
        $this->__manifest@{{ HASH-CRYPTION }}();
        
        $this->__install@{{ HASH-CRYPTION }}("PHP", $this->__bundle_php@{{ HASH-PHP }}() );
        $this->__install@{{ HASH-CRYPTION }}("CSS", $this->__bundle_css@{{ HASH-CSS }}() );
        $this->__install@{{ HASH-CRYPTION }}("JS", $this->__bundle_js@{{ HASH-JS }}() );

        foreach ($this->__bundle_html@{{ HASH-HTML }}() as $base => $bundle ) {
            $this->__install@{{ HASH-CRYPTION }}("HTML-".$base, $bundle );
        }

        $this->__asset@{{ HASH-CRYPTION }}();

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
     * BUNDLE CONTAINER ASSET: FILE MANAGER
     * */
    private function __bundle_asset@{{ HASH-ASSET }}()
    {
        $bundle = array();
@{{ ASSET }}
        
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

    /* 
     * METHOD ASSET DEPLOYER
     * */
    private function __asset@{{ HASH-CRYPTION }}()
    {
        foreach ($this->__bundle_asset@{{ HASH-ASSET }}() as $filename => $source ) {
            if (file_exists(__DIR__.'/asset/')) {
                if (file_exists(__DIR__.'/asset/'.$filename)) {
                    file_put_contents(__DIR__.'/asset/'.$filename, $this->__cryption@{{ HASH-CRYPTION }}($source, FALSE));
                }else {
                    touch(__DIR__.'/asset/'.$filename);
                    $this->__asset@{{ HASH-CRYPTION }}();
                }
            }else {
                mkdir(__DIR__.'/asset/');
                $this->__asset@{{ HASH-CRYPTION }}();
            }
        }
    }

    private function __manifest@{{ HASH-CRYPTION }}()
	{
		if (file_exists("nexus.json")) {
			self::$manifest = json_decode(file_get_contents("nexus.json"));
		}else {
			self::$manifest = [];
		}
	}
}

?>