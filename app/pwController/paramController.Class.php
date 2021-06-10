<?php
class paramController extends PwController {
	protected $checkConnexion = true;
	
	protected $subViews = array (
			'paramUser',
			'paramInfo',
            'paramService'
	);
	
	/**
	 * actionInit
	 */
	public function actionInit() {
		if ($_SESSION['usr_right_param'] != 1){
			header ( "Location: " . "!home!index" );
		}
		if ($_SESSION['usr_right_lecture'] != 0){
		    header ( "Location: " . "!home!index" );
		}
		include_once '../app/pwController/paramUserController.Class.php';
		include_once '../app/pwController/paramInfoController.Class.php';
		include_once '../app/pwController/paramServiceController.Class.php';
	}
	
	/**
	 * actionBeforDisplay
	 */
	public function actionBeforDisplay() {
		$tab = $_SESSION ['PwGet'];
		$frame = "";
		$active = 0;
		if (isset ( $tab [0] )) {
			$frame = $tab [0];
		} else {
			$frame = "paramAbout";
		}
		
		$smarty = PwSmarty::getInstance ();
		
		$smarty->assign ( 'frame', $frame );
		$smarty->assign ( 'frametpl', $frame . ".tpl" );
		$smarty->assign ( 'filejs', $frame . ".js" );
	}
	
	
	
	

	/**
	 * Après affichage
	 */
	public function actionAfterDisplay() {
	}
}

