<?php
class gedController extends PwController {
	protected $checkConnexion = true;
	
	protected $subViews = array (
			'gedList',
			'gedSearch'
	);
	
	/**
	 * actionInit
	 */
	public function actionInit() {
		if ($_SESSION['usr_right_ged'] != 1){
			header ( "Location: " . "!home!index" );
		}
		include_once '../app/pwController/gedListController.Class.php';
		include_once '../app/pwController/gedSearchController.Class.php';
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
			$frame = "gedAbout";
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

