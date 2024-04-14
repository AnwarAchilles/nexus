<?php
# Nexus version - 0.0.1
# Author: Anwar Achilles | hudorianwar07@gmail.com

if (defined('NEXUS')) {
	$GLOBALS['NEXUS_APP'] = 'Nexus_App_03751f63ec4d0082960e169e1df0047e7dea020497065521c6f72a1d069516ed';
}else if (defined('NEXUS_PROTECT')) {
	$GLOBALS['NEXUS_APP'] = 'Nexus_App_03751f63ec4d0082960e169e1df0047e7dea020497065521c6f72a1d069516ed';
	
}else {
	if (file_exists("nexus.json")) {
		$NEXUS = json_decode(file_get_contents("nexus.json"));
	}else {
		$NEXUS = [];
	}
	Nexus_App_03751f63ec4d0082960e169e1df0047e7dea020497065521c6f72a1d069516ed::run( $NEXUS );
}

class Nexus_App_03751f63ec4d0082960e169e1df0047e7dea020497065521c6f72a1d069516ed {

	private static $manifest = [];

	private static $template = 'PD9waHAKIyBOZXh1cyB2ZXJzaW9uIC0gMC4wLjEKIyBBdXRob3I6IEFud2FyIEFjaGlsbGVzIHwgaHVkb3JpYW53YXIwN0BnbWFpbC5jb20KQHt7IFBIUCB9fQovLyBBTEwgT0YgU09VUkNFIEFSRSBCVU5ETElORyA/Pgo8IURPQ1RZUEUgaHRtbD4KPGh0bWwgbGFuZz0iZW4iPgo8aGVhZD4KQHt7IEhUTUwtSEVBRCB9fQogICAgPHN0eWxlPgpAe3sgQ1NTIH19CiAgICA8L3N0eWxlPgo8L2hlYWQ+Cjxib2R5PgpAe3sgSFRNTC1CT0RZIH19CiAgICA8c2NyaXB0PgpAe3sgSlMgfX0KICAgIDwvc2NyaXB0Pgo8L2JvZHk+CjwvaHRtbD4=';

	/* 
     * MAIN CONSTRUCTOR
     * */
	public static function run( $NEXUS ) 
	{
		self::$manifest = $NEXUS;

		self::install_03751f63ec4d0082960e169e1df0047e7dea020497065521c6f72a1d069516ed("PHP", self::php_03751f63ec4d0082960e169e1df0047e7dea020497065521c6f72a1d069516ed() );
		self::install_03751f63ec4d0082960e169e1df0047e7dea020497065521c6f72a1d069516ed("CSS", self::css_03751f63ec4d0082960e169e1df0047e7dea020497065521c6f72a1d069516ed() );
		self::install_03751f63ec4d0082960e169e1df0047e7dea020497065521c6f72a1d069516ed("JS", self::js_03751f63ec4d0082960e169e1df0047e7dea020497065521c6f72a1d069516ed() );

		foreach (self::html_03751f63ec4d0082960e169e1df0047e7dea020497065521c6f72a1d069516ed() as $base => $bundle ) {
			self::install_03751f63ec4d0082960e169e1df0047e7dea020497065521c6f72a1d069516ed("HTML-".$base, $bundle );
		}

		self::install_asset_03751f63ec4d0082960e169e1df0047e7dea020497065521c6f72a1d069516ed();

		eval("?>".self::cryption_03751f63ec4d0082960e169e1df0047e7dea020497065521c6f72a1d069516ed(self::$template, FALSE )."<?php");
	}

	/* 
	 * BUNDLE CONTAINER PHP: PROCESSOR
	 * */
	private static function php_03751f63ec4d0082960e169e1df0047e7dea020497065521c6f72a1d069516ed()
	{
		$bundle = array();
		$bundle[] = 'DQoNCiRkYXRhID0gJ05leHVzIFBIUCc7';


		return $bundle;
	}

	/* 
	 * BUNDLE CONTAINER HTML: HYPERTEXT
	 * */
	private static function html_03751f63ec4d0082960e169e1df0047e7dea020497065521c6f72a1d069516ed()
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
	private static function css_03751f63ec4d0082960e169e1df0047e7dea020497065521c6f72a1d069516ed()
	{
		$bundle = array();
		$bundle[] = 'aDF7Y29sb3I6cmVkfWgxe2NvbG9yOnJlZH1oMXtjb2xvcjpyZWR9aDF7Y29sb3I6cmVkfWgxe2NvbG9yOnJlZH0=';


		return $bundle;
	}

	/* 
	 * BUNDLE CONTAINER JS: JAVASCRIPT
	 * */
	private static function js_03751f63ec4d0082960e169e1df0047e7dea020497065521c6f72a1d069516ed()
	{
		$bundle = array();
		$bundle[] = 'ZG9jdW1lbnQucXVlcnlTZWxlY3RvcigiaDEiKS5pbm5lckhUTUw9Ik5leHVzIEpTIjtkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCJoMSIpLmlubmVySFRNTD0iTmV4dXMgSlMiO2RvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoImgxIikuaW5uZXJIVE1MPSJOZXh1cyBKUyI7ZG9jdW1lbnQucXVlcnlTZWxlY3RvcigiaDEiKS5pbm5lckhUTUw9Ik5leHVzIEpTIjtkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCJoMSIpLmlubmVySFRNTD0iTmV4dXMgSlMiOw==';

		
		return $bundle;
	}

	/* 
	 * BUNDLE CONTAINER ASSET: FILE MANAGER
	 * */
	private static function asset_03751f63ec4d0082960e169e1df0047e7dea020497065521c6f72a1d069516ed()
	{
		$bundle = array();

		
		return $bundle;
	}

	/* 
	 * METHOD CRYPTION
	 * */
	private static function cryption_03751f63ec4d0082960e169e1df0047e7dea020497065521c6f72a1d069516ed( $data, $state )
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
	private static function install_03751f63ec4d0082960e169e1df0047e7dea020497065521c6f72a1d069516ed( $prefix, $bundle )
	{
		$packet=[];
		foreach ($bundle as $packet_encode) {
			$packet[] = self::cryption_03751f63ec4d0082960e169e1df0047e7dea020497065521c6f72a1d069516ed($packet_encode, FALSE );
		}
		$source = implode("\n", $packet);
		$TEMPLATE = self::cryption_03751f63ec4d0082960e169e1df0047e7dea020497065521c6f72a1d069516ed(self::$template, FALSE );
		$TEMPLATE = str_replace("@{{ ".strtoupper($prefix)." }}", $source, $TEMPLATE);
		self::$template = self::cryption_03751f63ec4d0082960e169e1df0047e7dea020497065521c6f72a1d069516ed($TEMPLATE, TRUE );
	}

	/* 
	 * METHOD ASSET DEPLOYER
	 * */
	private static function install_asset_03751f63ec4d0082960e169e1df0047e7dea020497065521c6f72a1d069516ed()
	{
		foreach (self::asset_03751f63ec4d0082960e169e1df0047e7dea020497065521c6f72a1d069516ed() as $filename => $source ) {
			if (file_exists(__DIR__.'/asset/')) {
				if (file_exists(__DIR__.'/asset/'.$filename)) {
					file_put_contents(__DIR__.'/asset/'.$filename, self::cryption_03751f63ec4d0082960e169e1df0047e7dea020497065521c6f72a1d069516ed($source, FALSE));
				}else {
					touch(__DIR__.'/asset/'.$filename);
					self::install_asset_03751f63ec4d0082960e169e1df0047e7dea020497065521c6f72a1d069516ed();
				}
			}else {
				mkdir(__DIR__.'/asset/');
				self::install_asset_03751f63ec4d0082960e169e1df0047e7dea020497065521c6f72a1d069516ed();
			}
		}
	}

}