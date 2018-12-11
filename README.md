# PHP Library Collection
A collection of usefull PHP-Libraries for web-development<br />
For detailed description see the README.md in each libraries folder.
A brief summary of all classes and methods is given below.

Every library is available for procedural programming style 
and object oriented programming style (object oriented is recommended)

__Current libraries:__
- MySQL.lib
- Pager.lib
- Page.lib
- Upload.lib
- Setting.lib

## MySQL.lib
A lightweight MySQL library with all necessary methods for regular use.

- __NonQuery__<br />
Execute a SQL-Operation like INSERT, UPDATE, ALTER, ...<br />
`void MySQL::NonQuery(string $sqlStatement [, string $paramTypes, mixed &$parameters...])`

- __Scalar__<br />
Get 1 value using a SELECT statement<br />
`string MySQL::Scalar(string $sqlStatement [, string $paramTypes, mixed &$parameters...])`

- __Count__<br />
Count rows of a table using a SELECT statement<br />
`int MySQL::Count(string $sqlStatement [, string $paramTypes, mixed &$parameters...])`

- __Exist__<br />
Checks if a SQL-entry exists using a SELECT statement<br />
`bool MySQL::Exist(string $sqlStatement [, string $paramTypes, mixed &$parameters...])`

- __Row__<br />
Get a single row of the table using a SELECT statement<br />
`string[] MySQL::Row(string $sqlStatement [, string $paramTypes, mixed &$parameters...])`

- __Cluster__<br />
Get multiple rows of the table using a SELECT statement<br />
`string[][] MySQL::Cluster(string $sqlStatement [, string $paramTypes, mixed &$parameters...])`

- __Save__<br />
Saves the database to a `.sql` file<br />
`void MySQL::Save(string $backupName)`

- __PeriodicSave__<br />
Regularly saves the database in a specified period<br />
`void MySQL::PeriodicSave([string $backupPeriod = "d"])`

For more details see the `README.md` in the library folder

## Pager.lib
A small PHP-class that adds a variety of pagers for SQL and Non-SQL lists

- __SQLAuto__<br />
Create a pager with a given SELECT statement<br />
`string $pager->SQLAuto(string $sqlStatement [, string $paramTypes, mixed &$parameters...])`

- __Manual__<br />
Create a manual pager<br />
`string $pager->Manual([string $link...])`

- __SetPagerSize__<br />
Set Shown entries per page<br />
`void $pager->SetPagerSize(int $pagerSize)`

- __SetOffset__<br />
Manually set the current page of the pager<br />
`void $pager->SetOffset(int $pagerOffset)`

- __SetCustomURL__<br />
Set a custom redirect-URL for the pager<br />
`void $pager->SetCustomURL(string $customURL)`

- __GetPagerSize__<br />
Get the amount of shown elements per page<br />
`int $pager->GetPagerSize()`

- __GetOffset__<br />
Get the current page of the pager<br />
`int $pager->GetOffset()`

For more details see the `README.md` in the library folder

## Page.lib
A lightweight PHP-class which adds several usefull Methods to PHP
- __This__<br />
Returns the pages URL and modifies it with given parameters<br />
`string Page::This([string $urlModifier])`

- __Redirect__<br />
Redirects to the provided URL<br />
`void Page::Redirect(string $redirectURL [, int $redirectDelay])`

For more details see the `README.md` in the library folder

## Upload.lib
A simple and reliable PHP-class for Uploading files to the server

- __SetFileElement__<br />
Set PHP-Form file-selector name<br />
`void $uploader->SetFileElement(string $phpFileElementName)`

- __SetPath__<br />
Set target upload path<br />
`void $uploader->SetPath(string $targetUploadPath)`

- __SetName__<br />
Set custom filename for uploaded file<br />
`void $uploader->SetName(string $customFileName)`

- __SetSQLEntry__<br />
Set MySQL-Entry to insert filename or extension into database<br />
`void $uploader->SetSQLEntry(string $sqlStatement)`

- __SetFileTypes__<br />
Define allowed filetypes. Default: all filetypes<br />
`void $uploader->SetFileTypes([string $allowedFileTypeExtension...])`

- __SetMaxFileSize__<br />
Set maximum filesize of file to be uploaded<br />
`void $uploader->SetMaxFileSize(string $maxFileSize)`

- __SetTargetAspectRatio__<br />
Resize image to the defined Aspect Ratio<br />
`void $uploader->SetTargetAspectRatio(string $aspectRatio)`

- __SetTargetResolution__<br />
Set maximum filesize and scale down image without changing aspect ratio<br />
`void $uploader->SetTargetResolution(int $maxImageWidth, int $maxImageHeight)`

- __SetScaleFactor__<br />
Set scale factor for uploaded image<br />
`void $uploader->SetScaleFactor(int $scaleFactor)`

- __OverrideDuplicates__<br />
Define if files with the same fileame should be overwritten or not<br />
`void $uploader->OverrideDuplicates(bool $overrideDuplicates)`

- __Upload__<br />
Uploads the file to the server<br />
`void $uploader->Upload()`


For more details see the `README.md` in the library folder

## Settings.lib
A small PHP-class to save and load Settings stored in a MySQL-Database
- __Set__<br />
Sets a setting with maching keyword to given value<br />
`void Setting::Set(string $settingKeyword , string $settingValue)`

- __Get__<br />
Returns setting's value with maching keyword<br />
`mixed Setting::Get(string $settingKeyword)`

- __Increment__<br />
Increments a settings value and returns the new value<br />
`int Setting::Increment(string $settingKeyword[, int $resetLimit])`

- __Decrement__<br />
Decrements a settings value and returns the new value<br />
`mixed Decrement::Get(string $settingKeyword)`


For more details see the `README.md` in the library folder
