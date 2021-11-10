<?php 

function read_docx($filename){

$striped_content = '';
$content = '';

if(!$filename || !file_exists($filename)) return false;

$zip = zip_open($filename);
if (!$zip || is_numeric($zip)) return false;

while ($zip_entry = zip_read($zip)) {

if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

if (zip_entry_name($zip_entry) != "word/document.xml") continue;

$content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

zip_entry_close($zip_entry);
}
zip_close($zip);
$content = str_replace('</w:r>
</w:p>
</w:tc>
<w:tc>', " ", $content);
  $content = str_replace('</w:r>
  </w:p>', "\r\n", $content);
  $striped_content = strip_tags($content);

  echo $striped_content;
  };

  function read_txt($fileName){
  try {
  if (!file_exists($fileName)) {
  throw new Exception('File open failed');
  }
  // The function returns a pointer to the file if it is successful or zero if it is not. Files are opened for read or write operations.
  $file = fopen($fileName, "r");
  // Reads the file
  $content = fread($file, filesize($fileName));
  echo $content;
  // Close the file buffer
  fclose($file);
  } catch (Throwable $t) {
  echo $t->getMessage();
  };
  };