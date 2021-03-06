<?php 
// Include Google drive api handler class 
include_once 'googleDriveAPI.class.php';

// Include database configuration file 
include_once('../487a3/include/database.php');

$db = new Database();
$link = $db->connect();

//$fileGateway = new FileGateway();
 
$statusMsg = ''; 
$status = 'danger'; 
if(isset($_GET['code'])){ 
    // Initialize Google Drive API class 
    $GoogleDriveApi = new GoogleDriveApi(); 
     
    // Get file reference ID from SESSION 
    $file_id = $_SESSION['last_file_id']; 
 
    if(!empty($file_id)){ 
         
        // Fetch file details from the database 
        $sqlQ = "SELECT * FROM drive_files WHERE id = ?"; 
        $stmt = $link->prepare($sqlQ);  
        $stmt->bind_param("i", $db_file_id); 
        $db_file_id = $file_id; 
        $stmt->execute(); 
        $result = $stmt->get_result(); 
        $fileData = $result->fetch_assoc(); 
         
        if(!empty($fileData)){ 
            $file_name = $fileData['file_name']; 
            $target_file = 'uploads/'.$file_name; 
            $file_content = file_get_contents($target_file); 
            $mime_type = mime_content_type($target_file); 
             
            // Get the access token 
            if(!empty($_SESSION['google_access_token'])){ 
                $access_token = $_SESSION['google_access_token']; 
            }else{ 
                $data = $GoogleDriveApi->GetAccessToken(GOOGLE_CLIENT_ID, REDIRECT_URI, GOOGLE_CLIENT_SECRET, $_GET['code']); 
                $access_token = $data['access_token']; 
                $_SESSION['google_access_token'] = $access_token; 
            } 
             
            if(!empty($access_token)){ 
                 
                try { 
                    // Upload file to Google drive 
                    $drive_file_id = $GoogleDriveApi->UploadFileToDrive($access_token, $file_content, $mime_type); 
                     
                    if($drive_file_id){ 
                        $file_meta = array( 
                            'name' => basename($file_name) 
                        ); 
                         
                        // Update file metadata in Google drive 
                        $drive_file_meta = $GoogleDriveApi->UpdateFileMeta($access_token, $drive_file_id, $file_meta); 
                         
                        if($drive_file_meta){ 

                            $glink = "https://drive.google.com/open?id=".$drive_file_meta['id'];
                            // Update google drive file reference in the database 
                            $sqlQ = "UPDATE drive_files SET google_drive_file_id=?, link = ? WHERE id=?"; 
                            $stmt = $link->prepare($sqlQ); 
                            $stmt->bind_param("ssi", $db_drive_file_id, $glink, $db_file_id); 
                            $db_drive_file_id = $drive_file_id; 
                            $db_file_id = $file_id; 
                            $update = $stmt->execute(); 
                             
                            //$trip_id = $fileGateway->get_trip_id_by_google_drive_id($link,$db_drive_file_id);
                            unset($_SESSION['last_file_id']); 
                            unset($_SESSION['google_access_token']); 
                             
                            $status = 'success'; 
                            $statusMsg = '<p>File has been uploaded to Google Drive successfully!</p>'; 
                            $statusMsg .= '<p><a href="https://drive.google.com/open?id='.$drive_file_meta['id'].'" target="_blank">'.$drive_file_meta['name'].'</a>'; 

                            
                        } 
                    } 
                } catch(Exception $e) { 
                    $statusMsg = $e->getMessage(); 
                } 
            }else{ 
                $statusMsg = 'Failed to fetch access token!'; 
            } 
        }else{ 
            $statusMsg = 'File data not found!'; 
        } 
    }else{ 
        $statusMsg = 'File reference not found!'; 
    } 
     
    $_SESSION['status_response'] = array('status' => $status, 'status_msg' => $statusMsg); 
     
    header("Location: ../487a3/en/viewtrips.php?status=1001"); 
    exit(); 
} 
?>