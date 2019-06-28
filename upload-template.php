<?php include 'header.php'; 

if ($_SESSION['role']!='end-user') {
    ?>
<!-- banner -->
<div class="banner-area">
    <div class="container">
        <h2>Add new template</h2>
    </div>
    <div class="container">
        <h3>Add categories</h3>
    <select name="multicheckbox[]" multiple="multiple" class="4col formcls">
    <?php
        $get_cat = "SELECT * FROM tbl_category ORDER BY cat_name ASC";
        $all_cat_query = mysqli_query($sql, $get_cat);
        $carray = [];
        while ($row = mysqli_fetch_assoc($all_cat_query)) {
        ?>
            <option value="<?php echo $row['cat_name'];?>"><?php echo $row['cat_name'];?></option>
        <?php
        }
    ?>
       
    </select>


    </div>
</div>

        <div class="inr-section">
            <div class="container" >
                <div class="upload-sec-outer">
                    <input type="file" name="file" id="file">
                    <!-- Drag and Drop container-->
                    <div class="upload-area clear"  id="uploadfile">
                        <div class="upload-sec">
                            <div class="drag-drop">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p>Drag and drop</p>
                            </div>
                            <div class="or"><span>OR</span></div>
                            <span class="browse-btn">Browse</span>
                        </div>

                        <div class="upload-msg">
                            
                        </div>

                    </div>
                </div>
                <input type="button" value="Submit" id="upload_template" name="upload_template">
            </div>
        </div>


<?php
include ('footer.php'); ?>
<script>
$('select[multiple]').multiselect({
    columns: 4,
    placeholder: 'Select options'
});
</script>
<?php }else{
    header('Location:home.php');
}
?>