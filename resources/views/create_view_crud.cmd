@echo off
set /p folderName=Enter the name of the folder: 

mkdir "%folderName%"
cd "%folderName%"

echo. > "%folderName%.blade.php"
echo. > "create.blade.php"
echo. > "show.blade.php"
echo. > "edit.blade.php"

echo Folder "%folderName%" created with necessary files.