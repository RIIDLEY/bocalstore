<h4>
	<span class="glyphicon glyphicon-arrow-right"></span> Documents
</h4>

<div class="btn-group btn-group-justified" role="group" style="width: 100%;">
	<div class="btn-group" role="group">
		<button type="button" class="btn btn-default"
			onclick="saveCat('','{$row.fur_id}');">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"
				style="color: #428bca;"></span> &nbsp; Ajouter Catégorie
		</button>
	</div>
	
	<div class="btn-group" role="group">
		<button type="button" class="btn btn-default"
			onclick="saveProd('');">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"
				style="color: #428bca;"></span> &nbsp; Ajouter Produit à la Catégorie Séléctionnée
		</button>
	</div>

	
</div>

<br>

<div style="width: 100%">
		<input type="hidden" name="fur_id" id="fur_id" value="{$row.fur_id}">

		<fieldset class="pwFieldset couleurfs">
			<legend>
				<span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Informations Fournisseur
			</legend>
			<div class="row">
				<div class="col-md-4">
					<div class="">
						<label for="pos_tem1_nom" style="width: 30%">Raison Social</label>{$row.fur_raison_social}
					</div>

					<div class="">
						<label for="pos_tem1_nom" style="width: 30%">Ville</label>{$row.fur_ville}
					</div>
	
				
				</div>
				<div class="col-md-4">
					<div class="">
						<label for="pos_tem1_nom" style="width: 30%">Mail</label>{$row.fur_mail}
					</div>

					<div class="">
						<label for="pos_tem1_nom" style="width: 30%">Site Internet </label>{$row.fur_site_internet}
					</div>
				</div>
				
				<div class="col-md-4">
									<div class="">
						<label for="pos_tem1_nom" style="width: 30%">Adresse</label>{$row.fur_adresse}
					</div>

					<div class="">
						<label for="pos_tem1_nom" style="width: 30%">Correspindant </label>{$row.fur_nom_corresp} {$row.fur_prenom_corresp}
					</div>


				</div>
				</div>
		</fieldset>
		<br>
		
		<fieldset class="pwFieldset">
			<legend>
				<span class="glyphicon glyphicon-file" aria-hidden="true"></span> Produits du Fournisseur
			</legend>

		<div class="row">
			<div class="col-md-6">
				<input type="hidden" id="four_id" value="{$row.fur_id}">
				<input type="hidden" id="select_cat_id" value="">
				<h4>Catégories</h4>
				<table class="table table-hover table-bordered table-condensed" id="tableCat">
				
				</table>
			</div>
			<div class="col-md-6">
				<h4>Produits</h4>
				<table class="table table-hover table-bordered table-condensed" id="tableProd" >
				
				</table>
			</div>
		</div>
		</fieldset>
		<br>
</div>
	
	

<div title="Catégorie" id="addCatDialog"	style="display: none; background-color: #f7f7f9">
	<h4>Ajouter / Modifier Catégorie</h4>

	<form action="POST" action="#" id="edoc_file_form" name="edoc_file_form" enctype="multipart/form-data">
		<table style="width: 95%">

			<tr>
				<td align="right" style="width: 40%">Nom Catégorie &nbsp;&nbsp; &nbsp;</td>
				<td><input class="form-control" type="text" id="cat_nom" name="cat_nom"></td>
			</tr>
			<tr>
				<td align="right" style="width: 40%">Description &nbsp;&nbsp; &nbsp;</td>
				<td><input class="form-control" type="text" id="cat_description" name="cat_description"></td>
			</tr>
		</table>
		<br>
		<br>
	</form>
</div>


<div title="Catégorie" id="addProdDialog"	style="display: none; background-color: #f7f7f9">
	<h4>Ajouter / Modifier Prduit</h4>

	<form action="POST" action="#" id="edoc_file_form" name="edoc_file_form" enctype="multipart/form-data">
		<input type="hidden" name="prd_id" id="prd_id" value="0">
		<table style="width: 95%">

			<tr>
				<td align="right" style="width: 40%">Réf Produit &nbsp;&nbsp; &nbsp;</td>
				<td><input class="form-control" type="text" id="prd_ref" name="prd_ref"></td>
			</tr>
			
			<tr>
				<td align="right" style="width: 40%">Nom Produit &nbsp;&nbsp; &nbsp;</td>
				<td><input class="form-control" type="text" id="prd_nom" name="prd_nom"></td>
			</tr>
			<tr>
				<td align="right" style="width: 40%">Description &nbsp;&nbsp; &nbsp;</td>
				<td><input class="form-control" type="text" id="prd_description" name="prd_description"></td>
			</tr>
			<tr>
				<td align="right" style="width: 40%">Prix HT &nbsp;&nbsp; &nbsp;</td>
				<td><input class="form-control" type="text" id="prd_prix_ht" name="prd_prix_ht"></td>
			</tr>
			<tr>
				<td align="right" style="width: 40%">TVA &nbsp;&nbsp; &nbsp;</td>
				<td><input class="form-control" type="text" id="prd_tva" name="prd_tva"></td>
			</tr>
		</table>
		<br>
		<br>
	</form>
</div>
	
	