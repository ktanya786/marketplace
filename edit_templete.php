<?php
if ($_GET['id']!='') {
include("header.php");
//echo "<pre>";
// get template

    $get_all_tpl_sql = "SELECT *
                    FROM `tbl_template` 
                    WHERE tpl_id =" . $_GET['id'];

    $all_tpl_query = mysqli_query($sql, $get_all_tpl_sql);
    $dataToShowMsg = "";
    if ($all_tpl_query->num_rows > 0) {
        $row = mysqli_fetch_assoc($all_tpl_query);
    } else {
        $dataToShowMsg = "No records found";
        header('location:manage_templates.php');
        die;
    }

    //echo $row['template_path'];//./upload/1557264958_IssueAnalysisCopy.zip
    //print_r($_SESSION['currently_added_tpl']);
    $get_file_name = explode("_", $row['template_path']);
    $get_foldername = explode('/', $get_file_name[0]);
    $firstfolder_name = $get_foldername[2];

    $second_Folder_name = explode('.', $get_file_name[1]);

    //echo $folder = "upload/extracted/".$firstfolder_name.'/'.$second_Folder_name[0];
    $folder = "upload/extracted/" . $firstfolder_name;

    // $directories = glob($folder . '/*', GLOB_ONLYDIR);
    // $directory = scandir($directories[0]);
    //print_r($directory);
    $directory = scandir($folder);
    foreach ($directory as $file) {
        if ($file != '.' or $file != '..') {
            if (is_file($folder . "/" . $file)) {
                $pos = strpos($file, '.');
                if ($pos) {
                    // file ext is .template and .meta read from file and display content
                    $read_from_meta = array('meta');
                    $f = explode(".", $file);
                    $file_ext = $f[1];
                    if (in_array($file_ext, $read_from_meta)) {
                        // Get the contents of the JSON file
                        $strJsonFileContents = file_get_contents($folder . '/' . $file);
                        //var_dump($strJsonFileContents); // show contents
                        // Convert to array
                        $tpl_details = json_decode($strJsonFileContents, true);
                    }
                }
            } else {
                $imagefoldername = $file;
                $images_of_template = scandir($folder . '/' . $file);
                $images_of_template = array_slice($images_of_template, 2);
            }
        }
    }
    //echo $row['template_name'];
//echo "<pre>";
// print_r($tpl_details); // show contents
//echo "<br>---------------<br>";
//print_r($images_of_template); ?>
<!--<link rel="stylesheet" href="custom_style.css">-->
<div class="edit-temp-hold">
<form class="edit_template" action="manage_templates.php">
    <input type="hidden" value="<?php echo $_GET['id']; ?>" id="t_id">
    <input type="hidden" value='<?php echo $row['executionmodel']; ?>' id="graph_data">
    <div class="template-disc-strip">
        <!-- <form name="edit_template"> -->
        <div class="container clear">
            <div class="temp-disc-left">
                <div class="temp-disc-img">
                    <img src="<?php echo $root_path . '/' . $folder . '/' . $imagefoldername . "/" . $images_of_template[0]; ?>">
                </div>
                <div class="tags"> Tags: <?php echo implode(', ', $tpl_details['usertags']) ?> </div>
            </div>
            <div class="temp-disc-right">
                <div class="template-disc-inr-left">
                    <div class="template-head">
                        <div class="edit-mode">
                    <i class="fas fa-pencil-alt"></i>
                        <input type="text" value="<?php echo htmlspecialchars($row['template_name']); ?>" class="template-name-edit" />
                        </div>
                        <p>Uploaded by: <?php echo $row['createdby_userid']; ?></p>
                    </div>
                    <div class="temp-disc-inr">
                        <?php echo $tpl_details['productname']; ?> template contains <?php echo $tpl_details['pagecount']; ?> dashboard(s)<?php

                        //echo "coount".count($tpl_details['connectors']);
                        $countConnector = count($tpl_details['connectors']);
    if ($countConnector > 0) {
        $array_connector = [];
        foreach ($tpl_details['connectors'] as $connector_val) {
            $array_connector[] = $connector_val['servicename'];
        }
        if (count($tpl_details['connectors']) > 1) {
            echo " with systems" . implode(', ', $array_connector);
        } else {
            echo " with system " . $array_connector[0];
        }
    } ?>.
                    </div>
                    <div class="last-updated">Last updated on: <?php echo date('d M Y', strtotime($row['uplaoded_date'])); ?></div>
                </div>
                <div class="template-disc-inr-right">
                    <div class="download-btn disabled">
                        <a href="#">Download Now</a>
                        <p class="no-downloads"><i class="fas fa-cloud-download-alt"></i> <?php echo $row['count']; ?> downloads</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- prod-disc -->
    <div class="prod-disc">
        <div class="container clear">

            <div class="template-left">
                <h3 class="header-page">System Screenshots</h2>
                    <div class="template-carousel owl-carousel">
                        <?php foreach ($images_of_template as $img) {
        ?>
                            <div class="temp-item">
                                <a data-fancybox="gallery" href="<?php echo $root_path . '/' . $folder . '/' . $imagefoldername . "/" . $img; ?>"><img src="<?php echo $root_path . '/' . $folder . '/' . $imagefoldername . "/" . $img; ?>"></a>

                            </div>
                        <?php
    } ?>
                    </div>

                    <div class="exploration-graph">
                        <h3 class="header-page">Execution Graph</h2>
                        <div id="graphDiv">
                        
                        </div>
                    </div>
                    <div class="description">
                        <h2 class="header-page">Description</h2>
                        <div class="temp-disc ">
                        <i class="fas fa-pencil-alt"></i>
                            <textarea class="editable-temp-disc"><?php echo htmlspecialchars($row['description']); ?></textarea>
                        </div>
                    </div>
                    <input type="submit" class="submit-btn" value="Publish">
            </div>
        </div>
    </div>

</form>
</div>

<?php include 'footer.php';
}else{
    header('location:manage_templates.php');
} ?>
<script src="vizjs/dagree.js"></script>
<script src="vizjs/vis.js"></script>
<script src="app/graphrenderer.js"></script>
<script>
        var graphRender = new GraphRenderer();
        var graphContainer = document.getElementById("graphDiv");
        
        // var data = JSON.stringify({
        //     edges: edges,
        //     nodes: nodes
        // });
        //graphRender.drawExecutionGraph(graphContainer, data);

        function submitinput() {
            var elem = document.getElementById("graph_data");
            data = elem.value;
            console.log(data);
            console.log(typeof(data));
            graphRender.drawExecutionGraph(graphContainer, data);
        }

        // var button = document.getElementById("button");
        // button.onclick = submitinput;

        

            $( document ).ready(function() {
                console.log( "ready!" );
                submitinput();
            });
    </script>  
