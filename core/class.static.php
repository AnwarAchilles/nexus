<?php
# Nexus version - 0.0.1
# Author: Anwar Achilles | hudorianwar07@gmail.com

if (defined('NEXUS')) {
	$GLOBALS['NEXUS_APP'] = 'Nexus_App_@{{ HASH-APP }}';
}else if (defined('NEXUS_PROTECT')) {
	$GLOBALS['NEXUS_APP'] = 'Nexus_App_@{{ HASH-APP }}';
	@{{ PROTECT-RUN }}
}else {
	Nexus_App_@{{ HASH-APP }}::run();
}

class Nexus_App_@{{ HASH-APP }}
{

	private static $manifest = [];

	private static $template = '@{{ TEMPLATE }}';

	/* 
     * MAIN CONSTRUCTOR
     * */
	public static function run() 
	{
		self::manifest_@{{ HASH-CRYPTION }}();

		self::install_@{{ HASH-CRYPTION }}("PHP", self::php_@{{ HASH-PHP }}() );
		self::install_@{{ HASH-CRYPTION }}("CSS", self::css_@{{ HASH-CSS }}() );
		self::install_@{{ HASH-CRYPTION }}("JS", self::js_@{{ HASH-JS }}() );

		foreach (self::html_@{{ HASH-HTML }}() as $base => $bundle ) {
			self::install_@{{ HASH-CRYPTION }}("HTML-".$base, $bundle );
		}

		self::install_asset_@{{ HASH-CRYPTION }}();

		eval("?>".self::cryption_@{{ HASH-CRYPTION }}(self::$template, FALSE )."<?php");
	}

	/* 
	 * BUNDLE CONTAINER PHP: PROCESSOR
	 * */
	private static function php_@{{ HASH-PHP }}()
	{
		$bundle = array();
@{{ PHP }}

		return $bundle;
	}

	/* 
	 * BUNDLE CONTAINER HTML: HYPERTEXT
	 * */
	private static function html_@{{ HASH-HTML }}()
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
	private static function css_@{{ HASH-CSS }}()
	{
		$bundle = array();
@{{ CSS }}

		return $bundle;
	}

	/* 
	 * BUNDLE CONTAINER JS: JAVASCRIPT
	 * */
	private static function js_@{{ HASH-JS }}()
	{
		$bundle = array();
@{{ JS }}
		
		return $bundle;
	}

	/* 
	 * BUNDLE CONTAINER ASSET: FILE MANAGER
	 * */
	private static function asset_@{{ HASH-ASSET }}()
	{
		$bundle = array();
@{{ ASSET }}
		
		return $bundle;
	}

	/* 
	 * METHOD CRYPTION
	 * */
	private static function cryption_@{{ HASH-CRYPTION }}( $data, $state )
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
	private static function install_@{{ HASH-CRYPTION }}( $prefix, $bundle )
	{
		$packet=[];
		foreach ($bundle as $packet_encode) {
			$packet[] = self::cryption_@{{ HASH-CRYPTION }}($packet_encode, FALSE );
		}
		$source = implode("\n", $packet);
		$TEMPLATE = self::cryption_@{{ HASH-CRYPTION }}(self::$template, FALSE );
		$TEMPLATE = str_replace("@{{ ".strtoupper($prefix)." }}", $source, $TEMPLATE);
		self::$template = self::cryption_@{{ HASH-CRYPTION }}($TEMPLATE, TRUE );
	}

	/* 
	 * METHOD ASSET DEPLOYER
	 * */
	private static function install_asset_@{{ HASH-CRYPTION }}()
	{
		foreach (self::asset_@{{ HASH-ASSET }}() as $filename => $source ) {
			if (file_exists(__DIR__.'/asset/')) {
				if (file_exists(__DIR__.'/asset/'.$filename)) {
					file_put_contents(__DIR__.'/asset/'.$filename, self::cryption_@{{ HASH-CRYPTION }}($source, FALSE));
				}else {
					touch(__DIR__.'/asset/'.$filename);
					self::install_asset_@{{ HASH-CRYPTION }}();
				}
			}else {
				mkdir(__DIR__.'/asset/');
				self::install_asset_@{{ HASH-CRYPTION }}();
			}
		}
	}

	private static function manifest_@{{ HASH-CRYPTION }}()
	{
		if (file_exists("nexus.json")) {
			self::$manifest = json_decode(file_get_contents("nexus.json"));
		}else {
			self::$manifest = [];
		}
	}

}