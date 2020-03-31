<?php 
    $this->template->set('title','Workstate Listing');

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

    $BannedDetected = "";
?>
<!-- <?php var_dump($ObjList);?> -->
<div class="content-wrapper" document="doc-1column-template">
    <div class="container" style="min-height:450px;">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">Workstate <small>Listing</small></h1>
            </div> <!--- col --->
        </div> <!--- row --->
        <!--- begin form --->
        <form role="form" action="/newadv/Workstate" method="POST" class="form">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-inline search-form">
                        <div class="control-label hidden-xs">&nbsp;</div>
                        <div class="input-group">
                            <!--- search text box --->
                            <input class="form-control" id="SearchTextBox" name="Form.Search" type="text" value="">
                            <span class="input-group-btn">
                                <!--- search button --->
                                <button type="button" id="fSearchbtn" class="btn btn-default"><span class="glyphicon glyphicon-search"></span><span class="hidden-xs"> Search</span></button>
                                <!--- reset button --->
                                <button type="button" id="fResetbtn" class="btn btn-default"><span class="glyphicon glyphicon-refresh"></span><span class="hidden-xs"> Reset</span></button>
                                <!--- filter button --->
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-xs-7">
                            <!--- Workstate --->
                            <div class="form-group">
                                <label class="control-label">Workstate Type</label>
                                <select class="form-control" data-val="true" data-val-number="The field WorkstateTypeID must be a number." data-val-required="The WorkstateTypeID field is required." id="WorkstateTypeID" name="Obj.WorkstateTypeID">                                
                                <?php
                                    for($i=0; $i < count($Obj->DropDownWorkstateType); $i++){
                                ?>
                                    <option value="<?= $Obj->DropDownWorkstateType[$i]->WorkstateTypeID; ?>"><?= $Obj->DropDownWorkstateType[$i]->WorkstateTypeName; ?></option>
                                <?php
                                    }
                                ?> 
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-5">
                            <!--- Rows --->
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
                        </div>
                    </div>
                </div>
             </div> <!-- col -->
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
                                    <th>Workstate Type</th>
                                    <th class="text-center">Finalize</th>
                                    <th class="text-center">Backward Allow</th>
                                    <th class="text-center">Level</th>
                                    <th class="text-center">Color</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    for($i=0; $i < count($ObjList); $i++){
                                ?>
                                    <tr>
                                        <td class="text-right"><?= $i+1; ?><text>.</text></td>
                                        <td><a href="<?= base_url();?>workstate/detail/<?= $ObjList[$i]->ID; ?>"><?= $ObjList[$i]->Name; ?></a><span class="ref-num"> (<?= $ObjList[$i]->ID; ?>)</span></td>
                                        <td><?= $ObjList[$i]->WorkstateTypeName; ?></td>
                                        <td class="text-center">
                                            <?php
                                            if ($ObjList[$i]->Finalized == 1)
                                            {
                                                echo '<span class="glyphicon glyphicon-ok"></span>';
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                            if ($ObjList[$i]->BackwardAllow == 1)
                                            {
                                                echo '<span class="glyphicon glyphicon-ok"></span>';
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center"><?= $ObjList[$i]->Level; ?></td>
                                        
                                        <td class="text-center"><div class="color-palette" style="background-color: <?= $ObjList[$i]->Color; ?>"><span style="color: rgba(255, 255, 255, 0.8);"> <?= $ObjList[$i]->Color; ?></span></div></td>
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
    var WorkstateTypeID = <?= $Obj->WorkstateTypeID; ?>;

    console.log("PageSize: ", PageSize);
    console.log("WorkstateTypeID: ", WorkstateTypeID);
    // Show Filter if Active
    if ((PageSize != 20) || (WorkstateTypeID != 0)) {
        //$('#collapsibleSection').show();
        $('#collapsibleSection').addClass('in');
    }

    //////////////////// Paging ////////////////////

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

    //////////////////// End Paging ////////////////////

    //////////////////// Searching and Reset ////////////////////

    // Search using click
    $('#fSearchbtn').on('click',function(){
        console.log('test click');
        $('#FilterSubmit').val(1);
        this.form.submit();
    });

    // Search using enter
    $(document).keypress(function (e) {
        if (e.which == 13) {
            $('#FilterSubmit').val(1);
            this.form.submit();
        }
    });

    // Reset using click
    $('#fResetbtn').on('click', function () {
        $('#Reset').val("true");
        this.form.submit();
    });

    //////////////////// End Searching and Reset ////////////////////

    //////////////////// Filter ////////////////////

    // Filter change
    $('#WorkstateTypeID').on('change', function () {
        $('#FilterSubmit').val(1);
        this.form.submit();
    });
    //////////////////// End Filter ////////////////////
</script>