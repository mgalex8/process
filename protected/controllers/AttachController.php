<?php

class AttachController extends Controller
{	
    
	public function actionIndex($id)
	{   
            $fileName = $id;
            $pathToUpload = $_SERVER['DOCUMENT_ROOT'].'/upload/';            
            $fileNameFullPath = $pathToUpload . $fileName;
            
            if (file_exists($fileNameFullPath)) {                
                $size = filesize($fileNameFullPath);
                $f=fopen($fileNameFullPath, 'r');
                header("HTTP/1.1 200 OK"); 
                header("Connection: close"); 
                header("Content-Type: application/octet-stream"); 
                header("Accept-Ranges: bytes"); 
                header("Content-Disposition: Attachment; filename=". $fileName); 
                header("Content-Length: ". $size);
            }        
            else {                
                header('HTTP/1.1 404 Not Found');
                exit;
            }
            
	}      
        
}
