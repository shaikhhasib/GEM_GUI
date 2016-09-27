
<?php
include "head.php";
?>


<div class="container-fluid">
    <div class="row">
<?php include "side.php"; ?>
        <div class="col-xs-6 col-sm-6 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <!--<h1 class="page-header">Search By pin number for channel info</h1>-->


            <!--                <ul class="list-group">
            
            
                                <li class="list-group-item" style="text-align:center">
                                    <span class="label label-warning"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> Notification !!</span>
                                    <div class="alert alert-warning" role="alert" style="text-align: center;"><span aria-hidden="true" class="glyphicon glyphicon-wrench"></span> Still Under Development, We'll keep you informed Soon <span aria-hidden="true" class="glyphicon glyphicon-hourglass"></span></div>
                                </li>
                            </ul>-->

            <div class=" panel-info panel" style="padding-left: 0px; padding-right: 0px;">
                <div class="widget-header widget-header-blue widget-header-flat">
                    <h4 class="widget-title">   Search for connector pin numbers:</h4>
                </div>
                <div class="panel-body">

                    <div class="row col-xs-6 ">

                        <form method="POST" action="search_channels_pin.php">
                            <div class="form-group">
                                <label >Search by:</label>
                                <input name="searchby" value="" hidden>
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Choose Search by
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <li><a class="searchbysdv" href="#"> SECTOR - DEPTH - VFAT_POSN </a></li>
                                        <li><a class="searchbyepd" href="#"> IETA - IPHI - DEPTH </a></li>
                                    </ul>
                                </div>
                            </div> 
                            <div class="form-group sdv"  >
                                <label >Sector:</label>
                                <input name="SECTOR" value="" hidden>
                                <!--multiple=""-->
                                <select tabindex="-1"  class="chosen-select-sector" style="" data-placeholder="Choose Sector">
                                    <option value=""></option>
                                    <optgroup label="sectors ">
                                        <?= getSectors(); ?>
                                    </optgroup>
                                </select>

                                <br/>
                                <div style="white-space:nowrap">
                                    <label class="sublabel" >Depth:</label>
                                    <input value="" name="DEPTH">
                                </div>
                                <br/>
                                <div style="white-space:nowrap">
                                    <label class="sublabel" >VFAT position:</label>
                                    <input value="" name="VFAT_POSN">
                                </div>
                            </div>
                            <div class="form-group epd" >
                                <div style="white-space:nowrap">
                                    <label class="sublabel" >IETA:</label>
                                    <input value="" name="IETA">
                                </div>
                                <br/>
                                <div style="white-space:nowrap">
                                    <label class="sublabel" >IPHI:</label>
                                    <input value="" name="IPHI">
                                </div>
                                <br/>
                                <div style="white-space:nowrap">
                                    <label class="sublabel" >Depth:</label>
                                    <input value="" name="DEPTH">
                                </div>
                            </div>
                            
<!--CHANNEL_MAP_ID
SUBDET
SECTOR
TYPE
ZPOSN
IETA
IPHI
DEPTH
VFAT_POSN
DET_STRIP
VFAT_CHAN
CONN_PIN-->
                            <button type="submit" class="btn btn-default btn-lg subbutt_gen">Search</button>
                        </form>
                    </div>
                </div>

            </div>

            <?php if(!isset($_POST['query'])) { ?>
             <div class=" panel-info panel" style="padding-left: 0px; padding-right: 0px;"  >
                <div class="widget-header widget-header-blue widget-header-flat">
                    <h4 class="widget-title">   Search Result:</h4>
                </div>
                 <div class="panel-body"></div>
                 </div>
            <?php }?>
        </div>

    </div>
</div>



<?php
include "foot.php";
?>
<script>
    
    $(".sdv,.epd").hide();
    
    $("#map").attr("class", "active");
</script>