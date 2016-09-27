<?php
include "head.php";
?>
<div class="container-fluid">
    <div class="row">

        <?php include "side.php"; ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h2 class="sub-header"><img src="images/sc2.png" width="4%"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> New Super-Chamber  </h2>

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                if (isset($_POST['serial'])) {
                    echo '<div role="alert" class="alert alert-success">
      <strong>Well done!</strong> You successfully created Super Chamber <strong>ID:</strong> ' . $_POST['serial'] .
                    '</div>';
                }
            } else {

                echo '<div style="display: none" role="alert" class="alert alert-danger ">
      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><strong>Error!</strong> Please fill the required fields.
    </div>';
                ?> 


                <form method="POST" action="new_sup_chamber.php">

                    <div class="row">
                        <div class="col-xs-6 panel-info panel" style="padding-left: 0px; padding-right: 0px;">
                            <div class="panel-heading">
                                <h3 class="panel-title" >  <span aria-hidden="true" class="glyphicon glyphicon-info-sign"></span>Super-Chamber Information</h3>
                            </div>
                            <div class="panel-body">
                            <!-- <span class="text-muted">List single chambers</span> -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Serial Number</label>
                                    <div class="serial"><span class="name">SUP-GE1/1-VI-</span><span class="version">VERSION</span><span class="between">-</span><span class="institute">INSTITUTE</span><span class="id">-0010</span></div>
                                    <input class="serialInput" name="serial" value="" hidden>
                                </div>
                                <div class="form-group">
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
                                            Choose Institute
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a href="#">Bari</a></li>
                                            <li><a href="#">CERN</a></li>
                                            <li><a href="#">Florida Tech(FIT)</a></li>
                                            <li><a href="#">Frascati(LNF)</a></li>
                                            <li><a href="#">Ghent</a></li>
                                            <li><a href="#">BARC</a></li>
                                            <li><a href="#">Delhi</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="form-group">
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
                                        <input type="hidden" id="dtp_input1" value="2015-08-16T05:25:07" />
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

                                    <label> Add picture </label><br>
                                    <input class="testDiod" type="file">

                                </div>

                            </div>
                        </div>
                        <div class="col-xs-6 panel-info panel " style="padding-left: 0px; padding-right: 0px;">
                            <div class="panel-heading ">
                                <h3 class="panel-title" > <span aria-hidden="true" class="glyphicon glyphicon-cog"></span>Attach single chambers</h3>
                            </div>
                            <div class="panel-body">
                                <span class="text-muted"></span>
                                <div class="form-group">
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-16">

                                        <div class="form-group longchambers">
                                            <label for="exampleInputFile">Choose Chamber 1:</label>
                                            <input class="chamber-l1 chamberinput " name="chamberl1" value="" hidden><br>
                                            <!--multiple=""-->
                                            <select tabindex="-1"  class="chosen-select-chamber-l1"  data-placeholder="Choose Long Chambers " elementvalue="chamber-l1">
                                                <option value=""></option>
                                                <optgroup label="Long">
                                                    <?php
                                                    $arr = get_available_parts_nohtml($CHAMBER_KIND_OF_PART_ID, "-L-");
                                                    foreach ($arr as $value) {
                                                        echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                    }
                                                    ?>
                                                </optgroup>

                                            </select>
                                            <br/>
                                            <label for="exampleInputFile">Choose Chamber 2:</label>
                                            <input class="chamber-l2 chamberinput " name="chamberl2" value="" hidden><br>
                                            <!--multiple=""-->
                                            <select tabindex="-1"  class="chosen-select-chamber-l2"  data-placeholder="Choose Long Chambers " elementvalue="chamber-l2">
                                                <option value=""></option>
                                                <optgroup label="Long">
                                                    <?php
                                                    $arr = get_available_parts_nohtml($CHAMBER_KIND_OF_PART_ID, "-L-");
                                                    foreach ($arr as $value) {
                                                        echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                    }
                                                    ?>

                                                </optgroup>

                                            </select>


                                        </div>
                                        <div class="form-group shortchambers" >
                                            <label for="exampleInputFile">Choose Chamber 1:</label>
                                            <input class="chamber-s1 chamberinput " name="chambers1" value="" hidden><br>
                                            <!--multiple=""-->
                                            <select tabindex="-1"  class="chosen-select-chamber-s1"  data-placeholder="Choose short Chambers " elementvalue="chamber-s1">
                                                <option value=""></option>
                                                <optgroup label="short">
                                                    <?php
                                                    $arr = get_available_parts_nohtml($CHAMBER_KIND_OF_PART_ID, "-S-");
                                                    foreach ($arr as $value) {
                                                        echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                    }
                                                    ?>

                                                </optgroup>

                                            </select>
                                            <br/>
                                            <label for="exampleInputFile">Choose Chamber 2:</label>
                                            <input class="chamber-s2 chamberinput " name="chambers2" value="" hidden><br>
                                            <!--multiple=""-->
                                            <select tabindex="-1"  class="chosen-select-chamber-s2"  data-placeholder="Choose short Chambers " elementvalue="chamber-s2">
                                                <option value=""></option>
                                                <optgroup label="short">
                                                    <?php
                                                    $arr = get_available_parts_nohtml($CHAMBER_KIND_OF_PART_ID, "-S-");
                                                    foreach ($arr as $value) {
                                                        echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                    }
                                                    ?>

                                                </optgroup>

                                            </select>


                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-16 col-xs-36">  <img style="width: 100%;" src="images/superChamber-singles.png"></div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 panel-info panel " style="padding-left: 0px; padding-right: 0px;">
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

  $(".shortchambers").chosen();
  /**
     * [4] When selecting Long or Short version , run Ajax get latest ID Short or Long.
     */
    $('.dropdown-menu a').on('click', function () {

        if ($(this).html() == "Long") {

            $(".longchambers").show();
            $(".shortchambers").hide();
            $(".chamber-s1,.chamber-s2").val("");

        }

        if ($(this).html() == "Short") {

            $(".shortchambers").show();
            $(".longchambers").hide();
            $(".chosen-select-chamber-s2, .chosen-select-chamber-s1").chosen();
            $(".chamber-l1,.chamber-l2").val("");

        }




    })
    
    $("select[class^='chosen-select-chamber-']").on('change', function (evt, params) {
        
        $('.'+$(this).attr("elementvalue")).val($(this).chosen().val());
        alert($(this).chosen().val());
    });

    $(".shortchambers").chosen();
</script>