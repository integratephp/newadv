<?php 

if ($Obj->ID == 0)
{
	$this->template->set('title','Brand Add');
	$Form->FormName = "Add";
}
else {
	$this->template->set('title','Brand Edit');
	$Form->FormName = "Edit";
	
}

?>

<style type="text/css">
    .multi-checkbox {
        max-height: 200px;
    }
</style>

<div class="content-wrapper" document="doc-form-template">
	<div class="container" style="min-height:450px;">

		<div class="row">
			<div class="col-md-12">
				<h1 class="page-header">Brand <small><?= $Form->FormName ;?></small></h1>
			</div> <!--- col --->
		</div> <!--- row --->


		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<form role="form" action="<?= base_url();?>brand/save" method="POST" class="form-horizontal">

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
									<input type="text" class="form-control" id="inputID" name="inputID" value="<?= $Obj->ID;?>">
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
								<label for="inputWorkstateType" class="control-label col-sm-3 mandatory">Parent</label>
								<!--- select --->
								<div class="form-group">
									<div class="col-sm-3">
										<select class="form-control" id="inputWorkstateType" name="inputWorkstateType"> 
                                            <?php
                                              for($i=0; $i < count($Obj->DropDownParentName); $i++){
                                                 if($Obj->DropDownParentName[$i]->ParentID == $Obj->ParentID){
                                                        echo '<option selected value="'.$Obj->DropDownParentName[$i]->ParentID.'">'.$Obj->DropDownParentName[$i]->ParentName.'</option>';
                                                    }
                                                    else{
                                                        echo '<option value="'.$Obj->DropDownParentName[$i]->ParentID.'">'.$Obj->DropDownParentName[$i]->ParentName.'</option>';
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

                            <!--- level --->
                            <div class="form-group">
                            	<label for="inputLevel" class="control-label col-sm-3">Brand Product</label>
                            	<div class="col-sm-9">
                            		<!-- @Html.TextBoxFor(model => model.Obj.Level, new { @class = "form-control", type = "number", min = "0", max = "7" }) -->
                            		<input type="text" class="form-control" id="inputName" name="inputName" value="<?= $Obj->BrandProduct;?>">
                            	</div>
                            </div>

                            <!--- decription --->
                            <div class="form-group">
                            	<label for="InputDescription" class="control-label col-sm-3">Description</label>
                            	<div class="col-sm-9">
                            		<!-- 	@Html.TextAreaFor(model => model.Obj.Description, new { @class = "form-control" }) -->
                            		<textarea class="form-control" id="InputDescription" name="InputDescription"><?=$Obj->Description;?></textarea>
                            	</div>
                            </div>

                            <!--- Category --->
                            <div class="form-group">
                                <label class="control-label col-sm-3">Category</label>
                                <div class="col-sm-9">
                                    <div class="multi-checkbox">
                                        <?php
                                            for($i=0; $i < count($Obj->CategoryPopulateCheckBox); $i++){
                                                $CheckBox = $Obj->CategoryPopulateCheckBox[$i]->CategorySelect == true ? "checked" : '';

                                              echo '<div class="checkbox">
                                                        <label title="'.$Obj->CategoryName.'">
                                                             <input type="checkbox" value="'.$Obj->CategoryPopulateCheckBox[$i]->CategoryID.'"'.$CheckBox.'/> '.$Obj->CategoryPopulateCheckBox[$i]->CategoryName.'
                                                        </label>
                                                    </div>';
                                            }
                                        ?>
                                       
                                     </div>
                                </div> <!-- column checkbox-->
                            </div> <!-- form-group-->


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


