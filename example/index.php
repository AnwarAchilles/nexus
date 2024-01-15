<?php
# PHP Bundler version - 0.0.1
# Author: Anwar Achilles | hudorianwar07@gmail.com

new Appb7560d679d3be7a37e3e118345b7fd66386f1adec67599088dfd3843ec109174([
    
]);

class Appb7560d679d3be7a37e3e118345b7fd66386f1adec67599088dfd3843ec109174
{

    private $template = 'PD9waHAKIyBQSFAgQnVuZGxlciB2ZXJzaW9uIC0gMC4wLjEKIyBBdXRob3I6IEFud2FyIEFjaGlsbGVzIHwgaHVkb3JpYW53YXIwN0BnbWFpbC5jb20KQHt7IFBIUCB9fQovLyBBTEwgT0YgU09VUkNFIEFSRSBCVU5ETElORyA/Pgo8IURPQ1RZUEUgaHRtbD4KPGh0bWwgbGFuZz0iZW4iPgo8aGVhZD4KQHt7IEhUTUwtSEVBRCB9fQogICAgPHN0eWxlPgpAe3sgQ1NTIH19CiAgICA8L3N0eWxlPgo8L2hlYWQ+Cjxib2R5PgpAe3sgSFRNTC1CT0RZIH19CiAgICA8c2NyaXB0PgpAe3sgSlMgfX0KICAgIDwvc2NyaXB0Pgo8L2JvZHk+CjwvaHRtbD4=';

    /* 
     * MAIN CONSTRUCTOR
     * */
    public function __construct( $APPS )
    {
        $this->__installb7560d679d3be7a37e3e118345b7fd66386f1adec67599088dfd3843ec109174("PHP", $this->__bundle_phpb7560d679d3be7a37e3e118345b7fd66386f1adec67599088dfd3843ec109174() );
        $this->__installb7560d679d3be7a37e3e118345b7fd66386f1adec67599088dfd3843ec109174("CSS", $this->__bundle_cssb7560d679d3be7a37e3e118345b7fd66386f1adec67599088dfd3843ec109174() );
        $this->__installb7560d679d3be7a37e3e118345b7fd66386f1adec67599088dfd3843ec109174("JS", $this->__bundle_jsb7560d679d3be7a37e3e118345b7fd66386f1adec67599088dfd3843ec109174() );

        foreach ($this->__bundle_htmlb7560d679d3be7a37e3e118345b7fd66386f1adec67599088dfd3843ec109174() as $base => $bundle ) {
            $this->__installb7560d679d3be7a37e3e118345b7fd66386f1adec67599088dfd3843ec109174("HTML-".$base, $bundle );
        }

        eval("?>".$this->__cryptionb7560d679d3be7a37e3e118345b7fd66386f1adec67599088dfd3843ec109174($this->template, FALSE )."<?php");
    }

    /* 
     * BUNDLE CONTAINER PHP: PROCESSOR
     * */
    private function __bundle_phpb7560d679d3be7a37e3e118345b7fd66386f1adec67599088dfd3843ec109174()
    {
        $bundle = array();
		$bundle[] = 'DQoNCg0KJGRhdGEgPSAnTmV4dXMgUEhQJzs=';


        return $bundle;
    }

    /* 
     * BUNDLE CONTAINER HTML: HYPERTEXT
     * */
    private function __bundle_htmlb7560d679d3be7a37e3e118345b7fd66386f1adec67599088dfd3843ec109174()
    {
        $bundle = new StdClass();
        $bundle->head = array();


        $bundle->body = array();
		$bundle->body[] = 'DQo8aDE+U2FtcGxlIDw/PSRkYXRhPz48L2gxPg0K';


        return $bundle;
    }

    /* 
     * BUNDLE CONTAINER CSS: STYLESHEET
     * */
    private function __bundle_cssb7560d679d3be7a37e3e118345b7fd66386f1adec67599088dfd3843ec109174()
    {
        $bundle = array();
		$bundle[] = 'aDF7Y29sb3I6cmVkfWgxe2NvbG9yOnJlZH1oMXtjb2xvcjpyZWR9aDF7Y29sb3I6cmVkfWgxe2NvbG9yOnJlZH0=';


        return $bundle;
    }

    /* 
     * BUNDLE CONTAINER JS: JAVASCRIPT
     * */
    private function __bundle_jsb7560d679d3be7a37e3e118345b7fd66386f1adec67599088dfd3843ec109174()
    {
        $bundle = array();
		$bundle[] = 'ZG9jdW1lbnQucXVlcnlTZWxlY3RvcigiaDEiKS5pbm5lckhUTUw9Ik5leHVzIEpTIjtkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCJoMSIpLmlubmVySFRNTD0iTmV4dXMgSlMiO2RvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoImgxIikuaW5uZXJIVE1MPSJOZXh1cyBKUyI7ZG9jdW1lbnQucXVlcnlTZWxlY3RvcigiaDEiKS5pbm5lckhUTUw9Ik5leHVzIEpTIjtkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCJoMSIpLmlubmVySFRNTD0iTmV4dXMgSlMiOw==';

        
        return $bundle;
    }

    /* 
     * METHOD CRYPTION
     * */
    private function __cryptionb7560d679d3be7a37e3e118345b7fd66386f1adec67599088dfd3843ec109174( $data, $state )
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
    private function __installb7560d679d3be7a37e3e118345b7fd66386f1adec67599088dfd3843ec109174( $prefix, $bundle )
    {
        $packet=[];
        foreach ($bundle as $packet_encode) {
            $packet[] = $this->__cryptionb7560d679d3be7a37e3e118345b7fd66386f1adec67599088dfd3843ec109174($packet_encode, FALSE );
        }
        $source = implode("\n", $packet);
        $TEMPLATE = $this->__cryptionb7560d679d3be7a37e3e118345b7fd66386f1adec67599088dfd3843ec109174($this->template, FALSE );
        $TEMPLATE = str_replace("@{{ ".strtoupper($prefix)." }}", $source, $TEMPLATE);
        $this->template = $this->__cryptionb7560d679d3be7a37e3e118345b7fd66386f1adec67599088dfd3843ec109174($TEMPLATE, TRUE );
    }
}

?>