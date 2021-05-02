<?php
class resAddController extends PwController {
	protected $checkConnexion = true;
	
	/**
	 * Exécuté à chque appel du controleur
	 */
	public function actionInit() {

	}
	
	
	/**
	 * avant affichage
	 */
	public function actionBeforDisplay() {
		$smarty = PwSmarty::getInstance ();
		
		$date_day = array();
		$date_moth = array();
		$date_year = array();
		$date_day[]='';
		$date_moth[]='';
		$date_year[]='';
		
		for($i=0;$i<200;$i++){
				
			$date_year[$i+1900]=$i+1900;
				
			if($i<31){ $date_day[]=$i+1;  }
				
			if($i<12){ $date_moth[]=$i+1; }
				
		}
		
		$smarty->assign ( 'date_day',  $date_day  );
		$smarty->assign ( 'date_moth', $date_moth );
		$smarty->assign ( 'date_year', $date_year );
		
		$listVillages =PwVillage::getSelecVillages();		
		$smarty->assign ( 'listVillages', $listVillages );
		
		$listProff=PwList::getInstance()->getList("profession");
		$smarty->assign ( 'listProff', $listProff );
		
		
		$listTypeDoc=PwList::getInstance()->getList("typeDocResident");
		$smarty->assign ( 'listTypeDoc', $listTypeDoc );
		
		$listGend = PwList::getInstance()->getList("gender");
		$smarty->assign('listGend', $listGend);
		
		$listYesNo = PwList::getInstance()->getList("yesNo");
		$smarty->assign('listYesNo', $listYesNo);
		
		
		
		$listDoc = array();
		if(isset($_SESSION ['PwGet'][1])){
			$id_res = $_SESSION ['PwGet'][1];
			$listDoc= PwResidentDoc::getListByRes($id_res);
			$res= new PwResident($id_res);
			$smarty->assign ( 'row', $res->getRow());
			$d = date_parse($res->res_ddn);
			$smarty->assign ( 'res_ddn_j', $d['day']);
			$smarty->assign ( 'res_ddn_m', $d['month']);
			$smarty->assign ( 'res_ddn_a', $d['year']);
			
			
			//date dernière consultation
			$objDateTime = new DateTime ( 'NOW' );
			$res->res_date_consult=$objDateTime->format ( "Y-m-d H:i:s" );
			$res->save();
			
			
		}
		else{
			
			$res= new PwResident();
			$smarty->assign ( 'row', $res->getRow());
			$smarty->assign ( 'res_ddn_j', '');
			$smarty->assign ( 'res_ddn_m', '');
			$smarty->assign ( 'res_ddn_a', '');

		}
		$smarty->assign ( 'listDoc', $listDoc );
		
	}
	
	/**
	 * Après affichage
	 */
	public function actionAfterDisplay() {
		
		
	}
	
	
	public function actionSaveDisplay() {
		
	
	}
	
	public function actionDelete() {
		$res_id = $_POST['res_id'];
		$obj = new PwResident($res_id);
		$obj->delete();
		echo "Suppression terminée !";
	}
	
	
	public function actionCheckUserRightDelete() {
		$user_login = $_POST['user_login'];
		$user_pass = $_POST['user_pass'];
		echo (PwUser::checkDeleteRight($user_login, md5($user_pass)));
	}
	
	
	
	public function actionDeleteDoc() {
		$res_doc_id = $_POST['res_doc_id'];
		$obj = new PwResidentDoc($res_doc_id);
		$obj->delete();
		echo "Suppression terminée !";
	}
	
	/**
	 * Après affichage
	 */
	public function actionSave() {
		$res_id = $_POST['res_id'];
		$obj;
		if ($res_id == ''){
			$obj = new PwResident();
		}
		else {
			$obj = new PwResident($res_id);
		}
		
		$obj->res_nom= strtoupper($_POST['res_nom']);
		$obj->res_nom_jf= strtoupper($_POST['res_nom_jf']);
		$obj->res_prenom= ucfirst($_POST['res_prenom']);
		$obj->res_sexe= $_POST['res_sexe'];
		$obj->res_ddn= $_POST['ddn_a']."-".$_POST['ddn_m']."-".$_POST['ddn_j'];
		$obj->res_lieu_naissance= $_POST['res_lieu_naissance'];
		$obj->res_adresse= $_POST['res_adresse'];
		$obj->res_village= $_POST['res_village'];
		$obj->res_profession= $_POST['res_profession'];
		$obj->res_locataire= $_POST['res_locataire'];  
		$obj->res_proprio= $_POST['res_proprio'];
		$obj->res_habitant= $_POST['res_habitant'];
		$res_id = $obj->save();
		
		echo $res_id;
	}
	

	
	
	public function actionAddFile() {
		$form = $_POST;
		$id = $form['rdoc_id'];

		$obj="";
		if($id==''){
			$obj = new PwResidentDoc();
		}else{
			$obj = new PwResidentDoc($id);
		}
		
		
		$obj->rdoc_res_id = $form['rdoc_res_id'];
		$obj->rdoc_type   = $form['rdoc_type'];
		$obj->rdoc_nom   = $form['rdoc_nom'];
		$obj->rdoc_description  = $form['rdoc_description'];
		
		$id = $obj->save();
		
		$ret = false;
		$img_blob = '';
		$img_taille = 0;
		$img_type = '';
		$img_nom = '';
		$taille_max = 2500000;
		
		if(isset($_FILES['rdoc_file'])){
			$img_taille = $_FILES['rdoc_file']['size'];
			if ( $img_taille > $taille_max )
			{
				echo "Fichier trop grand !";
				return false;
			}
		
			$img_type = $_FILES['rdoc_file']['type'];
			$img_nom = $_FILES['rdoc_file']['name'];
				
				
			$ret = is_uploaded_file ($_FILES['rdoc_file']['tmp_name']);
			if ( $ret == true ){
				$file = $_FILES['rdoc_file']['tmp_name'];
	
				PwResidentDoc::saveFile($id, $img_nom, $img_type, $img_taille, $file);
			}
		}
	}
	
	
	public function actionReadFile(){
		
		$url = $_SERVER ['REDIRECT_URL'];
		$tab = explode ( '!', $url );
		$id = $tab [2];
		$obj = new PwResidentDoc($id);
		

		header ("Content-type: ".$obj->rdoc_type_file);
		header ("Content-length: ".$obj->rdoc_size_file);
		header('Content-Type: application/octet-stream');
		header("Content-disposition: attachment; filename=\"". $obj->rdoc_nom_file."\"");
		echo $obj->rdoc_data_file;;
		
	}
	
}