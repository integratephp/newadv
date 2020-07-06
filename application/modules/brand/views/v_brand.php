<?php
$this->template->set('title','Brand Listing');

$Next2 = 0;
$Prev2 = 0;

$Next2 = $Form->SelectedIndexRow + 1;
if ($Next2 >= $Form->PageCount)
{
    $Next2 = $Form->PageCount;
}

$Prev2 = $Form->SelectedIndexRow - 1;
if ($Prev2 == 0)
{
    $Prev2 = 1;
}


?>

<div class="content-wrapper" document="doc-1column-template">
    <div class="container" style="min-height:450px;">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">Brand <small>Listing</small></h1>
            </div> <!--- col --->
        </div> <!--- row --->
        <!--- begin form --->
        <form role="form" action="/newadv/Brand" method="POST" class="form">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-inline search-form">
                        <div class="control-label hidden-xs">&nbsp;</div>
                        <div class="input-group">
                            <!--- search text box --->
                            <input class="form-control" id="SearchTextBox" name="SearchTextBox" type="text" value="<?= $Form->Search; ?>">
                            <span class="input-group-btn">
                                <!--- search button --->
                                <button type="button" id="fSearchbtn" class="btn btn-default"><span class="glyphicon glyphicon-search"></span><span class="hidden-xs"> Search</span></button>
                                <!--- reset button --->
                                <button type="button" id="fResetbtn" class="btn btn-default"><span class="glyphicon glyphicon-refresh"></span><span class="hidden-xs"> Reset</span></button>
                                <!--- new button --->
                                <button type="button" class="btn btn-success" onclick="window.location='<?=base_url()?>workstate/addedit/0'"><span class="glyphicon glyphicon-plus"></span><span class="hidden-xs"> New</span></button>

                                 <!--- filter button --->
                                <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#collapsibleSection"><span class="glyphicon glyphicon-chevron-down"></span><span class="hidden-xs"> Filter</span></button>
                                <!--- filter button --->
                            </span>
                        </div>
                    </div>
                </div>
            </div> <!-- col -->

            <!--- collapsible section for filter --->
            <div id="collapsibleSection" class="collapse">
                <div class="collapsible-content">
                    <div class="row">
                        <!--- Brand type --->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Parent</label>
                                <select id="ParentID" name="ParentID" class="form-control">
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
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Rows</label>
                                <select id="PageSize" name="PageSize" class="form-control">
                                    <?php
                                        // PHP SIDE
                                    $data = 5;
                                    $start = 10;
                                    for ($i = 0; $i < $data; $i++)
                                    { 
                                        if($Form->PageSize == $start){
                                            ?>
                                            <!-- HTML SIDE -->
                                            <option value="<?= $start; ?>" selected><?= $start; ?></option>                                                
                                            <?php
                                            // PHP SIDE
                                        }else{
                                            ?>
                                            <!-- HTML SIDE -->
                                            <option value="<?= $start; ?>"><?= $start; ?></option>
                                            <?php
                                            // PHP SIDE
                                        }
                                        $start = $start + 10;
                                    }
                                    ?>
                                </select>
                            </div>
                        </div> <!--- col --->
                       
                    </div> <!--- row --->
                </div> <!-- collapsible-content -->
            </div>
            <!--- end of collapsible section for filter --->
            <!--- collapsible section for filter --->
            
            <!--- end of collapsible section for filter --->
            <!--- display data --->
            <div class="row">
                <!--- row --->
                <div class="col-md-12">
                    <!--- col--->
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th class="text-right" style="width:3%">No.</th>
                                    <th style="width:25%">Name</th>
                                    <th style="width:25%">Parent Name</th>
                                    <th>Brand Product</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for($i=0; $i < count($ObjList); $i++){
                                    ?>
                                    <tr>
                                        <td class="text-right"><?= $ObjList[$i]->RowNumber; ?><text>.</text></td>
                                        <td><a href="<?= base_url();?>brand/detail/<?= $ObjList[$i]->ID; ?>"><?= $ObjList[$i]->Name; ?></a><span class="ref-num"> (<?= $ObjList[$i]->ID; ?>)</span></td>
                                        <td><?= $ObjList[$i]->ParentName; ?></td>
                                        <td><?= $ObjList[$i]->BrandProduct; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div> <!--- col --->
            </div> <!--- row --->
            <!--- BOTTOM PAGER --->
            <div class="row">
                <div class="col-md-12">
                    <div class="data-pager data-pager-bottom">
                        <p><?= $Form->StartRow; ?> - <?= $Form->EndRow; ?> of <?= $Form->RowCount; ?></p>
                        <div class="btn-group">
                            <button type="submit" class="btn btn-default" id="First2" name="First2" value="1"><span class="glyphicon glyphicon-menu-left"></span><span class="glyphicon glyphicon-menu-left"></span></button>
                            <button type="submit" class="btn btn-default" id="Prev2" name="Prev2" value="<?= $Prev2; ?>"><span class="glyphicon glyphicon-menu-left"></span></button>
                            <select id="SelectedIndexRow2" name="SelectedIndexRow2" class="btn">
                                <?php
                                $data2 = $Form->PageCount;
                                $start2 = 1;
                                for ($i = 0; $i < $data2; $i++)
                                {
                                    if ($Form->SelectedIndexRow == $start2)
                                    {
                                        ?>
                                        <option value="<?= $start2; ?>" selected><?= $start2; ?></option>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <option value="<?= $start2; ?>"><?= $start2; ?></option>
                                        <?php
                                    }
                                    $start2 = $start2 + 1;
                                }
                                ?>
                            </select>
                            <button type="submit" class="btn btn-default" id="Next2" name="Next2" value="<?= $Next2; ?>" role="button"><span class="glyphicon glyphicon-menu-right"></span></button>
                            <button type="submit" class="btn btn-default" id="Last2" name="Last2" value="<?= $Form->PageCount?>" role="button"><span class="glyphicon glyphicon-menu-right"></span><span class="glyphicon glyphicon-menu-right"></span></button>
                        </div>
                    </div>
                </div> <!--- col--->
            </div> <!--- row --->
            <!--- end of BOTTOM PAGER --->
            <!--- Row Count --->
            <div class="hidden">
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="RowCount" name="RowCount" value="<?= $Form->RowCount?>">
                </div>
            </div>

            <!--- SelectedIndexRow --->
            <div class="hidden">
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="SelectedIndexRowTemp" name="SelectedIndexRowTemp" value="<?= $Form->SelectedIndexRow?>">
                </div>
            </div>

            <!--- Filter Action --->
            <div class="hidden">
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="FilterSubmit" name="FilterSubmit" value="0">
                </div>
            </div>

            <!--- Reset Action --->
            <div class="hidden">
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="Reset" name="Reset" value="false">
                </div>
            </div>
        </form>
    </div> <!--- container --->
</div>

<script>
    var PageSize = <?= $Form->PageSize; ?>;
    var ParentID = <?= $Obj->ParentID; ?>;

    console.log("PageSize: ", PageSize);
    console.log("ParentID: ", ParentID);

     // Show Filter if Active
    if ((PageSize != 20) || (ParentID != 0)) {
        //$('#collapsibleSection').show();
        $('#collapsibleSection').addClass('in');
    }

     //////////////////// Paging ////////////////////

    // Search using click
    $('#fSearchbtn').on('click',function(){
        console.log('test click');
        $('#FilterSubmit').val(1);
        this.form.submit();
    });


    // PageSize
    $('#PageSize').on('change', function () {
        $('#FilterSubmit').val(1);
        this.form.submit();
    });

     // Selected Index Row
    $('#SelectedIndexRow2').on('change', function () {
        $('#FilterSubmit').val(1);
        this.form.submit();
    });

    // First2 using click
    $('#First2').on('click', function () {
        console.log('test click');
        $('#FilterSubmit').val(1);
    });

    // Prev2 using click
    $('#Prev2').on('click', function () {
        console.log('test click');
        $('#FilterSubmit').val(1);
    });

    // Next2 using click
    $('#Next2').on('click', function () {
        console.log('test click');
        $('#FilterSubmit').val(1);
    });

    // Last2 using click
    $('#Last2').on('click', function () {
        console.log('test click');
        $('#FilterSubmit').val(1);
    });


     //////////////////// Filter ////////////////////

    // Filter change
    $('#ParentID').on('change', function () {
        $('#FilterSubmit').val(1);
        this.form.submit();
    });

    
    // Reset using click
    $('#fResetbtn').on('click', function () {
        $('#Reset').val("true");
        this.form.submit();
    });


</script>
