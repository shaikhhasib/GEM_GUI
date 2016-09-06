<?php
include "head.php";
?>

<?php
$serial_num_of_newest_part = get_part_ID($READOUT_KIND_OF_PART_ID);
if ($serial_num_of_newest_part) {
    $serial_num = explode('-', $serial_num_of_newest_part);
} else {
    $serial_num = array();
    $serial_num[3] = "L";
    $serial_num[4] = 0000;
}
//echo $serial_num[3];
//echo $serial_num[4];
//echo "loacations"; print_r(get_locations());
//echo "<br>institutes"; print_r(get_institutes());
//echo "<br>Manufacturers";print_r(get_manufacturers());
?>
<div class="container-fluid" >
    <div class="row">

        <?php include "side.php"; ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h2 class="sub-header"> <img src="images/ROPCB.png" width="4%"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> New Readout  </h2>

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                if (isset($_POST['serial'])) {
                    $temp =array();
                    $arr = array();
                    echo '<div role="alert" class="alert alert-success">
      <strong>Well done!</strong> You successfully created Gem PCB Readout <strong>ID:</strong> ' . $_POST['serial'] .
                    '</div>';
                    $temp[$SERIAL_NUMBER] = $_POST['serial'];
                    $temp[$NAME_LABEL] = $_POST['serial'];
                    if (isset($_POST['location']) && !empty($_POST['location'])) {
                        //echo $_POST['location'];
                        $temp[$LOCATION] = $_POST['location'];
                    }
                    if (isset($_POST['comment']) && !empty($_POST['comment'])) {
                        //echo $_POST['comment'];
                        $temp[$COMMENT_DESCRIPTION] = $_POST['comment'];
                    }
                    if (isset($_POST['barcode']) && !empty($_POST['barcode'])) {
                        //echo $_POST['barcode'];
                        $temp[$BARCODE] = $_POST['barcode'];
                    }
                    
                        $kindOfPart = $READOUT_KIND_OF_PART_NAME;
                        //echo  $kindOfPart;
                        $temp[$KIND_OF_PART] = $kindOfPart;
                    
                    
                    if (isset($logName)) {
                        //echo $logName;
                        $temp[$RECORD_INSERTION_USER] = $logName;
                    }
                  
                    if (isset($_POST['manufacturer']) && !empty($_POST['manufacturer'])) {
                        //echo $_POST['manufacturer'];
                        $temp[$MANUFACTURER] = $_POST['manufacturer'];
                    }
                    $arr[] = $temp;
                    
                    generateXml($arr);
                }
            } else {

                echo '<div style="display: none" role="alert" class="alert alert-danger ">
      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><strong>Error!</strong> Please fill the required fields.
    </div>';
                ?> 


                <form method="POST" action="new_readout.php">

                    <div class="row">
                        <div class="col-xs-6 panel-info panel" style="padding-left: 0px; padding-right: 0px;">
                            <div class="panel-heading">
                                <h3 class="panel-title" >  <span aria-hidden="true" class="glyphicon glyphicon-info-sign"></span>Readout Information</h3>
                            </div>
                            <div class="panel-body">
                            <!-- <span class="text-muted">List single chambers</span> -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1" style="float: left;">Serial Number:&nbsp;</label>
                                    <div class="serial"><span class="name">PCB-RO-B<span class="batch">1</span>-</span><span id="vers" ><?= $serial_num[3]; ?></span><span class="id">-<?= str_pad($serial_num[4] + 1, 4, 0, STR_PAD_LEFT); ?></span></div>
                                    <input class="serialInput" name="serial" value="" hidden>
                                </div>
                                <div class="form-group">
                                    &nbsp;<b style=" color: red">*</b>
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Choose Version
                                            <span class="caret"></span>
                                        </button> 
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a href="#">Long</a></li>
                                            <li><a href="#">Short</a></li>
                                        </ul>
                                    </div><br>
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Choose Batch Number
                                            <span class="caret"></span>
                                        </button> 
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a href="#" class="batchnum">1</a></li>
                                            <li><a href="#" class="batchnum">2</a></li>
                                            <li><a href="#" class="batchnum">3</a></li>
                                            <li><a href="#" class="batchnum">4</a></li>
                                            <li><a href="#" class="batchnum">5</a></li>
                                            <li><a href="#" class="batchnum">6</a></li>
                                            <li><a href="#" class="batchnum">7</a></li>
                                            <li><a href="#" class="batchnum">8</a></li>
                                            <li><a href="#" class="batchnum">9</a></li>
                                            <li><a href="#" class="batchnum">10</a></li>
                                        </ul>
                                    </div><br>
                                    <div class="form-group">
                                        <label> Barcode <i class="ace-icon glyphicon glyphicon-barcode"></i></label><br>
                                        <input name="barcode" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile" >Location</label>
                                        <input name="location" value="" hidden>
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Choose Location
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                <?php get_locations(); ?>
                                            </ul>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile" >Manufacturer</label>
                                        <input name="manufacturer" value="" hidden>
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Choose Manufacturer
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                <?php get_manufacturers(); ?>
                                            </ul>
                                        </div>

                                    </div>
                                    
                                </div>
                                <!--                                <div class="form-group">
                                                                    <label> Manufacturer name </label><br>
                                                                    <input name="manufacturer" >
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="control-group">
                                                                        <label class="control-label">Manufacture date</label>
                                                                        <div class="controls input-append date form_datetime" data-date="2015-08-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
                                                                            <input size="16" type="text" value="2015-08-16T05:25:07" readonly>
                                                                            <span class="add-on glyphicon glyphicon-remove"><i class="icon-remove"></i></span>
                                                                            <span class="add-on glyphicon glyphicon-calendar"><i class="icon-th"></i></span>
                                                                        </div>
                                                                        <input type="hidden" id="dtp_input1" value="" />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>  Status </label>
                                                                    <input name="driftId" value="" hidden>
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                            Choose Status
                                                                            <span class="caret"></span>
                                                                        </button>
                                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                                            <li><a class="status" href="#"> <span class="label label-success">Accepted</span></a></li>
                                                                            <li><a class="status" href="#"> <span class="label label-danger">Rejected</span></a></li>
                                                                            <li><a class="status" href="#"> <span class="label label-info">Repaired</span></a></li>
                                                                            <li><a class="status" href="#"> <span class="label label-primary">Installed</span></a></li>
                                                                            <li><a class="status" href="#"> <span class="label label-default">Under Test</span></a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input class="testDiod" type="checkbox"> equipped with diodes?
                                                                            <input class="diodes" name="testDiod" value="" hidden>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                   
                                                                        <label> Add picture </label><br>
                                                                        <input class="testDiod" type="file">
                                                                    
                                                                </div>-->

                            </div>
                        </div>
                        <div class="col-xs-6 panel-info panel " style="padding-left: 0px; padding-right: 0px;">
                            <div class="panel-heading ">
                                <h3 class="panel-title" > <span aria-hidden="true" class="glyphicon glyphicon-comment"></span>Comments:</h3>
                            </div>
                            <div class="panel-body">

                                <div class="form-group">
                                    <label for="comment"> Leave your comment:</label>
                                    <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>









                    <button type="submit" class="btn btn-default subbutt">Submit</button>   



                </form>
            <?php } ?>



        </div>
    </div>
</div>

<?php
include "foot.php";
?>

<script>
    $(document).ready(function () {

        /**
         * [1] Ajax to refresh the Id once enter the page ( 1st time landing )
         */
        $.ajax({
            url: 'functions/ajaxActions.php?kindid=<?= $READOUT_KIND_OF_PART_ID; ?>',
            success: function () { /*alert('test');*/
            }
        });

        /**
         * [2] Ajax to refresh the Id every 10 seconds to check for updated ID
         * @returns {undefined}
         */
        //setInterval(ajaxCall, 7000); //7000 MS == 7s Seconds

        function ajaxCall() {
            if ($("#vers").text() == "L-") {
                $.ajax({
                    url: 'functions/ajaxActions.php?kindid=<?= $READOUT_KIND_OF_PART_ID; ?>&version=-L-',
                    success: function (data) {
                        $(".id").text(data);
                        $(".serialInput").val($(".serial").text());

                    }
                });

            }
            else if ($("#vers").text() == "S-") {
                $.ajax({
                    url: 'functions/ajaxActions.php?kindid=<?= $READOUT_KIND_OF_PART_ID; ?>&version=-S-',
                    success: function (data) {
                        $(".id").text(data);
                        $(".serialInput").val($(".serial").text());
                    }
                });

            }
            else {
                $.ajax({
                    url: 'functions/ajaxActions.php?kindid=<?= $READOUT_KIND_OF_PART_ID; ?>',
                    success: function () { /*alert('test');*/
                    }
                });
            }

        }


        /**
         * [3] Show  loader when user clickes submit button
         * @param {type} param1
         * @param {type} param2
         */
        $(".subbutt").on('click', function () {

            if ($(".serialInput").val() != "") {
                $('#preloader').fadeIn('fast');
            }
        });
    })

    /**
     * [4] When selecting Long or Short version , run Ajax get latest ID Short or Long.
     */
    $('.dropdown-menu a').on('click', function () {

        if ($(this).html() == "Long") {
            $('#preloader').fadeIn('fast', function () {/*$(this).remove();*/
            });
            $("#vers").text("L-");
            $.ajax({
                url: 'functions/ajaxActions.php?kindid=<?= $READOUT_KIND_OF_PART_ID; ?>&version=-L-',
                success: function (data) {
                    $(".id").text(data);
                    $(".serialInput").val($(".serial").text());
                    $('#preloader').fadeOut('fast', function () {/*$(this).remove();*/
                    });
                }
            });

        }

        if ($(this).html() == "Short") {
            $('#preloader').fadeIn('fast', function () {/*$(this).remove();*/
            });
            $("#vers").text("S-");
            $.ajax({
                url: 'functions/ajaxActions.php?kindid=<?= $READOUT_KIND_OF_PART_ID; ?>&version=-S-',
                success: function (data) {
                    $(".id").text(data);
                    $(".serialInput").val($(".serial").text());
                    $('#preloader').fadeOut('fast', function () {/*$(this).remove();*/
                    });
                }
            });

        }
        
        if ($(this).attr('class') == "batchnum") {
            
            $(".batch").text($(this).html());

        }
        


    })
    
                 jQuery(document).ready(function($) {
        $("#partslist").show();
$("#<?= $READOUT_ID; ?>").attr("class","active");
})
    
</script>