

# Upload.lib

A simple and reliable PHP-class for Uploading files to the server.
Includes several methods to manipulate images when uploading.

## Method-Summary

### SetFileElement
Set PHP-Form file-selector name.<br />
```php
// Decalaration
void $uploader->SetFileElement(string $phpFileElementName)
```
*Example:*
```html
<!-- HTML standard file selector-->
<input type="file" name="userImage"/>
```
```php
// PHP Example
$uploader->SetFileElement("userImage");
```


### SetPath
Set target upload path<br />
Does not require any ``/`` at the end or beginning of the path<br />
```php
// Declaration
void $uploader->SetPath(string $targetUploadPath)
```
*Example:*
```php
// PHP Example
$uploader->SetPath("uploads/userImages/");	
$uploader->SetPath("uploads/userImages");
$uploader->SetPath("/uploads/userImages/");
// All 3 variants result in the same path.
```

### SetName
Set custom filename for uploaded file<br />
When no custom filename is set, the file gets uploaded with its<br />
current filename.

```php
// Declaration
void $uploader->SetName(string $customFileName)
```
*Example:*
```php
// PHP Example
$uploader->SetName("user001");
```

### SetSQLEntry
Set MySQL-Entry to insert filename or extension into database<br />
Use placeholders `@FILENAME` to insert the filename, <br />
or `@FILEEXTENSION` to insert the filetype.<br />
__*Note:*__<br />
`@FILENAME` will insert e.g. `user001.png`<br />
`@FILEEXTENSION` will insert e.g. `png`<br />

```php
// Declaration
void $uploader->SetSQLEntry(string $sqlStatement)
```
*Example:*
```php
// PHP Example
$uploader->SetSQLEntry("UPDATE users SET userImage = '@FILENAME' WHERE id = '$id'");
```
- __SetFileTypes__<br />
Define allowed filetypes. Default: all filetypes<br />
Enter each allowed filetype as a single parameter.<br />
Entered filetypes are case-insensitive.<br />
```php
// Declaration
void $uploader->SetFileTypes([string $allowedFileTypeExtension...])
```
*Example:*
```php
// PHP Example
$uploader->SetFileTypes("png","jpg","svg");
$uploader->SetFileTypes("PDF","DXF","DWG");
// will support png, PNG, pdf, PDF, etc.
// Note: when calling this method multiple times, the
// accepted filetipes entered last time will not be deleted
```
### SetMaxFileSize
Set maximum filesize of file to be uploaded<br />
Supports the extensions `KB`,`MB` and `GB` when entered as a string,<br />
When entered as an integer the size is given in `Bytes`.<br />
Note: The maximum upload-size might be restricted by your server-host!

```php
// Declaration
void $uploader->SetMaxFileSize(mixed $maxFileSize)
```
*Example:*
```php
// PHP Example
$uploader->SetMaxFileSize("100KB");
// ^Sets upload-limit to 100 Kilobytes
$uploader->SetMaxFileSize(1232);
// ^Sets the upload-limit to 1232 Bytes
```

### SetTargetAspectRatio
Resize image to the defined Aspect Ratio<br />
To avoid loosing quality, the resulting image gets upscaled instead of downscaled.<br />
```php
// Declaration
void $uploader->SetTargetAspectRatio(string $aspectRatio)
```
*Example:*
```php
// PHP Example
$uploader->SetTargetAspectRatio("1:2");
// If the source-image has a resolution of 100x100,
// the resulting image will have a resolution of 100x200

$uploader->SetTargetAspectRatio("16:9");
// Can also be used to fit image to a 
// specific screen-aspect-ratio.
// Note that the result can be distorted
```

### SetTargetResolution
Set maximum filesize and scales down image without changing aspect ratio<br />
```php
// Declaration
void $uploader->SetTargetResolution(int $maxImageWidth, int $maxImageHeight)
```
*Example:*
```php
// PHP Example
$uploader->SetTargetResolution(200,300);
// If the source-image has a resolution of 500x500,
// the resulting image will have a resolution of 200x200
```
### SetScaleFactor
Scales up the entire uploaded image without changing the aspect ratio<br />
```php
// Declaration
void $uploader->SetScaleFactor(int $scaleFactor)
```
*Example:*
```php
// PHP Example
$uploader->SetScaleFactor(3);
// If the source-image has a resolution of 100x300,
// the resulting image will have a resolution of 300x900

$uploader->SetScaleFactor(0.5);
// If the source-image has a resolution of 100x300,
// the resulting image will have a resolution of 50x150
```

### OverrideDuplicates
Define if files with the same fileame should be overwritten or not<br />
When set to false, files with existing filename will be uploaded with leading<br />
number: e.g. `user001(2).png`
```php
// Declaration
void $uploader->OverrideDuplicates(bool $overrideDuplicates)
```
*Example:*
```php
// PHP Example
$uploader->OverrideDuplicates(false);
// 1st image with filename "xy.pdf": xy.pdf
// 2nd file with filename "xy.pdf": xy(2).pdf
```

### Upload
Uploads the file to the server<br />
Will throw out exceptions if errors occur<br />
```php
void $uploader->Upload()
```
*Example:*
```php
// PHP Example
$uploader->Upload();
```
## Full Example

```php
// Creating the uploader
$uploader = new FileUploader();

// Setting the general upload-settings
$uploader->SetFileElement("userImage");
$uploader->SetPath("uploads/");
$uploader->SetName("username_image");
$uploader->SetMaxFileSize("500KB");
$uploader->SetFileTypes("png","jpg","jpeg","gif");
$uploader->OverrideDuplicates(false);

// Setting the SQL-Entry
$uploader->SetSQLEntry("UPDATE users SET userImage = '@FILENAME' WHERE id = '$id'");

// Manipulating the file (images only)
$uploader->SetTargetAspectRatio("2:3");
$uploader->SetTargetResolution(400,600);
$uploader->SetScaleFactor(2);

// Uploading the file to the Server
$uploader->Upload();
```

