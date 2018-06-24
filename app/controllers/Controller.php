<?php

class Controller {

	public function render( $url, $data = [] ){

		if( file_exists( '../app/views/'.$url.'.php') ){
			require_once  '../app/views/' . $url . '.php';
		}
		else {
			echo 'No template for this model!';
		}

	}


}