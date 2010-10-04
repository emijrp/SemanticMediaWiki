<?php

/**
 * Class for the 'ask' parser functions.
 * 
 * @since 1.5.3
 * 
 * @file SMW_Ask.php
 * @ingroup SMW
 * @ingroup ParserHooks
 * 
 * @author Markus Krötzsch
 * @author Jeroen De Dauw
 */
class SMWAsk {
	
	/**
	 * Method for handling the ask parser function.
	 * 
	 * @since 1.5.3
	 * 
	 * @param Parser $parser
	 */
	public static function render( Parser &$parser ) {
		global $smwgQEnabled, $smwgIQRunningNumber;

		if ( $smwgQEnabled ) {
			$smwgIQRunningNumber++;

			$params = func_get_args();
			array_shift( $params ); // We already know the $parser ...

			$result = SMWQueryProcessor::getResultFromFunctionParams( $params, SMW_OUTPUT_WIKI );
		} else {
			smwfLoadExtensionMessages( 'SemanticMediaWiki' );
			$result = smwfEncodeMessages( array( wfMsgForContent( 'smw_iq_disabled' ) ) );
		}

		SMWOutputs::commitToParser( $parser );

		return $result;		
	}
	
}