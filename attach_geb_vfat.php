
<?php
include "head.php";
?>


<div class="container-fluid">
    <div class="row">

<?php include "side.php"; ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Attach VFATs to GEB</h1>
            <img src="images/GEB-VFAT.png" width="20%" style="margin-bottom: 10px; border-radius: 20px;">

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     var_dump($_POST);
    if ((isset($_POST['version']) && isset($_POST['gebl']) && isset($_POST['opto']) ) || (isset($_POST['version']) && isset($_POST['gebs']) && isset($_POST['gebs']))) {
        $temp = array();
        $arr = array();
        $childs = array();
        $child = array();
        $subchild = array();
        if ($_POST['version'] == "L") {
            echo '<div role="alert" class="alert alert-success">
      <strong>Well done!</strong> You successfully attached OptoHybrid [' . $_POST['opto'] . '] to GEB [' . $_POST['gebl'] . ']   </div>';
            $temp[$SERIAL_NUMBER] = $_POST['gebl'];
            $temp[$KIND_OF_PART] = $GEB_KIND_OF_PART_NAME;

            $child['SERIAL_NUMBER'] = $_POST['opto'];
            $child['KIND_OF_PART'] = $OPTOHYBRID_KIND_OF_PART_NAME;
            $childs[] = $child;
        }
        if ($_POST['version'] == "S") {
            echo '<div role="alert" class="alert alert-success">
      <strong>Well done!</strong> You successfully attached OptoHybrid [' . $_POST['opto'] . '] to GEB [' . $_POST['gebs'] . ']   </div>';

            $temp[$SERIAL_NUMBER] = $_POST['gebs'];
            $temp[$KIND_OF_PART] = $GEB_KIND_OF_PART_NAME;

            $child['SERIAL_NUMBER'] = $_POST['opto'];
            $child['KIND_OF_PART'] = $OPTOHYBRID_KIND_OF_PART_NAME;
            $childs[] = $child;
        }
        $temp['children'] = $childs;
        $arr[] = $temp;
        print_r($arr);

        generateXml($arr);
    }
} else {

    echo '<div style="display: none" geble="alert" class="alert alert-danger ">
      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><strong>Error!</strong> Please fill the required fields.
    </div>';
    ?> 

                <form method="POST" action="attach_geb_opto.php">
                    <div class="row">
                        <div class="col-xs-6 panel-info panel" style="padding-left: 0px; padding-right: 0px;">
                            <div class="panel-heading">
                                <h3 class="panel-title" >  <span aria-hidden="true" class="glyphicon glyphicon-info-sign"></span>Attached parts information</h3>
                            </div>
                            <div class="panel-body">
                                <label for="exampleInputFile" >(1) Choose Version L/S ?</label>
                                <input class="version" name="version" value="" hidden>
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Choose Version
                                        <span class="caret"></span>
                                    </button> 
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <li><a href="#">Long</a></li>
                                        <li><a href="#">Short</a></li>
                                    </ul>
                                </div>


                                <label for="exampleInputFile" > (2)Pick a GEB (Parent of OptoHybrid) </label>

                                <!-- GEB S-->
                                <div class="form-group shortreads" style="display: none">
                                    <input class="gebs" name="gebs"  hidden>
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Choose Readout GEB
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
    <?php get_available_parts_nochild($GEB_KIND_OF_PART_ID, "-S-"); ?>
                                        </ul>

                                    </div>
                                </div>

                                <!-- GEB L-->
                                <div class="form-group longreads" >
                                    <input class="gebl" name="gebl"  hidden>
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Choose Readout GEB
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
    <?php get_available_parts_nochild($GEB_KIND_OF_PART_ID, "-L-"); ?>
                                        </ul>

                                    </div>
                                </div>

                                <!-- VFATS -->
                                <div class="form-group">
                                    <label for="exampleInputFile"> (3) Pick a OptoHybrid (Child of GEB)</label>
                                    <!-- ***** VFAT layout begin ******* -->
                                    <div style="border: #000;  text-center">
                                        <!-- 1st Row-->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 0 (Child of GEB)</label>
                                                    <input class="vfat0" name="vfat0" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat0" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 8 (Child of GEB)</label>
                                                    <input class="vfat8" name="vfat8" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat8" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                   
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 16 (Child of GEB)</label>
                                                    <input class="vfat16" name="vfat16" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat16" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                    
                                            </div>
                                        </div>
                                        <!-- 2nd Row -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 1 (Child of GEB)</label>
                                                    <input class="vfat1" name="vfat1" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat1" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                 
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 9 (Child of GEB)</label>
                                                    <input class="vfat9" name="vfat9" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat9" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                   
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 17 (Child of GEB)</label>
                                                    <input class="vfat17" name="vfat17" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat17" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                     
                                            </div>
                                        </div>
                                        <!-- 3rd Row -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 2 (Child of GEB)</label>
                                                    <input class="vfat2" name="vfat2" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat2" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                 
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 10 (Child of GEB)</label>
                                                    <input class="vfat10" name="vfat10" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat10" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                    
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 18 (Child of GEB)</label>
                                                    <input class="vfat18" name="vfat18" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat18" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                    
                                            </div>
                                        </div>
                                        <!-- 4th Row -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 3 (Child of GEB)</label>
                                                    <input class="vfat3" name="vfat3" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat3" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                  
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 11 (Child of GEB)</label>
                                                    <input class="vfat11" name="vfat11" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat11" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                   
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 19 (Child of GEB)</label>
                                                    <input class="vfat19" name="vfat19" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat19" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                   
                                            </div>
                                        </div>
                                        <!-- 5th Row -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 4 (Child of GEB)</label>
                                                    <input class="vfat4" name="vfat4" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat23" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                  
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 12 (Child of GEB)</label>
                                                    <input class="vfat12" name="vfat12" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat12" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                    
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 20 (Child of GEB)</label>
                                                    <input class="vfat20" name="vfat20" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat20" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                    
                                            </div>
                                        </div>
                                        <!-- 6th Row -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 5 (Child of GEB)</label>
                                                    <input class="vfat5" name="vfat5" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat5" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                               
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 13 (Child of GEB)</label>
                                                    <input class="vfat13" name="vfat13" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat13" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                    
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 21 (Child of GEB)</label>
                                                    <input class="vfat21" name="vfat21" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat21" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                    
                                            </div>
                                        </div>
                                        <!-- 7th Row -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 6 (Child of GEB)</label>
                                                    <input class="vfat6" name="vfat6" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat6" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                 
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 14 (Child of GEB)</label>
                                                    <input class="vfat14" name="vfat14" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat14" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                    
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 22 (Child of GEB)</label>
                                                    <input class="vfat22" name="vfat22" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat22" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                    
                                            </div>
                                        </div>
                                        <!-- 8th Row -->
                                        <div class="row">
                                            <div class="col-md-4">
                                               <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 7 (Child of GEB)</label>
                                                    <input class="vfat7" name="vfat7" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat7" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 15 (Child of GEB)</label>
                                                    <input class="vfat15" name="vfat15" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat15" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                  
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">VFAT 23 (Child of GEB)</label>
                                                    <input class="vfat23" name="vfat23" value="" hidden><br>
                                                    <!--multiple=""-->
                                                    <select tabindex="-1"  class="chosen-select-vfat23" style="" data-placeholder="Choose VFAT">
                                                        <option value=""></option>
                                                        <optgroup label="vfats">
                                                            <?php
                                                            $arr = get_available_parts_nohtml_noversion($VFAT_KIND_OF_PART_ID);
                                                            foreach ($arr as $value) {
                                                                echo "<option>" . $value['SERIAL_NUMBER'] . "</option>";
                                                            }
                                                            ?>

                                                        </optgroup>
                                                    </select>


                                                </div>                                                  
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ******** VFAT layout END********* -->


                                </div>


                            </div>
                        </div>

                        <div style="padding-left: 0px; padding-right: 0px;" class="col-xs-6 panel-info panel">

                            <img src="images/vfats_slots.png" style=" width: 57.5%;">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-default btn-lg subbutt_at">Submit</button> 
                </form>
<?php } ?>

        </div>
    </div>
</div>
<?php
include "foot.htm";
?>
<script>
    /**
     * [4] When selecting Long or Short version , run Ajax get latest ID Short or Long.
     */
    $('.dropdown-menu a').on('click', function () {

        if ($(this).html() == "Long") {

            $(".longreads,.longgebs").show();
            $(".shortreads,.shortgebs").hide();
            $(".gebs,.gebl").val("");

        }

        if ($(this).html() == "Short") {

            $(".shortreads,.shortgebs").show();
            $(".chosen-select").chosen();
            $(".longreads,.longgebs").hide();
            $(".gebl,.gebs").val("");

        }




    })


    $('.chosen-select-opto').on('change', function (evt, params) {
        $('.opto').val($(this).chosen().val());
        alert($(this).chosen().val());
        alert($(".opto").val().length);
    });


    $('.chosen-select-gebl').on('change', function (evt, params) {
        $('.gebl').val($(this).chosen().val());
        alert($(this).chosen().val());
    });

    $('.chosen-select-gebs').on('change', function (evt, params) {
        $('.gebs').val($(this).chosen().val());
        alert($(this).chosen().val());
    });


    $(".subbutt_at").click(function () {
        if ($(".version").html().length == 0) {
            $('.alert-danger').show();
            return false;
        }
        if (($(".gebs").val().length == 0 && $(".gebl").val().length == 0) || ($(".opto").val().length == 0))
        {
            $('.alert-danger').show();
            return false;
        }
    })
//    alert($(".version").val().length);
//    alert($(".gebs").val().length);alert($(".opto").val().length);alert($(".gebl").val().length );alert($(".gebs").val().length);
</script>
