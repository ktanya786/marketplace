<?php
include("header.php");


$search_sql='';
if (!empty($_SESSION['search_query'])) {
    $search_sql =$_SESSION['search_query'];
    unset($_SESSION['search_query']);
    //print($_SESSION);
}
//}else{
// get all templates
$get_all_tpl_sql = "SELECT *
                    FROM `tbl_template`";

//}
//echo $get_all_tpl_sql;

if ($_SESSION['role']!='end-user') {


    ?>
<div class="banner-area">
    <div class="container">
        <h2>Manage existing templates</h2>
    </div>
</div>

<div class="inr-section">
    <div class="container clear">
    <div class="filters_left">
            <h3 class="header-page"> Filters </h3>
            <div class="filter-bx first-bx">
            <h4>Tools  <input type="text" placeholder="Search Tools" name="search_tool" class="search_tool" id="search_tool"></h4>
                <div class="filter-items">
                    <?php
                    $get_tools = "SELECT * FROM tbl_tools";
                    $all_tool_query = mysqli_query($sql, $get_tools);
                    $carray = [];
                    while ($row = mysqli_fetch_assoc($all_tool_query)) {
                    ?>
                        <label for="chk_pro_<?php echo $row['tool_id']; ?>"><input id="chk_pro_<?php echo $row['tool_id']; ?>" type="checkbox" class="fil_product_h" value="<?php echo $row['tool_id']; ?>"><?php echo $row['name']; ?></label>
                    <?php
                    }

                ?>
                </div>
            </div>
            <div class="filter-bx">

            <h4>Category <input type="text" placeholder="Search category" name="search_cat" class="search_cat" id="search_cat"></h4>
                <div class="filter-items">
                    <?php
                    $get_cat = "SELECT * FROM tbl_category";
                    $all_cat_query = mysqli_query($sql, $get_cat);
                    $carray = [];
                    while ($row = mysqli_fetch_assoc($all_cat_query)) {
                    ?>
                        <label for="chk_pro_<?php echo $row['cat_id']; ?>"><input id="chk_pro_<?php echo $row['cat_id']; ?>" type="checkbox" class="fil_product_h" value="<?php echo $row['cat_id']; ?>"><?php echo $row['cat_name']; ?></label>
                    <?php
                    }

                ?>
                


                </div>
            </div>
            <p class="clear-filter"><a href="javascript:void(0);" id="clear_all_home">Clear all filters</a></p>
        </div>
        <div class="manage_tpl_container">
            <h3 class="header-page">Templates</h3>
            <div class="delete-all"><a id="delete" href="javascript:void();" class="delete_all disable">Delete</a></div>

            <div class="table-manage">
                <table cellspacing="0" cellpadding="0" width="100%" border="0">
                    <thead>
                    <th><input type="checkbox" id="checkAll"></th>
                    <th class="temp-name">Template Name</th>
                    <th class="updated">Last Updated On</th>
                    <th class="systems">Systems</th>
                    <th class="dashboard">Pages</th>
                    <th class="downloads">Downloads</th>
                    <th class="product">Product</th>
                    </thead>
                    <tbody>
                        <?php
                        if ($search_sql!='') {
                            $all_tpl_query = mysqli_query($sql, $search_sql);
                        } else {
                            $all_tpl_query = mysqli_query($sql, $get_all_tpl_sql);
                        }
    if ($all_tpl_query->num_rows <= 0) {
        ?>
                            <tr>
                                <td class="norecord" colspan="7"><?php echo $noRecordFoundMsg; ?></td>
                            </tr>
                        <?php
    } else {
        //echo "<pre>";
        while ($row = mysqli_fetch_assoc($all_tpl_query)) {
            ?>
                                <tr>
                                    <td><input type="checkbox" class="tpl_chk" value="<?php echo $row['tpl_id']; ?>" name="temps[]"></td>
                                    <td class="temp-name"><p><a href="edit_templete.php?id=<?php echo $row['tpl_id']; ?>"><?php echo $row['template_name']; ?></a></td>
                                    <td class="updated"><?php echo date('d M Y', strtotime($row['uplaoded_date'])); ?></p></td>
                                    <td class="systems"><p><?php echo $row['connectors']; ?></p></td>
                                    <td class="dashboard"><p><?php echo $row['pagecount']; ?></p></td>
                                    <td class="downloads"><p><?php echo $row['count']; ?></p></td>
                                    <td class="product"><p><?php echo $row['productname']; ?></p></td>
                                </tr>
                            <?php
        } // end of while
    } // end of else
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include 'footer.php';
}else{
    header('Location:home.php');
}
 ?>