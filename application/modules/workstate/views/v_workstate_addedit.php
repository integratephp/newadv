<?php 

if ($Obj->ID == 0)
{
	$this->template->set('title','Workstate Add');
	$Form->FormName = "Add";
}
else {
	$this->template->set('title','Workstate Edit');
	$Form->FormName = "Edit";
	
}

?>

<div class="content-wrapper" document="doc-form-template">
	<div class="container" style="min-height:450px;">

		<div class="row">
			<div class="col-md-12">
				<h1 class="page-header">Workstate <small><?= $Form->FormName ;?></small></h1>
			</div> <!--- col --->
		</div> <!--- row --->


		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<form role="form" action="" method="" class="form-horizontal">

							<!--- error --->
							<?php 
							if($Form->ErrorName != null)
							{
								echo '<div class="alert alert-danger alert-dismissible" style="margin-bottom:0 !important; margin-top:20px !important" role="alert">
								<button type="button" class="close" data-dismiss="alert">
								<span aria-hidden="true">×</span><span class="sr-only">Close</span>
								</button><strong><?=Form->FormName ;?> </strong><br><?= $Form->ErrorDescription ;?>
								</div>';
							} ?>

							<!--- id --->
							<div class="hidden">
								<label for="inputID" class="control-label col-sm-3 mandatory">ID</label>
								<div class="col-sm-9">
									<!-- @Html.TextBoxFor(model => model.Obj.ID, new { @class = "form-control" }) -->
									<input type="text" class="form-control" id="inputID" name="inputName" value="<?= $Obj->ID;?>">
								</div>
							</div>

							<!--- name --->
							<div class="form-group">
								<label for="inputName" class="control-label col-sm-3 mandatory">Name</label>
								<div class="col-sm-9">
									<!-- @Html.TextBoxFor(model => model.Obj.Name, new { @class = "form-control" }) -->
									<input type="text" class="form-control" id="inputName" name="inputName" value="<?= $Obj->Name;?>">
								</div>
							</div>

							<!--- workstate type --->
							<div class="form-group">
								<label for="inputWorkstateType" class="control-label col-sm-3 mandatory">Workstate Type</label>
								<!--- select --->
								<div class="form-group">
									<div class="col-sm-3">
										<select class="form-control" id="inputWorkstateType" name="inputWorkstateType" disabled="disabled">                                
											<?php
											for($i=0; $i < count($Obj->DropDownWorkstateType); $i++){
												if($Obj->DropDownWorkstateType[$i]->WorkstateTypeID == $Obj->WorkstateTypeID){
													echo '<option selected value="'.$Obj->DropDownWorkstateType[$i]->WorkstateTypeID.'">'.$Obj->DropDownWorkstateType[$i]->WorkstateTypeName.'</option>';
												}
												else{
													echo '<option value="'.$Obj->DropDownWorkstateType[$i]->WorkstateTypeID.'">'.$Obj->DropDownWorkstateType[$i]->WorkstateTypeName.'</option>';
												}
											}
											?> 
										</select>
                            			<!-- @Html.DropDownListFor(model => model.Obj.WorkstateTypeID, Model.Obj.DropDownWorkstateType, new { @Class = "form-control", @disabled="disabled" })
                            			@Html.HiddenFor(model => model.Obj.WorkstateTypeID)
                            			@Html.HiddenFor(model => model.Obj.WorkstateTypeName) -->
                            		</div>
                            	</div>
                            </div>

                            <!--- Finalized --->
                            <div class="form-group">
                            	<label for="inputName" class="control-label col-sm-3"></label>
                            	<div class="col-sm-3">
                            		<div class="checkbox-inline">
                            			<label><input type="checkbox" <?= $Obj->Finalized != 0 ? "checked" : ""?> value="<?= $Obj->Finalized ;?>" onclick="$(this).attr('value', this.checked ? 1 : 0)" name="Finalized" id="Finalized" /> Finalized</label>
                            		</div>
                            		<div class="checkbox-inline">
                            			<label><input type="checkbox" <?= $Obj->BackwardAllow != 0 ? "checked" : ""?> value="<?= $Obj->BackwardAllow; ?>" onclick="$(this).attr('value', this.checked ? 1 : 0)" name="BackwardAllow" id="BackwardAllow" /> Backward Allow</label>
                            		</div>
                            	</div>
                            </div>

                            <!--- level --->
                            <div class="form-group">
                            	<label for="inputLevel" class="control-label col-sm-3">Level</label>
                            	<div class="col-sm-9">
                            		<!-- @Html.TextBoxFor(model => model.Obj.Level, new { @class = "form-control", type = "number", min = "0", max = "7" }) -->
                            		<input type="number" class="form-control" id="inputLevel" name="inputLevel" min="0" max="7" value="<?= $Obj->Level;  ?>">
                            	</div>
                            </div>

                            <!-- color -->
                            <div class="form-group">
                            	<label class="control-label col-sm-3">Color </label>
                            	<div class="col-sm-9">
                            		<input type="color" class="form-control" id="inputColor" name="inputColor" value="<?= $Obj->Color;?>">
                            		<!-- @Html.TextBoxFor(model => model.Obj.Color, new { @class = "form-control", type = "color" }) -->
                            	</div>
                            </div>


                            <!-- @*<div class="form-group">
                            	<label class="control-label col-sm-3">Color </label>
                            	<div class="col-sm-9">
                            		<div class="input-group my-colorpicker2 colorpicker-element">
                            			@Html.TextBoxFor(model => model.Obj.Color, new { @class = "form-control", type = "color" })

                            			<div class="input-group-addon">
                            				<i style="background-color: rgb(0, 0, 0);"></i>
                            			</div>
                            		</div>
                            	</div>
                            </div>*@ -->


                            <!-- @*<div class="form-group">
                            	<div class="col-sm-9">
                            		<label for="fNuance">Color Nuance: </label>
                            		<input type="color" class="form-control" id="Nuance" name="Nuance" placeholder="Color Nuance">
                            		<span class="help-block">Format html color code. Example: #990099</span>
                            	</div>
                            </div>*@ -->

                            <!--- decription --->
                            <div class="form-group">
                            	<label for="InputDescription" class="control-label col-sm-3">Description</label>
                            	<div class="col-sm-9">
                            		<!-- 	@Html.TextAreaFor(model => model.Obj.Description, new { @class = "form-control" }) -->
                            		<textarea class="form-control" id="InputDescription" name="InputDescription"><?=$Obj->Description;?></textarea>
                            	</div>
                            </div>

                            <!--- button --->
                            <div class="form-group">
                            	<div class="col-sm-offset-3 col-sm-9">
                            		<button type="submit" class="btn btn-primary">Save</button>
                            		<button type="reset" class="btn btn-default">Reset</button>
                            		<!-- @if ((@Model.Form.UrlRefer.Contains("/Workstate/AddEdit/") == true || (@Model.Form.UrlRefer.Contains("/Workstate/Save") == true)))
                            			{ -->
                            				<button type="button" onclick="window.location.href = '<?= base_url()?>workstate'" class="btn btn-warning">Cancel</button>
                            				<!-- } -->
                            		<!-- else
                            		{
                            			<button type="button" onclick="window.location.href = '@Request.UrlReferrer'" class="btn btn-warning">Cancel</button>
                            		} -->
                            	</div>
                            </div>
                        </form>
                    </div> <!--- panel-body --->
                </div>
            </div> <!--- col --->
        </div> <!--- row ---> 
    </div>
</div>


