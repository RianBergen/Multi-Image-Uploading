<?php ?>

<!-- HTML CODE -->
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<title>Multi-Image Form</title>
	<meta name="description" content="Form That Uploads Multiple Images To SQL Database Via PHP Form Handling">
</head>
<body>
    <?php
        // Re-Arrange File Uploads Array
        function reArrangeFiles(&$postedFiles) {
            // Retrieve Variables
            $fileArray = array();
            $fileCount = count($postedFiles['name']);
            $fileKeys = array_keys($postedFiles);
            
            // Re-Construct Array
            for ($i = 0; $i < $fileCount; $i++) {
                foreach ($fileKeys as $key) {
                    $fileArray[$i][$key] = $postedFiles[$key][$i];
                }
            }
            
            // Return Finished Array
            return $fileArray;
        }
        
        // -------------------------------------------------------------
        
        // Handle Submitted Form Input
		if(isset($_POST['submit'])) {
			// Collect Form Input
			extract($_POST);
            
            // Validate Form Input
            // Skipped For Demonstration Purposes
            
            // Save Form Input
            if(!isset($error)) {
                
                // Save Images
                if ($_FILES['imageUpload']) {
                    // Re-Arrange Images
                    $fileArray = reArrangeFiles($_FILES['imageUpload']);
                    
                    // Looping Though Each Image Upload
                    foreach ($fileArray as $file) {
                        echo '<p>----------------Looping Through Images: Auto----------------</p>';
                        echo '<p>File Name: ' . $file['name'] . '</p>';
                        echo '<p>File Type: ' . $file['type'] . '</p>';
                        echo '<p>File Size: ' . $file['size'] . '</p>';
                    }
                    
                    // Choosing A Single Image From Array
                    echo '<p>--------------------Second Input: Manual--------------------</p>';
                    echo '<p>File Name: ' . $fileArray[1]['name'] . '</p>';
                    echo '<p>File Type: ' . $fileArray[1]['type'] . '</p>';
                    echo '<p>File Size: ' . $fileArray[1]['size'] . '</p>';
                }
            }
        }
        
        // Handle Error Message
        // Validation Doesn't Exist To Be Able To Throw Custom Error Messages
        
        // ------------------------------------------------------------
        
        // Retrieve Current Values
        // Not Hooked Up To SQL Database: Nothing To Retrieve
    ?>
    
    <!-- Multi-Images Form -->
	<form action='' method='post' enctype="multipart/form-data">
        <!-- Image 1 Upload-->
        <p><label>Image 1</label><br />
        <input type='file' name='imageUpload[]'></p>
        
        <!-- Image 2 Upload-->
        <p><label>Image 2</label><br />
        <input type='file' name='imageUpload[]'></p>
        
        <!-- Submit -->
		<p><input type='submit' name='submit' value='Submit'></p>
	</form>
</body>
</html>