<?php
// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';

// --- Data Retrieval and Sanitization ---
// ... (Keep your existing data retrieval and sanitization code here) ...
// Set default values
$name = 'Your Name';
$job_title = ''; // Optional field
$address = 'Your Address';
$phone = 'Your Phone';
$email = 'your.email@example.com';
$date = 'Your Date of Birth'; // Optional
$description = 'Your professional summary...';
$experience = 'Your work experience details...';
$education = 'Your education details...';
$skills = ''; // Optional field
$links = ''; // Optional field

$pic_filename = 'default.png'; // Default image
$pic_alt = 'Profile Picture';
$upload_success = false;

// Process form submission if data is sent
if (isset($_POST['submit'])) {
    // Retrieve and sanitize basic info
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : $name;
    
    
    $job_title = isset($_POST['job_title']) ? htmlspecialchars(trim($_POST['job_title'])) : $job_title;
    $address = isset($_POST['address']) ? htmlspecialchars(trim($_POST['address'])) : $address;
    $phone = isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : $phone;
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : $email; // Use filter_var for email
    $date = isset($_POST['date']) ? htmlspecialchars(trim($_POST['date'])) : $date;

    // Retrieve and sanitize text areas (preserving line breaks)
    $description = isset($_POST['description']) ? nl2br(htmlspecialchars(trim($_POST['description']))) : $description;
    $experience = isset($_POST['experience']) ? nl2br(htmlspecialchars(trim($_POST['experience']))) : $experience;
    $education = isset($_POST['education']) ? nl2br(htmlspecialchars(trim($_POST['education']))) : $education;
    $skills = isset($_POST['skills']) ? nl2br(htmlspecialchars(trim($_POST['skills']))) : $skills;
    $links = isset($_POST['links']) ? nl2br(htmlspecialchars(trim($_POST['links']))) : $links;

    // Handle File Upload
    if (isset($_FILES['pic']) && $_FILES['pic']['error'] == UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $file_type = $_FILES['pic']['type'];

        if (in_array($file_type, $allowed_types)) {
            $pic_basename = basename($_FILES['pic']['name']);
            $pic_safe_filename = preg_replace("/[^a-zA-Z0-9.\-_]/", "_", $pic_basename);
            $pic_dir_path = __DIR__ . '/images/';
            if (!is_dir($pic_dir_path)) {
                if (!mkdir($pic_dir_path, 0755, true)) {
                    error_log("Failed to create images directory: " . $pic_dir_path);
                    // Keep default image, maybe add user feedback
                }
            } elseif (!is_writable($pic_dir_path)) {
                 error_log("Images directory is not writable: " . $pic_dir_path);
                 // Keep default image, maybe add user feedback
            }

            // Only proceed if directory exists and is writable
            if (is_dir($pic_dir_path) && is_writable($pic_dir_path)) {
                $pic_target_path = $pic_dir_path . $pic_safe_filename;
                if (move_uploaded_file($_FILES['pic']['tmp_name'], $pic_target_path)) {
                    $pic_filename = $pic_safe_filename;
                    $pic_alt = htmlspecialchars($name) . ' Profile Picture';
                    $upload_success = true;
                } else {
                    error_log("Failed to move uploaded file to: " . $pic_target_path . " from " . $_FILES['pic']['tmp_name']);
                }
            }
        } else {
             error_log("Invalid file type uploaded: " . $file_type);
        }
    } elseif(isset($_FILES['pic']['error']) && $_FILES['pic']['error'] != UPLOAD_ERR_NO_FILE) {
        error_log("File upload error code: " . $_FILES['pic']['error']);
    }
}

// Ensure image path is relative for HTML/CSS if not default
$pic_src_path = ( $pic_filename !== 'default.png' && file_exists(__DIR__ . '/images/' . $pic_filename) )
              ? 'images/' . $pic_filename
              : 'default.png'; // Or handle default differently if needed

// Check if optional fields are empty and set to null or empty string if needed
if (empty(trim($date))) $date = null;
if (empty(trim($job_title))) $job_title = null;
if (empty(trim($skills))) $skills = null;
if (empty(trim($links))) $links = null;

// --- HTML Structure for PDF (Using Table Layout) ---
$html = "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>{$name} - CV</title>
    
</head>
<body>
    <table class='cv-container-table' role='presentation'>
        <tr>
            <td class='left-td'>
                <div class='left-column'> 
                    <img class='profile-pic' src='{$pic_src_path}' alt='{$pic_alt}'>
                    <div class='contact-info section'>
                        <h3>Contact</h3>
                        <p class='address'><strong>Address:</strong><br>{$address}</p>
                        <p><strong>Phone:</strong><br>{$phone}</p>
                        <p><strong>Email:</strong><br><a href='mailto:{$email}'>{$email}</a></p>";
                        if ($date) {
                            $html .= "<p><strong>Date of Birth:</strong><br>{$date}</p>";
                        }
$html .= "          </div>"; // End contact-info

                        if ($skills) {
                            $html .= "<div class='skills-left section'>
                                <h3>Skills</h3>
                                <p>{$skills}</p>
                            </div>";
                        }
                        if ($links) {
                            $html .= "<div class='links-left section'>
                                <h3>Links</h3>
                                <p>{$links}</p>
                            </div>";
                        }
$html .= "      </div>"; // End left-column div
$html .= "  </td>"; // End left-td

$html .= "  <td class='right-td'>
                <div class='right-column'> 
                    <div class='header'>
                    
                        <h1>{$name}</h1>";
                    
                        if ($job_title) {
                            
                            $html .= "<h2>{$job_title}</h2>";
                            
                            
                        }
                        
                        
                        
$html .= "          </div>"; // End header

$html .= "          <div class='section about-me'>
                        <h3>Professional Summary</h3>
                        <p>{$description}</p>
                        <hr>
                    </div>";

$html .= "          <div class='section experience'>
                        <h3>Work Experience</h3>
                        <p>{$experience}</p>
                        <hr>
                        
                    </div>";

$html .= "          <div class='section education'>
                        <h3>Education & Certifications</h3>
                        <p>{$education}</p>
                        <hr>
                    </div>";

                        // Optional: Add Skills/Links here if you prefer them in the right column
                        /*
                        if ($skills) { ... }
                        if ($links) { ... }
                        */
$html .= "      </div>"; // End right-column div
$html .= "  </td>"; // End right-td
$html .= "</tr>
    </table>
</body>
</html>";


// --- mPDF Generation ---
try {
    // Create an instance of the class:
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'margin_left' => 10,
        'margin_right' => 10,
        'margin_top' => 15,
        'margin_bottom' => 15,
        'default_font' => 'helvetica',
         'autoPageBreak' => true, // Ensure auto page break is enabled (default)
         'shrink_tables_to_fit' => 1, // May help adjust table rendering slightly
    ]);

    // Load the external stylesheet
    $stylesheet_path = __DIR__ . '/style.css'; // Use absolute path for reliability
    if (!file_exists($stylesheet_path)) {
         throw new Exception("Error: style.css not found at {$stylesheet_path}");
    }
    $stylesheet = file_get_contents($stylesheet_path);
    if ($stylesheet === false) {
        throw new Exception("Error reading style.css at {$stylesheet_path}");
    }

    // Ensure the images directory exists for the profile picture
    $image_dir = __DIR__ . '/images';
    if (!is_dir($image_dir)) {
        mkdir($image_dir, 0755, true); // Create if it doesn't exist
    }

    $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

    // Output a PDF file directly to the browser
    $output_filename = preg_replace("/[^a-zA-Z0-9\-_]/", "_", $name) . '_CV.pdf';
    $mpdf->Output($output_filename, 'I'); // 'I' for inline display

} catch (\Mpdf\MpdfException $e) { // Catch mPDF exceptions
    error_log("mPDF Error: " . $e->getMessage() . "\n" . $e->getTraceAsString()); // Log stack trace
    echo "mPDF Error: " . $e->getMessage() . " Check server logs for more details.";
} catch (Exception $e) { // Catch other exceptions (like file read)
     error_log("General Error: " . $e->getMessage() . "\n" . $e->getTraceAsString()); // Log stack trace
    echo "Error: " . $e->getMessage() . " Check server logs for more details.";
}

?>