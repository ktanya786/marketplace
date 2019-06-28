<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE );
ini_set('display_errors', 1);
include("connect.php");

$tools ="Artifactory
Bamboo
Bitbucket Server
Confluence
Facebook
Gerrit
GitHub
GitLab
Google News
Google Search
Twitter
Instagram
Jama
Jenkins
Jira
Jira Service Desk
QuickBooks
Rally
Salesforce
ServiceNow
SonarQube
Success Factors
SVN
Team Foundation Server (2012) TFS
TeamCity
TestRail
Tumblr
Web Search
YouTube
ZenDesk
Kubernetes
Ansible 
VersionOne
Google Sheets
Nagios
Nexus Repo
Microsoft Excel
Nexus IQ
SharePoint
Reddit";

$toolsList = explode(PHP_EOL, $tools);
print_r($toolsList);

for($i=0;$i<count($toolsList);$i++){
    echo $insertQ= "INSERT INTO tbl_tools (`name`) VALUES ('".$toolsList[$i]."')";
    $query = mysqli_query($sql,$insertQ);
    echo "<br>";
    echo $insertedid = mysqli_insert_id($sql);
}
?>