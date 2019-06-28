<?php
include("header.php");
$search_sql='';
if (!empty($_SESSION['search_query'])) {
    $search_sql =$_SESSION['search_query'];
    unset($_SESSION['search_query']);
    //print($_SESSION);
}
// get all templates
$get_all_tpl_sql = "SELECT *
                    FROM `tbl_template_new`";
?>
<div class="inr-section" id="wrapper">
    <div class="container clear">
        <div class="filters_left" id="filters">
        <div class="filters_inr">
            <h3 class="header-page"> Filters </h3>
            <div class="filter-bx">
            <div class="filter-bx-inr">
            <h4>Tools </h4>
            <?php
                    $get_tools = "SELECT * FROM tbl_tools ORDER BY name ASC";
                    $all_tool_query = mysqli_query($sql, $get_tools);
                    $toolArray = [];
                //     while ($row = mysqli_fetch_assoc($all_tool_query)) {
                //         array_push($toolArray,$row);
                //     }
                //     echo "<pre>";
                //     print_r($toolArray);
                //     $toolArray = flatten_array($toolArray);
                //    // print_r($toolArray);
                    echo "</pre>";
            ?>
            <div class="search-hold-filter">
                <form name="search_tool_home_form" class="search_tool_home">
                    <input list="tools" placeholder="Search Tools" name="search_tool_home" class="search_tool_home" id="search_tool_home">
                    <!-- <datalist id="tools">
                        <option value="Safari">
                    </datalist> -->
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
                <a class="show-bar" href="javascript:void(0)"><i class="fas fa-search"></i></a>
                <a class="hide-bar" href="javascript:void(0)"><i class="fas fa-times"></i></a>
            </div>
                <div class="filter-items tools_container">
                    <?php
                    while ($row = mysqli_fetch_assoc($all_tool_query)) {
                    ?>
                        <label for="chk_tool_<?php echo $row['tool_id']; ?>"><input id="chk_tool_<?php echo $row['tool_id']; ?>" type="checkbox" class="fil_tool_home" value="<?php echo trim($row['name']); ?>"><?php echo trim($row['name']); ?></label>
                    <?php
                    }

                ?>
                </div>
                </div>
            </div>
            <div class="filter-bx" class="last-item">
            <div class="filter-bx-inr">

            <h4>Category </h4>
                <div class="search-hold-filter">
                    <form name="search_cat_home_form" class="search_cat_home_form">
                        <input list="tools" placeholder="Search category" name="search_cat_home" class="search_cat_home" id="search_cat_home">
                        <!-- <datalist id="tools">
                            <option value="Safari">
                        </datalist> -->
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </form>
                    <a class="show-bar" href="javascript:void(0)"><i class="fas fa-search"></i></a>
                    <a class="hide-bar" href="javascript:void(0)"><i class="fas fa-times"></i></a>
                </div>
                <div class="filter-items cats_container">
                    <?php
                    $get_cat = "SELECT * FROM tbl_category ORDER BY cat_name ASC";
                    $all_cat_query = mysqli_query($sql, $get_cat);
                    $carray = [];
                    while ($row = mysqli_fetch_assoc($all_cat_query)) {
                    ?>
                        <label for="chk_cat_<?php echo $row['cat_id']; ?>"><input id="chk_cat_<?php echo $row['cat_id']; ?>" type="checkbox" class="fil_cat_home" value="<?php echo $row['cat_name']; ?>"><?php echo $row['cat_name']; ?></label>
                    <?php
                    }

                ?>
                </div>
                </div>
            </div>
            <p class="clear-filter"><a href="javascript:void(0);" id="clear_all_home">Clear all filters</a></p>
            </div>
        </div>
        <div class="manage_tpl_container">
            <h3 class="header-page">Templates</h3>
            <div class="select-sort">
                <select name="" id="">
                    <option value="">Recently Updated</option>
                    <option value="">Most Downloaded</option>
                </select>
            </div>
            <div class="template-list-hold clear">

                <?php

                if($search_sql!=''){
                    $all_tpl_query = mysqli_query($sql, $search_sql);
                }else{
                    $get_all_tpl_sql = $get_all_tpl_sql . " ORDER BY `tbl_template_new`.`tpl_id` DESC";
                    $all_tpl_query = mysqli_query($sql, $get_all_tpl_sql);
                }
                
                if (!$all_tpl_query){
                // if ($all_tpl_query->num_rows <= 0) {
                    ?>
                    <?php echo $noRecordFoundMsg; ?></tr>
                <?php
                } else {
                    while ($row = mysqli_fetch_assoc($all_tpl_query)) {
                        $extratedPath = $row['extracted_path'];

                        $directories = glob($extratedPath . '*', GLOB_ONLYDIR);
                        // echo "<pre>";
                        // print_r($directories); 
                        // echo "<br>";
                        $directory = scandir($directories[0]);

                        $images_of_template = array_slice($directory, 2);
                        //print_r($images_of_template);
                        ?>
                            <div class="template-list-block">
                                <div class="temp-list">
                                    <div class="single-carousel owl-carousel">
                                        <?php foreach ($images_of_template as $img) {
                                            ?>
                                            <div class="single-item"><a class="template-link" href="template-description.php?id=<?php echo $row['tpl_id']; ?>">&nbsp;</a><img src="<?php echo $root_path . '/' . $directories[0] . '/' . $img; ?>"></div>
                                        <?php } ?>
                                    </div>
                                    <div class="temp-list-disc">
                                        <div class="temp-list-name">
                                            <h2><a href="template-description.php?id=<?php echo $row['tpl_id']; ?>"><?php echo $row['template_name']; ?></a></h2>
                                            <span>Uploaded by: <?php echo $row['createdby_userid'] ?></span>
                                        </div>
                                        <div class="temp-list-msg">
                                            <?php echo $row['description'];?>
                                        </div>
                                        <div class="temp-list-tags">Tags: <?php echo $row['usertags']; ?></div>
                                    </div>
                                    

                                </div>
                            </div>
                        <?php
                    } // end of while
                } // end of else 
            ?>


            </div>
        </div>
    </div>
</div>
</div>
</div>


<?php include 'footer.php'; ?>
