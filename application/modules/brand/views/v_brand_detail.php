<?php 
    $this->template->set('title','Brand Detail');
?>

<div class="container" style="min-height:450px;">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">Brand <small>Detail</span></small></h1>
        </div> <!--- col --->
    </div> <!--- row --->
    <div class="row">
        <div class="col-md-12">
            <form class="form-inline">
                <div class="form-group">
                    <!--- back button --->
                    <button type="button" class="btnBack btn btn-default" onclick="window.location='<?=base_url()?>brand'" ><span class="glyphicon glyphicon-arrow-left"></span><span class="hidden-xs"> Back</span></button>

                    <!--- new button --->
                    <button type="button" class="btn btn-success" onclick="window.location='<?=base_url()?>workstate/addedit/0'"><span class="glyphicon glyphicon-plus"></span><span class="hidden-xs"> New</span></button>

                    <!--- edit button --->
                    <button type="button" class="btn btn-default" onclick="window.location='<?=base_url()?>brand/addedit/<?=$Obj->ID;?>'"><span class="glyphicon glyphicon-edit"></span><span class="hidden-xs"> Edit</span></button>

                    <!--- delete button dihidden --->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmation"><span class="glyphicon glyphicon-remove"></span><span class="hidden-xs"> Delete</span></button>
                

                </div>
            </form>
        </div>
    </div> <!--- row --->

    <form role="form" action="<?= base_url();?>Workstate/delete/<?= $Obj->ID; ?>" method="POST" name="FormModified" id="FormModified">

        <div class="modal fade bs-example-modal-sm" id="confirmation" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure want to delete this data?</p>
                        <button type="submit" class="btn btn-danger btn-sm" id="yes"><span class="glyphicon glyphicon-remove"></span><span class="hidden-xs"> Ok</span></button>
                        <button type="submit" class="btn btn-warning btn-sm" data-dismiss="modal"><span class="glyphicon glyphicon-arrow-left"></span><span class="hidden-xs"> Cancel</span></button>
                    </div>
                </div>
            </div>
        </div>
    </form>

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


    <div class="row">
        <div class="col-md-12">
            <table class="table table-display">
                <thead>
                    <tr>
                        <th colspan="2">Brand Information</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Name</td><td><?=$Obj->Name;?><span class="ref-num"> ( <?=$Obj->ID;?> ) </span></td></tr>
                    <tr><td>Parent</td><td><?=$Obj->ParentName;?><span class="ref-num"> ( <?=$Obj->ParentID;?> ) </span></td></tr>
                    <tr><td>Brand Product</td><td><?=$Obj->BrandProduct;?></td></tr>
                    <tr><td>Description</td><td><?=$Obj->Description;?></td></tr>
                    <tr><td>Category</td>
                        <td>
                            <?php if($Obj->CheckX == true)
                            { 
                                for($i = 0; $i < count($Obj->CategoryList); $i++){
                                    echo "<a href='".base_url()."brand'>". $Obj->CategoryList[$i]['CategoryName']."</a>"."<span class='ref-num'> (".$Obj->CategoryList[$i]['CategoryID'].")</span>";
                                }
                            } 
                            else { 
                                echo '<span class="label label-info">not set</span>'; } 
                            ?>                 
                        </td>
                    </tr>
                </tbody>
            </table>
        </div> <!--- col --->
    </div> <!--- row --->
</div> <!--- container --->

